<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\HotTemplateGenerator;
use App\Models\Lab;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
        $predefinedlab = Lab::predefinedlab()->get();
        $notdefinedlab = Lab::notdefinedlab()->get();
        return view('admin.lab.index', compact('labs', 'predefinedlab', 'notdefinedlab'));
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
    	if ($lab->project_id) {
    		$identity = resolve('OpenStackApi')->identityV3();
		    $project = $identity->getProject($lab->project_id);
		    $project->delete();
	    }

	    $labactives = User::where('current_lab_id', $lab->id)->get();
		if ($labactives) {
			foreach ( $labactives as $labactive ) {
				$project = $identity->getProject( $labactive->current_project_id );
				$project->delete();
				$user                     = User::findOrFail( $labactive->id );
				$user->current_project_id = null;
				$user->current_lab_id     = null;
				$user->save();
			}
		}

        $lab->delete();

        return redirect(route('admin.lab.index'))->with('alert_success', 'ห้องทดลองได้ถูกลบแล้ว');
    }

    public function terminateLab(Lab $lab)
    {

	    $identity = resolve('OpenStackApi')->identityV3();
	    $project = $identity->getProject($lab->project_id);
	    $project->delete();

	    $labactives = User::where('current_lab_id', $lab->id)->get();

	    foreach ($labactives as $labactive){
		    $project = $identity->getProject($labactive->current_project_id);
		    $project->delete();
		    $user = User::findOrFail($labactive->id);
		    $user->current_project_id = null;
		    $user->current_lab_id = null;
		    $user->save();
	    }

	    $lab->project_id = null;
	    $lab->save();

	    return redirect(route('admin.lab.show', $lab->id))->with('alert_success', 'ห้องทดลองได้ถูกทำลายแล้ว');

    }

    public function terminateLabStudent($projectId)
    {
    	$user = User::where('current_project_id', $projectId)->first();
	    $identity = resolve('OpenStackApi')->identityV3();
	    $project = $identity->getProject($projectId);
	    $project->delete();
	    $user->current_project_id = null;
	    $user->current_lab_id = null;
	    $user->save();

	    return redirect(route('admin.activelab'))->with('alert_success', 'ห้องทดลองได้ถูกยุบแล้ว');

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

        $subnets = [];
        foreach ($networks as $network) {

            $networking = $openStack->networkingV2();
            $subnet = $networking->getSubnet($network->subnets[0]);
            $subnet->retrieve();

            $subnets[] = $subnet;
        }

        return view('admin.lab.lab', compact('lab','project', 'servers', 'networks', 'quota', 'storageQuota', 'routers', 'images', 'flavors', 'graph', 'subnets'));
    }

    public function deleteSubnet(Lab $lab, $subnetId)
    {
        $networking = resolve('OpenStackApi')->networkingV2();
        $subnet = $networking->getSubnet($subnetId);
        $subnet->retrieve();

        $network = $networking->getNetwork($subnet->networkId);
        $network->delete();

        return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'การลบ Subnet สำเร็จ');
    }

    public function createInstance(Lab $lab, Request $request)
    {
        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        $compute = $openStack->computeV2();

        $flavor = $compute->getFlavor(['id' => $request->flavorId]);
        $flavor->retrieve();

        $options = [
            // Required
            'name'     => $request->name,
//            'imageId'  => $request->imageId,
            'flavorId' => $request->flavorId,

            // Required if multiple network is defined
            'networks'  => [
                ['uuid' => $request->networkId]
            ],

            'blockDeviceMapping' => [
                [
                    'bootIndex' => 0,
                    'sourceType' => 'image',
                    'uuid' => $request->imageId,
                    'volumeSize' => $flavor->disk,
                    'destinationType' => 'volume',
                    'deleteOnTermination' => true
                ]
            ]
        ];

        // Create the server
        $server = $compute->createServer($options);

        $server->retrieve();

        return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'สร้าง Instance สำเร็จ');
    }

    public function createSubnet(Lab $lab, Request $request)
    {
        $openStack = clone resolve('OpenStackApi');
        $openStack->setProjectScope($lab->project_id);

        $networking = $openStack->networkingV2();

        $options = [
            'name'         => $request->subnetname,
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

        $router = $openStack->networkingV2ExtLayer3()->createRouter($options);

        $router->addInterface([
        	'subnetId' => $request->subnetId
        ]);

        return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'สร้าง Router สำเร็จ');
    }

	public function deleteRouter(Lab $lab, $routerId)
	{
		$openStack = clone resolve('OpenStackApi');
		$openStack->setProjectScope($lab->project_id);

		$router = $openStack->networkingV2ExtLayer3()->getRouter($routerId);
		$router->retrieve();

		$getPorts = $openStack->networkingV2()->listPorts([
			'deviceId' => $router->id,
			'device_owner' => 'network:router_interface'
		]);

		$ports = iterator_to_array($getPorts);

		foreach ($ports as $port) {
			$router->removeInterface( [
				'portId' => $port->id
			] );
			$router->delete();
		}

		return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'ลบ Router สำเร็จ');
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

    public function generateHotTemplate(Lab $lab)
    {
        $template = new HotTemplateGenerator($lab->project_id);
        $lab->hot_template = $template->getTemplate();
        $lab->save();

        return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'การสร้าง Template สำเร็จ');
    }

    public function showHotTemplate(Lab $lab)
    {
        dd($lab->hot_template);
    }

    public function labActive()
    {
    	$labs = User::whereNotNull('current_lab_id')->with('currentLab')->get();

    	return view('admin.lab.labrun', compact('labs'));
    }

    public function observeLab(Lab $lab, $projectId)
    {
	    $openStackIdentityService = resolve('OpenStackApi')->identityV3();

	    $project = $openStackIdentityService->getProject($projectId);
	    $project->retrieve();

	    $openStack = clone resolve('OpenStackApi');
	    $openStack->setProjectScope($projectId);

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

        $subnets = [];
        foreach ($networks as $network) {

            $networking = $openStack->networkingV2();
            $subnet = $networking->getSubnet($network->subnets[0]);
            $subnet->retrieve();

            $subnets[] = $subnet;
        }

	    return view('admin.lab.lab', compact('lab','project', 'servers', 'networks', 'quota', 'storageQuota', 'routers', 'images', 'flavors', 'graph', 'projectId', 'subnets'));
    }

    public function terminateInstance(Lab $lab, $instanceId)
    {
	    $openStack = clone resolve('OpenStackApi');
	    $openStack->setProjectScope($lab->project_id);

	    $server = $openStack->computeV2()->getServer([
		    'id' => $instanceId
	    ]);

	    $server->delete();

	    return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'ลบ Instance สำเร็จ');
    }

    public function rebootInstance(Lab $lab, $instanceId)
    {
	    $openStack = clone resolve('OpenStackApi');
	    $openStack->setProjectScope($lab->project_id);

	    $server = $openStack->computeV2()->getServer([
		    'id' => $instanceId
	    ]);

	    $server->reboot();

	    return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'Reboot Instance สำเร็จ');
    }

	public function stopInstance(Lab $lab, $instanceId)
	{
		$openStack = clone resolve('OpenStackApi');
		$openStack->setProjectScope($lab->project_id);

		$server = $openStack->computeV2()->getServer([
			'id' => $instanceId
		]);

		$server->retrieve();

		if ($server->vmState == 'active')
		{
			$server->stop();
		}

		return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'Stop Instance สำเร็จ');
	}

	public function startInstance(Lab $lab, $instanceId)
	{
		$openStack = clone resolve('OpenStackApi');
		$openStack->setProjectScope($lab->project_id);

		$server = $openStack->computeV2()->getServer([
			'id' => $instanceId
		]);
		$server->retrieve();

		if ($server->vmState == 'stopped')
		{
			$server->start();
		}

		return redirect(route('admin.lab.prepare', $lab->id))->with('alert_success', 'Start Instance สำเร็จ');
	}
}
