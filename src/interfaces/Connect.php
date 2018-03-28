<?php

namespace Sofi\db\interfaces;

interface Connect
{
    function connect(string $dns);
    function disconnect();
    
    function __get($name);
    
}

