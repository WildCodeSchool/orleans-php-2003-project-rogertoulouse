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
    public function addArtwork(array $artwork)
    {
        $query='INSERT INTO ' . $this->table . ' (name, image, category_id, description, size, more_info) 
        VALUES (:name, :image, :category, :description, :size, :more_info)';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $artwork['name'], \PDO::PARAM_STR);
        $statement->bindValue(':image', $artwork['image'], \PDO::PARAM_STR);
        $statement->bindValue(':category', $artwork['category_id'], \PDO::PARAM_STR);
        $statement->bindValue(':more_info', $artwork['more_info'], \PDO::PARAM_STR);
        $statement->bindValue(':size', $artwork['size'], \PDO::PARAM_STR);
        $statement->bindValue(':description', $artwork['description'], \PDO::PARAM_STR);
        var_dump($artwork);
        $statement->execute();
    }

    public function selectCarousel(): array
    {
        $listSlide = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE carousel = true')->fetchAll();
        return $listSlide;
    }
}
