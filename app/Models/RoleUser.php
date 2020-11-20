<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['role_id', 'user_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
