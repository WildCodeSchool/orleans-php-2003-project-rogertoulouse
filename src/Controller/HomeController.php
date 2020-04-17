<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\HomeManager;

/**
 * Class HomeController
 *
 */
class HomeController extends AbstractController
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
        $carouselManager = new HomeManager();
        $carousel = $carouselManager->selectAll();
        return $this->twig->render('Home/index.html.twig', ['carousel' => $carousel]);
    }
}