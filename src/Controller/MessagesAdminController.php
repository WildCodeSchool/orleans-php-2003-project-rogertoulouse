<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\ArtworkManager;
use App\Model\BiographyManager;
use App\Model\MessagesManager;
use App\Model\NewsManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeAdminController
 *
 */
class MessagesAdminController extends AbstractController
{
    const ACTIVE = 'messages';

    public function index()
    {
        $messagesManager = new MessagesManager();
        $data = $messagesManager->selectAll();

        return $this->twig->render('MessagesAdmin/index.html.twig', [
            'active' => self::ACTIVE,
            'data' => $data]);
    }

    /**
     * Display item creation page
     *
     * @param int $id
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function delete(int $id): string
    {
        $messagesManager = new MessagesManager();
        $data = $messagesManager->selectAll();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $messagesManager->delete($id);
            header('Location:/MessagesAdmin/Index');
        }
        return $this->twig->render('/MessagesAdmin/_delete.html.twig', [
            'active' => self::ACTIVE,
            'id' => $id,
            'data' => $data,
            'errors' => $errors]);
    }
}
