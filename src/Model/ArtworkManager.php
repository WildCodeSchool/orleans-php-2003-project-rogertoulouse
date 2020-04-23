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
        $listArtwork = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.ID')->fetchAll();
        shuffle($listArtwork);
        return $listArtwork;
    }

    public function selectArtworksByCategory($idCategory)
    {
        $artworksByCategory = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.ID WHERE c.ID='.$idCategory.'')->fetchAll();
        shuffle($artworksByCategory);
        return $artworksByCategory;
    }

    public function selectAllByDate($direction = 'ASC')
    {
        $listArtworks = $this->pdo->query('SELECT * FROM ' . $this->table . ' a 
        JOIN works_category c ON a.category_id=c.ID ORDER BY a.date ' . $direction . '')->fetchAll();
        return $listArtworks;
    }

    public function selectAllArtByDate()
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' a 
        JOIN works_category c ON a.category_id=c.ID ORDER BY `date` ASC')->fetchAll();
    }
}
