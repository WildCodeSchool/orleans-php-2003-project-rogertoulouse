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
    public function deleteArtwork(int $idArtwork):void
    {
        $query='DELETE FROM ' . $this->table . ' WHERE id=:idArtwork;';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':idArtwork', $idArtwork, \PDO::PARAM_INT);
        $statement->execute();
    }
    public function updateArtwork(array $artwork):void
    {
        $query='UPDATE ' . $this->table . ' SET 
        name=:name,
        image=:image,
        category_id=:category,
        description=:description,
        size=:size,
        more_info=:more_info,
        carousel=:carousel,
        date=:date 
        WHERE id=:idArtwork;';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':idArtwork', $artwork['idArtwork'], \PDO::PARAM_INT);
        $statement->bindValue(':carousel', $artwork['carousel'], \PDO::PARAM_BOOL);
        $statement->bindValue(':name', $artwork['name'], \PDO::PARAM_STR);
        $statement->bindValue(':image', $artwork['image'], \PDO::PARAM_STR);
        $statement->bindValue(':category', $artwork['category'], \PDO::PARAM_INT);
        $statement->bindValue(':date', $artwork['date'], \PDO::PARAM_STR);
        $statement->bindValue(':more_info', $artwork['more_info'], \PDO::PARAM_STR);
        $statement->bindValue(':size', $artwork['size'], \PDO::PARAM_STR);
        $statement->bindValue(':description', $artwork['description'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectCarousel(): array
    {
        $listSlide = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE carousel = true')->fetchAll();
        return $listSlide;
    }
}
