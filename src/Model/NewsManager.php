<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class NewsManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'news';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectNews(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll();
    }

    public function insert(array $news): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`,`desc`,`button`,
        `button_link`) VALUES (:title, :desc, :button, :button_link)");
        $statement->bindValue('title', $news['title'], \PDO::PARAM_STR);
        $statement->bindValue('desc', $news['desc'], \PDO::PARAM_STR);
        $statement->bindValue('button', $news['button'], \PDO::PARAM_STR);
        $statement->bindValue('button_link', $news['button_link'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function update(array $new): bool
    {

        // prepared request
        $query = $this->pdo->prepare(" UPDATE " . self::TABLE . " SET `title` = :title, 
         `desc` = :desc, `button` = :button, `button_link` = :button_link WHERE id=:id");
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $new['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $new['title'], \PDO::PARAM_STR);
        $statement->bindValue('desc', $new['desc'], \PDO::PARAM_STR);
        $statement->bindValue('button', $new['button'], \PDO::PARAM_STR);
        $statement->bindValue('button_link', $new['button_link'], \PDO::PARAM_STR);

        return $statement->execute();
    }
    public function deleteNews(int $id):void
    {
        $query='DELETE FROM ' . $this->table . ' WHERE id=:id;';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
