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
}
