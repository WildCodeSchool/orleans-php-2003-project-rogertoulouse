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
        return $this->twig->render('/Admin/Home/home.html.twig', ['active' => 'home']);
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

    public function edit($id): string
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $news['title'] = $_POST['title'];
            $newsManager->update($news);
        }

        return $this->twig->render('admin/home/edit.html.twig', ['news' => $news]);
    }
    public function show($id): int
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectOneById($id);

        return $this->twig->render('admin/home/show.html.twig', ['news' => $news]);
    }
}
