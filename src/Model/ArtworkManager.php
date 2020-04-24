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
        $artworks = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.id')->fetchAll();
        shuffle($artworks);
        return $artworks;
    }

    public function selectArtworksByCategory($idCategory)
    {
        $artworksByCategory = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.id WHERE c.id LIKE '.$idCategory.'')->fetchAll();
        shuffle($artworksByCategory);
        return $artworksByCategory;
    }

    public function selectAllByDate($direction = 'ASC')
    {
        $listArtworks = $this->pdo->query('SELECT * FROM ' . $this->table . ' a 
        JOIN works_category c ON a.category_id=c.id ORDER BY a.date ' . $direction . '')->fetchAll();
        return $listArtworks;
    }

    public function selectCarousel(): array
    {
        $listSlide = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE carousel = true')->fetchAll();
        return $listSlide;
    }

    public function selectAllArtByDate()
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' a 
        JOIN works_category c ON a.category_id=c.id ORDER BY `date` ASC')->fetchAll();
    }
}
