<?php

namespace Sofi\data\db\MongoDB;

class Query extends \Sofi\data\db\Query
{
    
    
    public function all()
    {
        $opt = $this->prepare();
        return $this->provider->find($opt['conditions'], $opt['options']);
    }

    public function one()
    {
        $opt = $this->prepare();
        return $this->provider->findOne($opt['conditions'], $opt['options']);
        
    }
    
    function prepare()
    {
        $options = [
            'projection' => $this->fields
        ];
        
        if (isset($this->specify['sort']) && count($this->specify['sort']) > 0) {
            $options['sort'] = $this->specify['sort'];
        }
        
        if (isset($this->specify['limit'])) {
            $options['limit'] = $this->specify['limit'];
        }
        
        if (isset($this->specify['skip'])) {
            $options['skip'] = $this->specify['skip'];
        }
        
        return ['conditions' => $this->conditions, 'options' => $options];
        
    }

}

