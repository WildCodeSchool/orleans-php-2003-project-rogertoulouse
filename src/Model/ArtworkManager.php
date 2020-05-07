<?php

namespace App\Model;

class ArtworkManager extends AbstractManager
{
    const TABLE = 'artworks';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectArtworks(int $categoryArtwork = null):array
    {
        $query='SELECT *, a.id as idArtwork FROM ' . $this->table . ' a JOIN works_category c 
        ON a.category_id=c.id'
            . ($categoryArtwork !==null ? ' WHERE c.id=:categoryArtwork' : '' );
        $statement =$this->pdo->prepare($query);
        $statement->bindValue(':categoryArtwork', $categoryArtwork, \PDO::PARAM_INT);
        $statement->execute();
        $artworks = $statement->fetchAll();

        return $artworks;
    }
    public function selectArtwork(int $idArtwork = null)
    {
        $query='SELECT *, a.id as idArtwork FROM ' . $this->table . ' a JOIN works_category c 
        ON a.category_id=c.id WHERE a.id=:idArtwork';
        $statement =$this->pdo->prepare($query);
        $statement->bindValue(':idArtwork', $idArtwork, \PDO::PARAM_INT);
        $statement->execute();
        $artwork = $statement->fetch();
        return $artwork;
    }
    public function deleteArtwork(int $idArtwork, string $picture):void
    {
        $query='DELETE FROM ' . $this->table . ' WHERE id=:idArtwork;';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':idArtwork', $idArtwork, \PDO::PARAM_INT);
        $statement->execute();
        unlink('assets/upload/'.$picture);
    }

    public function selectCarousel(): array
    {
        $listSlide = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE carousel = true')->fetchAll();
        return $listSlide;
    }
}
