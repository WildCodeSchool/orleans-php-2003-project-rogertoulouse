<?php

namespace App\Model;

class SeeArtworksManager extends AbstractManager
{
    const TABLE = 'artworks';
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}