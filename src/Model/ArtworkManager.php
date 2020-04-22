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
        $result = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.ID')->fetchAll();
        shuffle($result);
        return $result;
    }

    public function selectAllByCategory()
    {
        $listArtwork = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.ID')->fetchAll();

        return $listArtwork;
    }

    public function selectAllArtworksByCat($cat)
    {
        $result = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.ID WHERE c.ID='.$cat.'')->fetchAll();
        shuffle($result);
        return $result;
    }

    public function selectAllByOrder($direction)
    {
        $listArtwork = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.ID ORDER BY a.date '.$direction.'')->fetchAll();

        return $listArtwork;
    }
}
