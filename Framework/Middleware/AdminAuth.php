<?php

namespace Framework\Middleware;
use Framework\Session;

class AdminAuth{


    /**
     * Require admin session or redirect to login
     */
    public static function requireAdmin()
    {
        if (!Session::get('admin')) {
            redirect('/admin/auth/login');
        }
    }

    /**
     * Require normal user session or redirect to login
     */
    public static function requireUser()
    {
        if (!Session::get('user')) {
            redirect('/auth/login');
        }
    }
}
