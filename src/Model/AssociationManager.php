<?php

namespace App\Model;

class AssociationManager extends AbstractManager
{
    const TABLE = 'association';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectFirst()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table LIMIT 0,1");
        $statement->bindValue('id', \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function update($association)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET 
        `id` = :id,
        `title` = :title,
        `text` = :text,
        `email` = :email,
        `address` = :address,
        `numberphone` = :numberphone
         WHERE `id` = :id");

        $statement->bindValue('id', $association['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $association['title'], \PDO::PARAM_STR);
        $statement->bindValue('text', $association['text'], \PDO::PARAM_STR);
        $statement->bindValue('email', $association['email'], \PDO::PARAM_STR);
        $statement->bindValue('address', $association['address'], \PDO::PARAM_STR);
        $statement->bindValue('numberphone', $association['numberphone'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
