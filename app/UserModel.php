<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //define table, primary and fillable field
    protected $table   = 'user';
    protected $primarykey ='userid';
    protected $fillable  = ['email,name,password,role,phone'];



    public function roles() {
        return $this->belongsToMany( 'App\Role' );
    }


    /**
     * checking users role
     *
     * @param array
     * @return bool
     */

    public function is( $roleName ) {
        foreach ($this->roles()->get() as $role) {
            if ($role->roleid == $roleName) {
                return true;
            }
        }

        return false;
    }
}
