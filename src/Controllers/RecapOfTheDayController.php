<?php

    namespace App\Controllers;

    class RecapOfTheDayController {
        
        public static function index(){
            // $recaps = \App\Database\DB::all('recapoftheday');
            $recaps = \App\Services\RecapOfTheDayQuery::tableData();
            \App\Core\View::render('recap-of-the-day' , ['recaps' => $recaps]);
        }

        public static function store(){
            $center = $_POST['center'];
            $type = $_POST['type'];
            $text = $_POST['text'];
            
            $rotd = new \App\Tools\RecapOfTheDay(text: $text , center: $center , type: $type);
            $rotd->save();

            header('Location: /recap-of-the-day');
        }

        public static function destroy(){
            die('destroy');

            header('Location: /recap-of-the-day');
        }

    }