<?php

namespace App\Models;

use Core\Models\Model;
use Core\Services\Contracts\DateTime;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $principal
 * @property string $confirmation_token
 * @property string $remember_token
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class User extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected static $guarded = ['id', 'role', 'confirmation_token', 'remember_token', 'created_at', 'updated_at']; // todo $fillable ermöglichen

//    public function beforeInsert()
//    {
//        if (empty($this->role)) {
//            $this->role = 'guest';
//        }
//    }
}
