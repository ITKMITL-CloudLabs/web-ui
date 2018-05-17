<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OpenStack\OpenStack;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::all();
        return view('admin.lab.index', compact('labs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lab = $request->validate([
            'title' => 'required',
            'is_predefined_lab' => 'required',
        ]);

        $lab['quota'] = [
            'instances' => 0,
            'vcpus' => 0,
            'memory' => 0,
            'disk' => 0
        ];

        $lab = Lab::create($lab);

        return redirect(route('admin.lab.show', $lab->id))->with('alert_success', 'ห้องทดลองได้ถูกสร้างแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        return view('admin.lab.show', compact('lab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        return view('admin.lab.edit', compact('lab'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        $lab->fill($request->all())->save();

        return redirect(route('admin.lab.show', $lab->id))->with('alert_success', 'แก้ไขห้องทดลองสำเร็จ');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect(route('admin.lab.index'))->with('alert_success', 'ห้องทดลองได้ถูกลบแล้ว');
    }

    public function togglePublishStatus(Lab $lab)
    {
        $lab->is_published = !$lab->is_published;
        $lab->save();

        return redirect(route('admin.lab.show', $lab->id))->with('alert_success', 'แก้ไขการเผยแพร่สำเร็จ');
    }

    public function prepare(Lab $lab)
    {
        $openStackIdentityService = resolve('OpenStackApi')->identityV3();

        if (is_null($projectId = $lab->project_id)) {
            $project = $openStackIdentityService->createProject([
                'name' => "{$lab->id}_" . Carbon::now()->format('Y_m_d_His') . "_template",
                'description' => "A Lab Template of ID #{$lab->id}",
                'enabled' => true
            ]);

            $project->grantGroupRole([
                'groupId' => env('OS_ADMIN_GROUP_ID'),
                'roleId'  => env('OS_ADMIN_ROLE_ID')
            ]);

            $lab->project_id = $project->id;
            $lab->save();
        } else {
            $project = $openStackIdentityService->getProject($projectId);
            $project->retrieve();
        }

        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        // VM Lists
        $servers = collect($openStack->computeV2()->listServers(true));


        $serversGraph = $servers->map(function ($server) {
           $server = (array) $server;
           $server["task"] = $server["taskState"];
           return $server;
        });

        //Get Public Network

        $publicNetwork = $openStack->networkingV2()->getNetwork(env('OS_PUBLIC_NETWORK_ID'));
        $publicNetwork->retrieve();

        $publicNetwork = (array) $publicNetwork;

        // Networking Lists (Network, Router)
        $networks = collect(resolve('OpenStackApi')->networkingV2()->listNetworks([
            'tenantId' => $project->id
        ]));

        $networksGraph = $networks->map(function ($network) {
           $network = (array) $network;
           return $network;
        });

        $routers = collect($openStack->networkingV2ExtLayer3()->listRouters([
            'tenantId' => $project->id
        ]));

        $routers = $routers->map(function ($router){
           $router = (array) $router;
           $router["external_gateway_info"] = $router["externalGatewayInfo"];
           $router["url"] = "/horizon/project/routers/".$router["id"]."/";
           return $router;
        });

        $ports = collect($openStack->networkingV2()->listPorts());

        $ports = $ports->map(function ($port){
            $port = (array) $port;
            $port["url"] = "/horizon/project/networks/ports/".$port["id"]."/detail";
            $port["device_id"] = $port["deviceId"];
            $port["fixed_ips"] = $port["fixedIps"];
            $port["network_id"] = $port["networkId"];
            return $port;
        });

        $graph = [
            "ports" => $ports->toArray(),
            "routers" => $routers->toArray(),
            "networks" => array_merge([$publicNetwork], $networksGraph->toArray()),
            "servers" => $serversGraph->toArray()

        ];

        // Resource Quota
        $quota = $openStack->computeV2()->getQuotaSet($project->id, true);
        $storageQuota = $openStack->blockStorageV2()->getQuotaSet($project->id, true);

        //Images List
        $images = collect($openStack->imagesV2()->listImages());

        //Flavor List
        $flavors = collect($openStack->computeV2()->listFlavors([], function ($flavor) {
            return $flavor;
        }, true));

        return view('admin.lab.lab', compact('lab','project', 'servers', 'networks', 'quota', 'storageQuota', 'routers', 'images', 'flavors', 'graph'));
    }

    public function createInstance(Lab $lab, Request $request)
    {
        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        $compute = $openStack->computeV2();

        $options = [
            // Required
            'name'     => $request->name,
            'imageId'  => $request->imageId,
            'flavorId' => $request->flavorId,

            // Required if multiple network is defined
            'networks'  => [
                ['uuid' => $request->networkId]
            ],
        ];

        // Create the server
        $compute->createServer($options);

        return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'สร้าง Instance สำเร็จ');
    }

    public function createSubnet(Lab $lab, Request $request)
    {
        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        $networking = $openStack->networkingV2();

        $options = [
            'name'         => $request->networkname,
            'adminStateUp' => true,
        ];

        // Create the network
        $network = $networking->createNetwork($options);

        $optionSubnet = [
            'name'      => $request->subnetname,
            'networkId' => $network->id,
            'ipVersion' => 4,
            'cidr'      => $request->networkaddress,
            'gateway_ip' => $request->gateway
        ];

        // Create the subnet
        $networking->createSubnet($optionSubnet);


        return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'สร้าง Subnet สำเร็จ');
    }

    public function createRouter(Lab $lab, Request $request)
    {
        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        $options = [
            'name' => $request->name,
            'networkId' => $request->networkId,
            'externalGatewayInfo' => [
                'networkId' => $request->networkId,
                'enableSnat' => true
            ]
        ];

        $openStack->networkingV2ExtLayer3()->createRouter($options);

        return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'สร้าง Router สำเร็จ');
    }

    public function updateQuota(Lab $lab, Request $request)
    {
        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        if ($lab->is_predefined_lab) {
            $quota = $openStack->computeV2()->getQuotaSet($lab->project_id, true);
            $quota->retrieve();
            $storageQuota = $openStack->blockStorageV2()->getQuotaSet($lab->project_id, true);
            $storageQuota->retrieve();

            $quota->instances = (int) $request->instances;
            $quota->cores = (int) $request->vcpus;
            $quota->ram = (int) $request->memory;
            $storageQuota->gigabytes = (int) $request->disk;

            $quota->update();
            $storageQuota->update();
        }

        $lab->quota = [
            'instances' => $request->instances,
            'vcpus' => $request->vcpus,
            'memory' => $request->memory,
            'disk' => $request->disk
        ];

        $lab->save();

        return redirect(route('admin.lab.show', $lab->id))->with('alert_success','กำหนด Resource สำเร็จ');
    }

    public function uploadMaterial(Lab $lab, Request $request)
    {
        $filePath = $request->file('file')->store("public/materials/{$lab->id}");

        $fileList = $lab->material_files;
        $fileList[] = [
            'path' => $filePath,
            'name' => $request->name
        ];

        $lab->material_files = $fileList;
        $lab->save();

        return redirect(route('admin.lab.show', $lab->id))->with('alert_success', 'อัพโหลดเอกสารสำเร็จ');
    }

    public function openConsole(Request $request, Lab $lab)
    {
        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        $server = $openStack->computeV2()->getServer([
            'id' => $request->server_id
        ]);

        $console = $server->getSpiceConsole();

        return redirect($console['url']);
    }
}
