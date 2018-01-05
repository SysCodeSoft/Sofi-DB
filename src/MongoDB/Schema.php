<?php

namespace Sofi\data\db\MongoDB;

class Schema extends \Sofi\data\db\Schema
{
 
    public function getQueryBulder($provider)
    {
        return new Query($provider ?? $this->provider);
    }

}

