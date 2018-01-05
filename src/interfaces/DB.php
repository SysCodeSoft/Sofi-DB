<?php

namespace Sofi\data\db\interfaces;

interface DB
{
    function connect(string $dns);
    function disconnect();
    
    function getInstance();
    
    function __get(string $schema);
}

