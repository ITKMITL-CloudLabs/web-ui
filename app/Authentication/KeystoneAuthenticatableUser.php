<?php

namespace App\Authentication;

use Illuminate\Contracts\Auth\Authenticatable;
use OpenStack\Identity\v3\Models\Token;
use OpenStack\Identity\v3\Models\User;

class KeystoneAuthenticatableUser implements Authenticatable
{
    private $tokenId;
    public $tokenExpiredAt;
    public $id;
    public $email;
    public $enabled;
    public $description;
    public $links;
    public $name;
    public $domainId;
    public $defaultProjectId;

    public function setToken(Token $token)
    {
        $this->tokenId = $token->getId();
        $this->tokenExpiredAt = $token->expires;
    }

    public function getTokenId()
    {
        return $this->tokenId;
    }

    public function setProfile(User $user)
    {
        $this->id = $user->id;
        $this->email = $user->email;
        $this->enabled = $user->enabled;
        $this->description = $user->description;
        $this->links = $user->links;
        $this->name = $user->name;
        $this->domainId = $user->domainId;
        $this->defaultProjectId = $user->defaultProjectId;
    }

    public function getId()
    {
        return $this->getAuthIdentifier();
    }

    public static function createFromSession($unserializedUser)
    {
        $user = new self();

        $user->tokenId = $unserializedUser->tokenId;
        $user->tokenExpiredAt = $unserializedUser->tokenExpiredAt;
        $user->id = $unserializedUser->id;
        $user->email = $unserializedUser->email;
        $user->enabled = $unserializedUser->enabled;
        $user->description = $unserializedUser->description;
        $user->links = $unserializedUser->links;
        $user->name = $unserializedUser->name;
        $user->domainId = $unserializedUser->domainId;
        $user->defaultProjectId = $unserializedUser->defaultProjectId;

        return $user;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->tokenId;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return '';
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Do nothing
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return '';
    }

}