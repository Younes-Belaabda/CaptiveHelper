<?php

    namespace App\Database;

    class DB {

        private static $db = null;

        public static function connect(){
            if(self::$db === null){
                $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
                $dotenv->load();
                $dsn      = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
                $username = $_ENV['DB_USER'];
                $password = $_ENV['DB_PASSWORD'];
                self::$db = new \PDO($dsn , $username , $password);
            }
        }

        public static function exist($table , $columns , $values){
            self::connect();
            $query = "SELECT id FROM $table WHERE ";
            foreach($columns as $key => $value){
                if($key === 0){
                    $query .= "$value = " . $values[$key];
                }else{
                    $query .= "AND $value = " . $values[$key];
                }
            }
            $sth = self::$db->prepare($query);
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }

        public static function insert($table , $columns , $values){
            self::connect();
            $query = "INSERT INTO " . $table . " (". implode(',' , $columns) .") VALUES (" . $values . ")";
            return self::$db->exec($query);
        }

        public static function update($table , $id , $columns , $values){
            self::connect();
            $query = "UPDATE " . $table . " SET ";
            foreach($columns as $key => $value){
                if($key != count($columns) - 1){
                    $query .= "$value = " . $values[$key] . " , ";
                }else{
                    $query .= "$value = " . $values[$key];
                }
            }
            $query .= " WHERE id = " . $id  . ";";
            return self::$db->exec($query);
        }

        public static function all($table){
            self::connect();
            $query = "SELECT * FROM $table";
            $sth = self::$db->prepare($query);
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
    }