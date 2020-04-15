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
     * @return int
     */
    public function insert(array $biography): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`date`, `info`) VALUES (:date, :info)");
        $statement->bindValue('date', $biography['date'], \PDO::PARAM_STR);
        $statement->bindValue('info', $biography['info'], \PDO::PARAM_STR);
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
    public function update(array $biography):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `date` = :date, `info` = :info WHERE id=:id");
        $statement->bindValue('id', $biography['id'], \PDO::PARAM_INT);
        $statement->bindValue('date', $biography['date'], \PDO::PARAM_STR);
        $statement->bindValue('info', $biography['info'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllDate(): array
    {
        return $this->pdo->query('SELECT DISTINCT YEAR(`date`) AS date FROM ' . $this->table)->fetchAll();
    }
    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllByDate(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' ORDER BY `date` ASC')->fetchAll();
    }
}
