<?php

namespace Sofi\db\MongoDB;

class Query extends \Sofi\db\Query
{
    
    
    public function all()
    {
        $opt = $this->prepare();
        $docs = $this->provider->find($opt['conditions'], $opt['options']);
        
        return new \Sofi\data\Dataset($docs, $this->as);
    }

    public function one()
    {
        $opt = $this->prepare();
//        \Sofi\Base\d($opt);
        $doc = $this->provider->findOne($opt['conditions'], $opt['options']);
        
        return new $this->as((array)$doc);        
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

