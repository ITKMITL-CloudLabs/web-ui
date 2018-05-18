<?php

namespace App\Extensions;

use Illuminate\Support\Collection;
use OpenStack\OpenStack;

class HotTemplateGenerator
{
    /**
     * @var OpenStack
     */
    private $openStackApi;

    /**
     * @var OpenStack
     */
    private $scopedOpenStackApi;

    private $projectId;

    /**
     * @var Collection
     */
    private $instances, $networks, $routers, $flavors;

    private $template =
<<<EOD
heat_template_version: 2017-02-24

description: How to boot an instance with networks trunked over a port

resources:

EOD;
    
    public function __construct(string $projectId)
    {
        $this->openStackApi = resolve('OpenStackApi');

        $this->scopedOpenStackApi = clone resolve('OpenStackApi');
        $this->scopedOpenStackApi->setProjectScope($projectId);

        $this->projectId = $projectId;

        $this->fetchTopology();
        $this->generateHotTemplate();

        dd($this->template);
    }

    private function fetchTopology()
    {
        $this->getInstances();
        $this->getNetworks();
        $this->getRouters();
    }

    private function generateHotTemplate()
    {
        $this->generateInstanceList();
        $this->generateSubnetList();
    }

    private function generateInstanceList()
    {
        foreach ($this->instances as $instance) {
            $volume = iterator_to_array($instance->listVolumeAttachments())[0];
            $snapshot = $this->scopedOpenStackApi->blockStorageV2()->createSnapshot([
                'projectId' => $volume->volumeId,
                'volumeId' => $volume->volumeId,
                'name' => $instance->name.date('Y-m-d-His'),
                'force' => true
            ]);

            $type = "OS::Nova::Server";
            $name = $instance->name;
            $flavor = $instance->flavor->id;
            $image = $snapshot->id;

            $networks = [];
            foreach ($instance->addresses as $networkName => $address) {
                $networks[] = "{fixed_ip: {$address[0]['addr']}, subnet: { get_resource: {$networkName} }}";
            }

            $this->template .= "  {$name}:\n";
            $this->template .= "    type: {$type}\n";
            $this->template .= "    properties:\n";
            $this->template .= "      flavor: {$flavor}\n";
            $this->template .= "      block_device_mapping_v2: [.json_encode(['snapshot_id' => $image]).]\n";
            $this->template .= "      networks: ".json_encode($networks)."\n\n";
        }
    }

    private function generateSubnetList()
    {
        foreach ($this->networks as $subnet) {
            $subnet = $this->scopedOpenStackApi->networkingV2()->getSubnet($subnet->subnets[0]);
            $subnet->retrieve();


            $name = $subnet->name;

            $this->template .= "  {$name}:\n";
            $this->template .= "    type: OS::Neutron::Subnet\n";
            $this->template .= "    properties:\n";
            $this->template .= "      allocation_pools: [".json_encode($subnet->allocationPools[0])."]\n";
            $this->template .= "      cidr: {$subnet->cidr}\n";
            $this->template .= "      enable_dhcp: ".($subnet->enableDhcp ? 'true' : 'false')."\n";
            $this->template .= "      gateway_ip: {$subnet->gatewayIp}\n";
            $this->template .= "      ip_version: {$subnet->ipVersion}\n";
            $this->template .= "      name: {$name}\n";
            $this->template .= "      network: { get_resource: {$name}_net }\n\n";

            $this->template .= "  {$name}_net:\n";
            $this->template .= "    type: OS::Neutron::Net\n\n";
        }
    }

    private function getInstances()
    {
        $this->instances = collect($this->scopedOpenStackApi->computeV2()->listServers(true));
    }

    private function getNetworks()
    {
        $this->networks = collect($this->scopedOpenStackApi->networkingV2()->listNetworks([
            'tenantId' => $this->projectId
        ]));
    }

    private function getRouters()
    {
        $this->routers = collect($this->scopedOpenStackApi->networkingV2ExtLayer3()->listRouters([
            'tenantId' => $this->projectId
        ]));
    }
}