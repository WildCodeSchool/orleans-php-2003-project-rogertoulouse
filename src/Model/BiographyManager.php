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
class BiographyManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'biography';
    const ART_TABLE = 'artworks';

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

    public function selectAllArtByDate()
    {
        return $this->pdo->query('SELECT * FROM ' . self::ART_TABLE . ' a 
        JOIN works_category c ON a.category_id=c.ID ORDER BY `date` ASC')->fetchAll();
    }
}
