<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('menuActive')) {
    function menuActive(array $routes, $output = 'menu-open')
    {
        return in_array(Request::route()->getName(), $routes) ? $output : '';
    }
}

if (!function_exists('phoneLink')) {
    function phoneLink($phone) {
        return preg_replace('/\D+/', '', $phone); // Only digits
    }
}