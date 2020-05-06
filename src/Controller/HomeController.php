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
        $artworkManager = new ArtworkManager();
        $newsManager = new NewsManager();
        $artworks = $artworkManager->selectArtworks();
        $carousel = $artworkManager->selectCarousel();
        $news = $newsManager->selectNews();

        $artworksByCategories = [];
        $randomArtworks = [];
        foreach ($artworks as $artwork) {
            $category = $artwork['category'];
            $artworksByCategories[$category][] = $artwork;
        }
        foreach ($artworksByCategories as $category => $artworksByCategory) {
            $randomArtworks[$category] = $artworksByCategory[array_rand($artworksByCategory)];
        }
        shuffle($randomArtworks);
        return $this->twig->render('Home/index.html.twig', ['artworks' => $randomArtworks,
            'carousel' => $carousel,
            'news' => $news]);
    }
}
