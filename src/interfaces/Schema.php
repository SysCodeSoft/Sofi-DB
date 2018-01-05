<?php

namespace Sofi\data\db\interfaces;

interface Schema
{
    function __construct($connection, string $schema);
}

