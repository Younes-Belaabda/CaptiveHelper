<?php

    namespace App\Tools;

    class RecapOfTheDay {
        /**
         * @class RecapOfTheDay
         * @description In our call center we need to know everyday for each agent how many contract signed . 
         */
        public $type = null;
        public $calc_contracts = [];
        public $contracts = [];

        public function __construct($text){
            $text      = $this->cleanup_text($text);
            $contracts = $this->explode_newline($text);
            $this->implode_contracts($contracts);
        }

        public function cleanup_text($text){
            $text = strtoupper($text);
            $text = str_replace("\r" , "" , $text);
            $text = trim($text);
            return $text;
        }

        public function explode_newline($text){
            return explode("\n" , $text);
        }

        public function implode_contracts($contracts){
            foreach($contracts as $key => $row){
                $temp[] = $row;
                if(preg_match('/TO /' , $row)){
                    $this->contracts[] = $temp;
                    $temp = [];
                }
            }
        }

        public function calculate(){

        }
    }