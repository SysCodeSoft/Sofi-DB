<?php

namespace Sofi\data\db\MongoDB;

class DB implements \Sofi\data\db\interfaces\DB
{
    /**
     *
     * @var \MongoDB\Client
     */
    protected $provider = null;
    
    protected $schema;
    
    function __construct($dns = 'mongodb://localhost:27017') {
        if ($dns != null) $this->connect($dns);
    }

    public function connect(string $dns)
    {
        if ($dns != '') {
            $this->provider = new \MongoDB\Client($dns);
        }
    }

    public function disconnect()
    {
        $this->provider->close();
    }
    
    function getInstance()
    {
        return $this->getSchema($this->schema);
    }

    /**
     * 
     * @param string $schema
     * @return Schema
     */
    public function __get(string $schema) {
        return new Schema($this->provider, $schema);
    }
    
    function getProvider(){
        return $this->provider;
    }
    
    /**
     * 
     * @param type $name
     * @return Schema
     */
    public function getSchema($name)
    {
        return $this->{$name};
    }
    

}

