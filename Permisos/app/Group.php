<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public static function perm_update($user, $model){
        $groups = User::findOrFail($user->id)
            ->groups->where('model', $model);

        foreach ($groups as $group)
        {
            return Acl::findOrFail($group->acl_id)->perm_update;
        }

        return false;

    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function acls(){
        return $this->hasOne('App\Acl');
    }
}
