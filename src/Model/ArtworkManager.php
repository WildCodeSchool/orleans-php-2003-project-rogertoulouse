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
        return $result;
    }

    public function selectOneArtworksByCat()
    {
        $result = $this->pdo->query('SELECT * FROM '.$this->table.' a 
        JOIN works_category c ON a.category_id=c.ID')->fetchAll();

        $listArtwork=[];
        for ($cat=1; $cat<5; $cat++) {
            $temp=[];
            $numb=count($result);
            for($a=0; $a<$numb; $a++) {
                $artwork=$result[$a];
                if ($artwork['ID']==$cat) {
                    $temp[]=$artwork;
                }
            }
            $listArtwork[]=$temp[array_rand($temp)];
            shuffle($listArtwork);
        }
        return $listArtwork;
    }
}
