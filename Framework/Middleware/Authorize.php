<?php

namespace Framework\middleware;

use Framework\Session;

class Authorize{
    /**
     * Check if user is authenticated
     * 
     * @return bool
     */

    public function isAuthenticated(){
        return Session::has("user");
    }


    /**
     * Handle the user's request
     * 
     * @param string $role
     * @return void
     */
    public function handle($role){
        if($role === 'guest' && $this->isAuthenticated()){
             
            return redirect('/user/account-settings');
            
        }elseif($role === 'auth'&& !$this->isAuthenticated()){
            return redirect('/auth/login');
        }

    }
}