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
 * Class AdminController
 *
 */
class AdminController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('/Admin/index.html.twig');
    }

    public function home()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectNews();

        return $this->twig->render('Admin/Home/index.html.twig', ['news' => $news]);
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $newManager = new NewsManager();
        $new = $newManager->selectOneById($id);

        return $this->twig->render('Admin/Home/show.html.twig', ['new' => $new]);
    }


    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function update(int $id): string
    {
        $newManager = new NewsManager();
        $new = $newManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new['title'] = $_POST['title'];
            $newManager->update($new);
        }

        return $this->twig->render('Admin/Home/edit.html.twig', ['new' => $new]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newManager = new newsManager();
            $new = [
                'title' => $_POST['title'],
            ];
            $id = $newManager->insert($new);
            header('Location:/Admin/Home/show/' . $id);
        }

        return $this->twig->render('Admin/Home/add.html.twig');
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $newManager = new NewsManager();
        $newManager->delete($id);
        header('Location:/Admin/Home/index');
    }
    public function biography()
    {
        return $this->twig->render('/Admin/Biography/biography.html.twig', ['active' => 'biography']);
    }

    public function artworks()
    {
        return $this->twig->render('/Admin/Artworks/artworks.html.twig', ['active' => 'artworks']);
    }

    public function association()
    {
        return $this->twig->render('/Admin/Association/association.html.twig', ['active' => 'association']);
    }
}
