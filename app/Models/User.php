<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;

    protected $hidden = [
        'token', 'token_expired_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'token_expired_at',
        'logged_in_at',
    ];

    protected $casts = [
        'enabled' => 'boolean'
    ];

    protected $fillable = [
        'role', 'name'
    ];

    protected $appends = [
        'role_text'
    ];

    public static function createFromKeystoneAuthenticatableUser($unserializedUser)
    {
        $user = self::findOrNew($unserializedUser->id);

        $user->id = $unserializedUser->id;
        $user->token = $unserializedUser->getTokenId();
        $user->token_expired_at = $unserializedUser->tokenExpiredAt;
        $user->enabled = $unserializedUser->enabled;
        $user->description = $unserializedUser->description;
        $user->name = $unserializedUser->name;
        $user->domain_id = $unserializedUser->domainId;
        $user->os_default_project_id = $unserializedUser->defaultProjectId;

        $user->save();

        return $user;
    }

    public function isAdmin()
    {
    	return $this->is_admin;
    }

    public function scopeOnlyInstructor($query)
    {
        return $query->where('role', 'instructor');
    }

    public function scopeOnlyStudent($query)
    {
        return $query->where('role', 'student');
    }

    public function scopeOnlyTA($query)
    {
        return $query->where('role', 'ta');
    }

    public function getRoleTextAttribute()
    {
        switch ($this->role) {
            case 'student':
                return 'นักเรียน';
            case 'instructor':
                return 'อาจารย์';
            case 'ta':
                return 'ผู้ช่วยสอน';
        }
    }

    public function currentLab()
    {
    	return $this->belongsTo(Lab::class, 'current_lab_id');
    }

}
