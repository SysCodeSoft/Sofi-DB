<?php

namespace Sofi\db\MongoDB\traits;

trait ActiveRecord
{

    static public function primaryKey()
    {
        return '_id';
    }

    public function delete()
    {
        
    }

    static public function findByPK($id)
    {
        $db = self::db();
        $collection = $db->{self::tableName()};
        $pk = self::primaryKey();
        $conditions = [];
        $conditions[$pk] = $id;

        return (new \Sofi\db\MongoDB\Query($collection, get_called_class(), $conditions))->one();
    }

    static public function find($conditions)
    {
        $db = self::db();
        $collection = $db->{self::tableName()};
//        var_dump($collection, $db);
        return new \Sofi\db\MongoDB\Query($collection, get_called_class(), $conditions);
    }
    
    static function commands()
    {
        $db = self::db();
        return $db->{self::tableName()}; 
    }

    function insert()
    {
        $db = self::db();
        $collection = $db->{self::tableName()};
        $data = $this->asArray();
        if (empty($data[self::primaryKey()]))
            unset($data[self::primaryKey()]);
//        var_dump($data);
        $iResult = $collection->insertOne($data);
    }

    function update()
    {
        $db = self::db();
        $collection = $db->{self::tableName()};

        $pk = self::primaryKey();
        $data = $this->asArray();
        $cond = [];
        if (is_array($data[$pk])) {
            $cond[$pk] = new \MongoDB\BSON\ObjectId($data[$pk]['oid']);
        } else {
            $cond[$pk] = $data[$pk];
        }
        unset($data[$pk]);

//        echo '<br>';
//        var_dump($cond);
//        echo '<br>';
//        var_dump($data);
//        echo '<br>';

        $iResult = $collection->updateOne($cond, ['$set' => $data]);
//        \Sofi\Base\Sofi::d($iResult);
        return $iResult->getModifiedCount() == 1;
    }

    public function upsert()
    {
        
    }

}
