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


    /**
     * @param array $news
     * @return int
     */
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


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $news
     * @return bool
     */
    public function update(array $news):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $news['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $news['title'], \PDO::PARAM_STR);
        $statement->bindValue('desc', $news['desc'], \PDO::PARAM_STR);
        $statement->bindValue('button', $news['button'], \PDO::PARAM_STR);
        $statement->bindValue('button_link', $news['button_link'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function selectNews(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll();
    }
}
