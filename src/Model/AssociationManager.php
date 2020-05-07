<?php

namespace App\Model;

class AssociationManager extends AbstractManager
{
    const TABLE = 'association';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    public function selectOneBy()
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=:id LIMIT 0, 1");
        $statement->bindValue('id', \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
