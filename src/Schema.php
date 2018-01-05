<?php

namespace Sofi\data\db;

abstract class Schema implements interfaces\Schema
{
    protected $provider = null;
    
    protected $name = '';
    protected $collections = [];
    
    function __construct($connection, string $schema) {
        $this->provider = $connection->{$schema};
        $this->name = $schema;
    }
    
    public function __get(string $collection) {
        if (empty($this->collections[$collection])) {
            $this->collections[$collection] = new Collection($this, $collection);       
        }
        
        return $this->collections[$collection];
    }
    
    function getProvider(){
        return $this->provider;
    }
    
    abstract function getQueryBulder($provider);

}

