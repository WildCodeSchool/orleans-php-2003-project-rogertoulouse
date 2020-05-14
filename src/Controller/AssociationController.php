<?php

namespace App\Controller;

use App\Model\ArtworkManager;
use App\Model\AssociationManager;
use App\Model\MessagesManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AssociationController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index()
    {
        $associationManager = new AssociationManager();
        $association = $associationManager->selectFirst();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            if (empty($data['email'])) {
                $errors['emailEmpty'] = 'L\'email est requis';
            }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['emailInvalid'] = "Le format d'email est invalide";
            }
            if (empty($data['object'])) {
                $errors['object'] = 'L\'objet est requis';
            }
            if (empty($data['message'])) {
                $errors['message'] = 'Un message est requis';
            }
            if (!empty($errors) && $errors != '') {
                return $this->twig->render('Association/index.html.twig', [
                    'post' => $_POST,
                    'errors' => $errors,
                    'association' => $association]);
            }
            $messagesManager = new MessagesManager();
            $messagesManager->insert($_POST['email'], $_POST['object'], $_POST['message']);
            header('Location:/Association/Index/?sending=success#contact');
        }
        if (isset($_GET['sending'])) {
            return $this->twig->render('Association/index.html.twig', [
                'get' => $_GET['sending'],
                'association' => $association]);
        }
        return $this->twig->render('Association/index.html.twig', [
            'association' => $association]);
    }
}
