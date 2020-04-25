<?php

namespace App\Model;

class ArtworkManager extends AbstractManager
{
    const TABLE = 'artworks';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectArtworks($categorie)
    {
        $artworks = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.id where c.id='.$categorie.'')->fetchAll();
        shuffle($artworks);
        return $artworks;
    }

    public function selectCarousel(): array
    {
        $listSlide = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE carousel = true')->fetchAll();
        return $listSlide;
    }
}
