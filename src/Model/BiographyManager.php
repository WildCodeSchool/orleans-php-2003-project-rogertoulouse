<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

use DateTime;

/**
 *
 */
class BiographyManager extends AbstractManager
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
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllBioByDate(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' ORDER BY `date` ASC')->fetchAll();
    }


    /**
     * @param string $year
     * @param string $biography
     * @return bool
     */
    public function insert(string $year, string $biography): bool
    {
        // prepared request
        $statement = $this->pdo->prepare("
INSERT INTO " . self::TABLE . " (`date`, `info`) VALUES (:date, :info)");
        $statement->bindValue('date', $year, \PDO::PARAM_STR);
        $statement->bindValue('info', $biography, \PDO::PARAM_STR);
        return $statement->execute();
    }
}
