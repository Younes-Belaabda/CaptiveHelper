<?php

    namespace App\Core;

    class View {

        protected static $loader = null;
        protected static $twig = null;

        public static function init(){
            if(self::$loader === null){
                self::$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../views');
                self::$twig   = new \Twig\Environment(self::$loader, [
                    // 'cache' => '/path/to/compilation_cache',
                ]);
                $function = new \Twig\TwigFunction('asset', function ($name) {
                    return $_ENV['ASSET_URL'] . $name;
                });
                self::$twig->addFunction($function);
            }

        }

        public static function render($name , $params = []){
            self::init();
            echo self::$twig->render($name . '.twig' , $params);
        }
        
    }