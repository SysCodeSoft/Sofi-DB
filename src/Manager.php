<?php

namespace Sofi\db;

/**
 * @property Sofi\db\interfaces\Connection $default Default connection
 */
class Manager implements \Sofi\Base\interfaces\InitializedInterface
{
    use \Sofi\Base\traits\Init;
    
    /*
     * [
     *  'dns' => ''
     *  'schema' => ''
     *  'provider' => ''
     *  'connection' => [
     *      'db' =>
     *      'schema' =>
     *  ]
     * ]
     */

    protected $dbs = [];

    protected function createConnection($name)
    {
        if (!empty($this->dbs[$name]['provider'])) {
            $this->dbs[$name]['connection'] = [];
            $this->dbs[$name]['connection']['db'] = new $this->dbs[$name]['provider']();
            if (!empty($this->dbs[$name]['dns'])) {
                $this->dbs[$name]['connection']['db']->connect($this->dbs[$name]['dns']);
            } else {
                $this->dbs[$name]['connection']['db']->connect();                
            }
            $this->dbs[$name]['connection']['schema'] = 
                    $this->dbs[$name]['connection']['db']->{$this->dbs[$name]['schema']};
        }
    }

    function __get($name)
    {
        if (empty($this->dbs[$name])) {
            return null;
        }
        
        if (empty($this->dbs[$name]['connection'])) {
            $this->createConnection($name);
        }

        return $this->dbs[$name]['connection']['schema'];
    }

}
