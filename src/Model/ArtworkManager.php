<?php

namespace App\Model;

class ArtworkManager extends AbstractManager
{
    const TABLE = 'artworks';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllArtworks()
    {
        $result = $this->pdo->query('SELECT * FROM '.$this->table)->fetchAll();
        return $result;
    }
}
