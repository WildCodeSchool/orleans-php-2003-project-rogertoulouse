<?php

namespace App\Model;

class ArtworkManager extends AbstractManager
{
    const TABLE = 'artworks';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectArtworks($categoryArtwork = null, $idArtwork = null):array
    {
        $statement='SELECT *, a.id as idArtwork FROM ' . $this->table . ' a JOIN works_category c 
        ON a.category_id=c.id'
            . ($categoryArtwork !=null ? ' WHERE c.id=' . $categoryArtwork : '' )
            . ($idArtwork !=null ? ' WHERE a.id=' . $idArtwork : '' );
        $artworks = $this->pdo->query($statement)->fetchAll();
        return $artworks;
    }

    public function selectCarousel(): array
    {
        $listSlide = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE carousel = true')->fetchAll();
        return $listSlide;
    }
}
