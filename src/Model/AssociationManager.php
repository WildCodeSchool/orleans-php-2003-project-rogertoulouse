<?php

namespace App\Model;

class AssociationManager extends AbstractManager
{
    const TABLE = 'association';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
