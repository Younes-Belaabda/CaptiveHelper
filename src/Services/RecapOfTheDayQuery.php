<?php

    namespace App\Services;

    class RecapOfTheDayQuery {
        public static function tableData(){
            $pdo = \App\Database\DB::pdo();
            $query = "SELECT recapoftheday.agent , recapoftheday.center , sum(recapoftheday.count) AS total FROM recapoftheday GROUP BY recapoftheday.agent , recapoftheday.center";
            $stmh = $pdo->prepare($query);
            $stmh->execute();
            return $stmh->fetchAll(\PDO::FETCH_ASSOC);
        }

        public static function dataTypesPerAgent($agent , $center){
            $pdo = \App\Database\DB::pdo();
            $query = "SELECT recapoftheday.type , sum(recapoftheday.count) AS count
            FROM recapoftheday
            WHERE recapoftheday.agent = '$agent' AND recapoftheday.center = '$center'
            GROUP BY recapoftheday.agent , recapoftheday.center , recapoftheday.type";
            $stmh = $pdo->prepare($query);
            $stmh->execute();
            return $stmh->fetchAll(\PDO::FETCH_ASSOC);
        }
    }