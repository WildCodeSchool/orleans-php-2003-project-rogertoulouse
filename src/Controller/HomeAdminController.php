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


    /**
     *
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $newsManager = new NewsManager();
        $new = $newsManager->selectOneById($id);

        return $this->twig->render('HomeAdmin/show.html.twig', ['new' => $new]);
    }


    /**
     *
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $newsManager = new NewsManager();
        $new = $newsManager->selectOneById($id);

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new = [
                'title' => $_POST['title'],
                'desc' => $_POST['desc'],
                'button' => $_POST['button'],
                'button_link' => $_POST['button_link'],
            ];
            $newsManager->update($new);
        }

        return $this->twig->render('HomeAdmin/edit.html.twig', ['new' => $new]);
    }


    /**
     *
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newsManager = new NewsManager();
            $new = [
                'title' => $_POST['title'],
                'desc' => $_POST['desc'],
                'button' => $_POST['button'],
                'button_link' => $_POST['button_link'],
            ];
            $id = $newsManager->insert($new);
            header('Location:/HomeAdmin/show/' . $id);
        }

        return $this->twig->render('HomeAdmin/add.html.twig');
    }


    /**
     *
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $newsManager = new NewsManager();
        $newsManager->delete($id);
        header('Location:/HomeAdmin/index');
    }
}
