<?php

    namespace App\Controllers;

    class HomepageController {
        
        public static function index(){
            \App\Core\View::render('homepage');
        }

    }