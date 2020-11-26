<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public const VALIDATION = ['email' => 'required|email|max:255', 'password' => 'required|max:255'];
    public const REGISTER_VALIDATION = [
        'email' => 'required|unique:App\Models\User,email',
        'password' => 'required|min:8|max:15',
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'address_no' => 'required',
        'zoi' => 'required',
        'road' => 'required',
        'district' => 'required',
        'amphure' => 'required',
        'province' => 'required',
        'zip' => 'required',
    ];


    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'activate',
        'file_image',
        'first_name',
        'last_name',
        'phone',
        'address',
        'address_no',
        'zoi',
        'road',
        'district',
        'amphure',
        'province',
        'zip',
        'firebase_uid',
        'shop_name',
        'lat',
        'lng',
        'line',
        'facebook',
        'instagram',
        'twitter'
    ];

    public function roles()
    {
        return $this->hasMany(RoleUser::class, 'user_id', 'id');
    }

    public function hasRole($roleId)
    {
        if (RoleUser::where('role_id', $roleId)->where('user_id', $this->id)->first()) {
            return true;
        }
        return false;
    }

    public function clearRoles()
    {
        if (RoleUser::where('user_id', $this->id)->delete()) {
            return true;
        }
        return false;
    }

    public function assignRole($roleId)
    {
        RoleUser::create(['role_id' => (int)$roleId, 'user_id' => $this->id]);
    }

    public function getTextRoles()
    {
        $rolesText = '';
        $roles = $this->roles;
        foreach ($roles as $role) {
            $rolesText .= $role->role->label . ', <br>';
        }
        return $rolesText;
    }
    public function getIdRoles()
    {
        $rolesId = '';
        $roles = $this->roles;
        foreach ($roles as $role) {
            // $rolesText .= $role->role->label . ', <br>';
            $rolesId .= $role->role->id ;
        }
        return $rolesId;
    }
}
