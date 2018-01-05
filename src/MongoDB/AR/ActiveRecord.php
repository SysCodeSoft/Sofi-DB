<?php

namespace Sofi\data\db\MongoDB\AR;

abstract class ActiveRecord extends \Sofi\data\AR\ActiveRecord
{
   
    public function primaryKey()
    {
        return '_id';
    }

    public function delete()
    {
        
    }
    
    public function find($conditions)
    {
        $db = $this->db();
        $collection = $db->{$this->tableName()};
        $collection = $collection->getProvider();
        $doc = $collection->findOne($conditions);
        if ($doc != null) {
            $this->load((array)$doc);
            
            return true;
        }
        
        return false;
    }
    
    function findAll($conditions)
    {
        $db = $this->db();
        $collection = $db->{$this->tableName()};
        $collection = $collection->getProvider();
        $docs = $collection->find($conditions);
        
        return new \Sofi\data\Dataset($docs, get_class($this));
    }

    function insert()
    {
        $db = $this->db();
        $collection = $db->{$this->tableName()};
        $collection = $collection->getProvider();
        $data = $this->asArray();
        unset($data[$this->primaryKey()]);
        $iResult = $collection->insertOne($data);
    }


    function update()
    {
        
    }

}
