<?php

namespace Chatter\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    public function authenticate($apikey)
    {
        $api_user = User::where('apikey', '=', $apikey)->take(1)->get();
        $this->details = $api_user[0];

        return ($api_user[0]->exists) ? true : false;
    }
}