<?php

namespace Sofi\data\db;

abstract class Query implements interfaces\Query
{
    protected $provider;
    
    protected $conditions = [];
    protected $fields = [];
    protected $specify = [];
            
    function __construct($provider = null)
    {
        $this->provider = $provider;
    }
       
    
    /**
     * 
     * @return Query
     */
    function limit($limit)
    {
        $this->specify['limit'] = $limit;
        
        return $this;
    }
    
    /**
     * 
     * @return Query
     */
    function skip($count)
    {
        $this->specify['skip'] = $count;
        
        return $this;
    }
    
    /**
     * 
     * @return Query
     */
    function sort($prop, $direct = 1)
    {
        $this->specify['sort'][$prop] = $direct;
        
        return $this;
    }
    
    /**
     * 
     * @return Query
     */
    function unsort($prop)
    {
        unset($this->specify['sort'][$prop]);
        
        return $this;
    }
    
    /**
     * 
     * @return Query
     */
    function excluding(...$prop)
    {
        foreach ($prop as $val)
            $this->fields[$val] = 0;
        
        return $this;
    }
    
    /**
     * 
     * @return Query
     */
    function including(...$prop)
    {
        foreach ($prop as $val)
            $this->fields[$val] = 1;
        
        return $this;
    }
    
    /**
     * 
     * @return Query
     */
    function fields(array $prop)
    {
        $this->fields = $prop;
        
        return $this;
    }
    
    
    abstract function prepare();
    
}

