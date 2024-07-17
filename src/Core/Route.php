<?php

    namespace App\Core;

    class Route {
        public static function match($router){
            $match = $router->match();

            if( is_array($match) && is_callable( $match['target'] ) ) {
                call_user_func_array( $match['target'], $match['params'] );
            } else {
                // no route was matched
                header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            }
        }
    }