<?php

namespace App\Extensions;

use OpenStack\OpenStack;

class OpenStackApi
{
    /**
     * @var OpenStack
     */
    public $instance;

    function __construct()
    {
        $this->instance = new OpenStack([
            'authUrl'        => env('OS_AUTH_URL'),
            'region'         => env('OS_AUTH_REGION'),
            'requestOptions' => [
                'verify' => env('OS_AUTH_VERIFY_SSL', true)
            ],
            'scope' => [
                'project' => [
                    'id' => env('OS_AUTH_SCOPE_PROJECT_ID')
                ]
            ],
            'tokenId'        => auth()->user()->token
        ]);
    }

    function __call($name, $arguments)
    {
        return $this->instance->$name(...$arguments);
    }
}