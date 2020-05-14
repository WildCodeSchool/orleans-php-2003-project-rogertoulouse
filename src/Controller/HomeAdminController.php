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
use App\Model\NewsManager;

/**
 * Class HomeAdminController
 *
 */
class HomeAdminController extends AbstractController
{
    const ACTIVE = 'home';

    public function index()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectNews();

        return $this->twig->render('HomeAdmin/index.html.twig', [
            'active' => self::ACTIVE,
            'news' => $news]);
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
            'active' => self::ACTIVE,
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
        } elseif (strlen($data['title']) > $lengthControl) {
            $errors['title'] = 'Le titre dépasse ' . $lengthControl . ' caractères';
        }
        if (empty($data['desc'])) {
            $errors['desc'] = 'La description de l\'actu ne doit pas être vide';
        } elseif (strlen($data['desc']) > $lengthControl) {
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

    public function edit(int $id): string
    {
        $newsManager = new NewsManager();
        $new = $newsManager->selectOneById($id);
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->controlNews($data);
            if (empty($errors)) {
                $newsManager->update($data);
                header('Location:/HomeAdmin/index');
            }
        }
        return $this->twig->render('HomeAdmin/edit.html.twig', [
            'active' => self::ACTIVE,
            'new' => $new,
            'data' => $data ?? [],
            'errors' => $errors ?? []
        ]);
    }

    public function delete()
    {
        $newsManager = new NewsManager();

        if (!empty($_POST['id'])) {
            $id = intval($_POST['id']);
            // suppression de la news
            $newsManager->deleteNews($id);

            header('location:/HomeAdmin/index');
        }
    }
}
