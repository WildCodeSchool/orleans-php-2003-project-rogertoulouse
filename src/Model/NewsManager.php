<?php

namespace App\Model;

class NewsManager extends AbstractManager
{
    const TABLE = 'news';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    public function selectNews(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll();
    }
    public function update(array $news):bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $news['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $news['title'], \PDO::PARAM_STR);
        $statement->bindValue('button', $news['button'], \PDO::PARAM_STR);
        $statement->bindValue('button_link', $news['button_link'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
