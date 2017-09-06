<?php

namespace App\Authentication;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use OpenStack\OpenStack;

class KeystoneUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return User::createFromKeystoneAuthenticatableUser(
            KeystoneAuthenticatableUser::createFromSession(unserialize(session('keystone_user')))
        );
    }

    public function retrieveByToken($identifier, $token)
    {
        return User::createFromKeystoneAuthenticatableUser(
            KeystoneAuthenticatableUser::createFromSession(unserialize(session('keystone_user')))
        );
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Do nothing
    }

    public function retrieveByCredentials(array $credentials)
    {
        $openstack = new OpenStack([
            'authUrl'        => env('OS_AUTH_URL'),
            'region'         => env('OS_AUTH_REGION'),
            'requestOptions' => [
                'verify' => env('OS_AUTH_VERIFY_SSL', true)
            ]
        ]);

        $token = $openstack->identityV3()->generateToken([
            'user' => [
                'name'     => $credentials['username'],
                'password' => $credentials['password'],
                'domain'   => [
                    'id' => env('OS_AUTH_DOMAIN')
                ]
            ],
            'scope' => [
                'project' => [
                    'id' => env('OS_AUTH_SCOPE_PROJECT_ID')
                ]
            ]
        ]);

        $user = new KeystoneAuthenticatableUser();
        $user->setToken($token);
        $user->setProfile($token->user);

        return $user;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $openstack = new OpenStack([
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
            'tokenId'        => $user->getAuthPassword()
        ]);

        $profile = $openstack->identityV3()->getUser($user->getAuthIdentifier());
        $profile->retrieve();

        $user->setProfile($profile);

        session()->put('keystone_user', serialize($user));

        return true;
    }
}