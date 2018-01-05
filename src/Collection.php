<?php

namespace Sofi\data\db;

class Collection implements interfaces\Collection
{
 
    /**
     *
     * @var Schema
     */
    protected $schema = null;    
    protected $provider = null;    
    /**
     *
     * @var Query
     */
    protected $query = null;
    
    protected $name = '';
    
    function __construct(Schema $Schema, $name) {
        $this->schema = $Schema;
        $this->provider = $Schema->getProvider()->{$name};
        $this->name = $name;
    }
    
    /**
     * 
     * @return Query
     */
    function query()
    {
        if ($this->query == null)
        {
            $this->query = $this->schema->getQueryBulder($this->provider);
        }
        
        return $this->query;
    }
    
    function getProvider()
    {
        return $this->provider;
    }
    
}

