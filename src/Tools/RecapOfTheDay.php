<?php


    namespace App\Tools;
    use App\Core\Session;

    class RecapOfTheDay {
        /**
         * @class RecapOfTheDay
         * @description In our call center we need to know everyday for each agent how many contract signed . 
         */

        public static $types = [];
        public static $centers = [];

        public $center = null;
        public $type   = null;
        public $contracts = [];

        public function __construct($text , $type , $center){
            $this->type = $type;
            $this->center = $center;

            $this->addType($type);
            $this->addCenter($center);

            $text       = $this->cleanup_text($text);
            $contracts  = $this->explode_newline($text);
            $this->implode_contracts($contracts);
        }

        public function addType($type){
            if(!in_array($type , self::$types , true))
                self::$types[] = $type;
        }

        public function addCenter($center){
            if(!in_array($center , self::$centers , true))
                self::$centers[] = $center;
        }

        public function getTypes(){
            return self::$types;
        }

        public function getCenters(){
            return self::$centers;
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

        public function get_names(){
            $names = [];
            foreach($this->contracts as $contract){
                foreach($contract as $row){
                    if(preg_match('/TO /' , $row)){
                        $names[] = preg_replace('/TO /' , '' , $row);
                    }
                }
            }
            return $names;
        }

        public function calculate(){
            $calc_contracts = [];
            $names = $this->get_names();
            foreach($names as $name){
                if(!array_key_exists($name , $calc_contracts)){
                    $calc_contracts[$name] = 1;
                }else{
                    $calc_contracts[$name] = $calc_contracts[$name] + 1;
                }
            }
            return $calc_contracts;
        }

        public function save(){
            $calc_contracts = [];
            $contracts = $this->calculate();
            foreach($contracts as $key => $value){
                $calc_contracts[] = [
                    'name'   => $key,
                    'center' => $this->center,
                    'types'  => [
                        $this->type => $value
                    ]
                ];
            }
            // Save To Session
            Session::set('contracts' , $calc_contracts);
            return Session::get('contracts');
        }
        
    }