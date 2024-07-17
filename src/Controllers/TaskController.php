<?php

    namespace App\Controllers;

    class TaskController {
        
        public static function index(){
            \App\Core\View::render('recap-of-the-day');
        }

    }