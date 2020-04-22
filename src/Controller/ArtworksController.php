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

/**
 * Class ArtworksController
 *
 */
class ArtworksController extends AbstractController
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
        $listSeeArtworks = $artworkManager->selectAllArtworks();
        return $this->twig->render('Artworks/index.html.twig', ['artworks'=> $listSeeArtworks]);
    }
    public function select($idCategory)
    {
        $artworkManager = new ArtworkManager();
        $listSeeArtworks = $artworkManager->selectArtworksByCategory($idCategory);
        return $this->twig->render('Artworks/index.html.twig', ['artworks'=> $listSeeArtworks]);
    }
    public function time($direction)
    {
        $artworkManager = new ArtworkManager();
        $listSeeArtworks = $artworkManager->selectAllByOrder($direction);
        return $this->twig->render('Artworks/index.html.twig', ['artworks'=> $listSeeArtworks]);
    }
}
