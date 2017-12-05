<?php

namespace App\Extensions;

use OpenStack\OpenStack;

class OpenStackApi
{
    /**
     * @var OpenStack
     */
    public $instance;

    function __construct($projectId = '')
    {
        $projectId = $projectId ? $projectId : env('OS_AUTH_SCOPE_PROJECT_ID');

        $this->instance = new OpenStack([
            'authUrl'        => env('OS_AUTH_URL'),
            'region'         => env('OS_AUTH_REGION'),
            'requestOptions' => [
                'verify' => env('OS_AUTH_VERIFY_SSL', true)
            ],
            'scope' => [
                'project' => [
                    'id' => $projectId
                ]
            ],
            'tokenId'        => auth()->user()->token
        ]);
    }

    public function setProjectScope($projectId)
    {
        $this->__construct($projectId);
    }

    function __call($name, $arguments)
    {
        return $this->instance->$name(...$arguments);
    }
}