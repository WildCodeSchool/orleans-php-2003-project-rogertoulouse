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
        $newsTitle = $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll();
        return $newsTitle;
    }
}