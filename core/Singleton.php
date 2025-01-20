<?php 

namespace PHPFramework;

trait Singleton{

    /**
     *
     * @var self
     */
    public static $instance;

   public function __construct()
    { 
    }

   public function __clone()
    {
    }

   public function __wakeup()
    {
    }

    /**
     * 
     * Arguments passed to getInstance are passed to init(),
     * this only happens on instantiation
     * 
     * @return self
     */
   public static function getInstance(){
        if(self::$instance instanceof self){
            return self::$instance;           
        }       
        return self::$instance = new self;      
    }

}