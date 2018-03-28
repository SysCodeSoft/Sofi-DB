<?php

namespace Sofi\db\MongoDB;

class Connect implements \Sofi\db\interfaces\Connect
{
    /**
     *
     * @var \MongoDB\Client
     */
    protected $provider = null;
    
    
    public function connect(string $dns = 'mongodb://localhost:27017/storage')
    {
        if ($dns != '') {
            $this->provider = new \MongoDB\Client($dns);
        }
        
        return $this;
    }

    public function disconnect()
    {
        $this->provider->close();
        
        return $this;
    }
    
    function __get($name)
    {
        return $this->provider->{$name};
    }
    

}

