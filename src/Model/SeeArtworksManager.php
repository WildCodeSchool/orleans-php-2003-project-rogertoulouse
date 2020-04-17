<?php

namespace App\Model;

class SeeArtworksManager extends AbstractManager
{
    const TABLE = 'artworks';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllArtworks()
    {
        $result = $this->pdo->query('SELECT * FROM '.$this->table.
            ' JOIN works_category c ON '.$this->table.'.category_id=c.ID')->fetchAll();
        return $result;
    }
}
