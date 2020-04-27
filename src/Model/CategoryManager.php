<?php

namespace App\Model;

class CategoryManager extends AbstractManager
{
    const TABLE = 'works_category';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllCategories()
    {
        $categories = $this->pdo->query('SELECT * FROM '.$this->table.'')->fetchAll();
        return $categories;
    }
}
