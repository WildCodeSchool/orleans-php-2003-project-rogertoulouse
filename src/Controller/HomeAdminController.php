<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\NewsManager;

/**
 * Class HomeAdminController
 *
 */
class HomeAdminController extends AbstractController
{
    public function index()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectNews();

        return $this->twig->render('HomeAdmin/index.html.twig', ['news' => $news]);
    }

    public function show(int $id)
    {
        $newsManager = new NewsManager();
        $new = $newsManager->selectOneById($id);

        return $this->twig->render('HomeAdmin/show.html.twig', ['new' => $new]);
    }

    public function add()
    {
        $newsManager = new NewsManager();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->controlNews($data);
            if (empty($errors)) {
                $newsManager->insert($data);
                header('Location:/HomeAdmin/index');
            }
        }
        return $this->twig->render('HomeAdmin/add.html.twig', [
            'data' => $data ?? [],
            'errors' => $errors ?? []
        ]);
    }

    private function controlNews($data)
    {
        $lengthControl = 255;
        $errors = [];
        if (empty($data['title'])) {
            $errors['title'] = 'Titre requis';
        } elseif (strlen($data['title']) > 255) {
            $errors['title'] = 'Le titre dépasse ' . $lengthControl . ' caractères';
        }
        if (empty($data['desc'])) {
            $errors['desc'] = 'La description de l\'actu ne doit pas être vide';
        } elseif (strlen($data['desc']) > 255) {
            $errors['desc'] = 'La description dépasse ' . $lengthControl . ' caractères';
        }
        if (empty($data['button'])) {
            $errors['button'] = 'La description du bouton ne doit pas être vide';
        }
        if (empty($data['button_link'])) {
            $errors['button_link'] = 'La redirection du bouton ne doit pas être vide';
        }

        return $errors ?? [];
    }
}
