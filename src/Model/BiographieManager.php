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
class BiographieManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'biography';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $biography
     * @param null $name
     * @param int $is_art
     * @param null $image
     * @return int
     */
    public function insert(array $biography, $name = null, $is_art = 0, $image = null ): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`name`, `date`, `info`, `is_art`, `image`) VALUES (:name, :date, :info, :is_art, :image)");
        $statement->bindValue('date', $biography['date'], \PDO::PARAM_STR);
        $statement->bindValue('info', $biography['info'], \PDO::PARAM_STR);
        if (isset($biography['art'])) {
            $name = $biography['name'];
            $is_art = $biography['art'];
            $image = $biography['image'];
        }
        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->bindValue('is_art', $is_art, \PDO::PARAM_INT);
        $statement->bindValue('image', $image, \PDO::PARAM_STR);
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
     * @param array $biography
     * @return bool
     */
    public function update(array $biography, $name = null, $is_art = 0, $image = null ):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `name` = :name, `date` = :date, `info` = :info, `is_art` = :is_art, `image` = :image WHERE id=:id");
        $statement->bindValue('id', $biography['id'], \PDO::PARAM_INT);
        $statement->bindValue('date', $biography['date'], \PDO::PARAM_STR);
        $statement->bindValue('info', $biography['info'], \PDO::PARAM_STR);
        if (isset($biography['art'])) {
            $name = $biography['name'];
            $is_art = $biography['art'];
            $image = $biography['image'];
        }
        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->bindValue('is_art', $is_art, \PDO::PARAM_INT);
        $statement->bindValue('image', $image, \PDO::PARAM_STR);

        return $statement->execute();
    }
}
