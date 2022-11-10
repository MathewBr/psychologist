<?php

namespace core;

trait TSingletone{

    private static $instance;

    public static function instance($arg = null){
        if (self::$instance === null) {
            if ($arg === null){
                self::$instance = new self();
            }else{
                self::$instance = new self($arg);
            }
        }
        return self::$instance;
    }

}