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
class MessagesManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'messages';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(string $mailer, string $object, string $message): ?int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`mailer`,`object`,`message`) 
                                                    VALUES (:mailer, :object, :message)");
        $statement->bindValue('mailer', $mailer, \PDO::PARAM_STR);
        $statement->bindValue('object', $object, \PDO::PARAM_STR);
        $statement->bindValue('message', $message, \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
        return null;
    }

    public function delete(int $id):void
    {
        $query='DELETE FROM ' . $this->table . ' WHERE id=:id;';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
