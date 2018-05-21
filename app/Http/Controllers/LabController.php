<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::published()->get();
        if (auth()->user()->current_lab_id) {
	        $currentlab = Lab::findOrFail( auth()->user()->current_lab_id );
        }

        return view('lab.index', compact('labs', 'currentlab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lab = Lab::findOrFail($id);

        return view('lab.show', compact('lab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getroom(Lab $lab)
    {
    	if (auth()->user()->current_project_id && auth()->user()->current_lab_id != $lab->id)
    	{
    	    return redirect(route('lab.show', $lab->id))->with('alert_danger', 'คุณยังมีการทดลองอื่นที่ยังค้างอยู่ ทำให้ไม่สามารถเข้าไปทำการทดลองนี้ได้');
	    }
	    $openStackIdentityService = resolve('OpenStackApi')->identityV3();
		$user = auth()->user();
	    if (is_null($projectId = $user->current_project_id)) {
		    $project = $openStackIdentityService->createProject( [
			    'name'        => "{$lab->id}_" . Carbon::now()->format( 'Y_m_d_His' ) . "_lab",
			    'description' => "A Lab Template of ID #{$lab->id}",
			    'enabled'     => true
		    ] );

		    $project->grantGroupRole( [
			    'groupId' => env( 'OS_ADMIN_GROUP_ID' ),
			    'roleId'  => env( 'OS_ADMIN_ROLE_ID' )
		    ] );

		    $user->current_project_id = $project->id;
		    $user->current_lab_id = $lab->id;
		    $user->save();
	    } else {
		    $project = $openStackIdentityService->getProject($projectId);
		    $project->retrieve();
	    }

	    $openStack = clone resolve('OpenStackApi');
	    $openStack->setProjectScope($user->current_project_id);
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

	    return view('lab.lab', compact('lab','project', 'servers', 'networks', 'quota', 'storageQuota', 'routers', 'images', 'flavors', 'graph'));
    }

	public function createInstance(Lab $lab, Request $request)
	{
		$user = auth()->user();
		$openStack = clone resolve('OpenStackApi');
		$openStack->setProjectScope($user->current_project_id);

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

		return redirect(route('lab.room', $lab->id))->with('alert_success', 'สร้าง Instance สำเร็จ');
	}

	public function createSubnet(Lab $lab, Request $request)
	{
		$user = auth()->user();
		$openStack = clone resolve('OpenStackApi');
		$openStack->setProjectScope($user->current_project_id);

		$networking = $openStack->networkingV2();

		$options = [
			'name'         => $request->networkname
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


		return redirect(route('lab.room', $lab->id))->with('alert_success', 'สร้าง Subnet สำเร็จ');
	}

	public function createRouter(Lab $lab, Request $request)
	{
		$user = auth()->user();
		$openStack = clone resolve('OpenStackApi');
		$openStack->setProjectScope($user->current_project_id);

		$options = [
			'name' => $request->name,
			'netword_id' => $request->networkId
		];

		$openStack->networkingV2ExtLayer3()->createRouter($options);

		return redirect(route('lab.room', $lab->id))->with('alert_success', 'สร้าง Router สำเร็จ');
	}

	public function exitLab(Lab $lab)
	{
		$user = auth()->user();

		$identity = resolve('OpenStackApi')->identityV3();
		$project = $identity->getProject($user->current_project_id);
		$project->delete();

		$user->current_project_id = null;
		$user->current_lab_id = null;
		$user->save();

		return redirect(route('lab.show', $lab->id))->with('alert_success', 'ออกจากการทดลองเรียบร้อย');
	}

	public function terminateInstance(Lab $lab, $projectId, $instanceId)
	{
		$openStack = clone resolve('OpenStackApi');
		$openStack->setProjectScope($projectId);

		$server = $openStack->computeV2()->getServer([
			'id' => $instanceId
		]);

		$server->delete();

		return redirect(route('lab.room', $lab->id))->with('alert_success', 'ลบ Instance สำเร็จ');
	}
}
