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
use App\Model\CategoryManager;

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
        $category = $_GET['cat'] ?? 'c.id';
        $artworkManager = new ArtworkManager();
        $seeArtworks = $artworkManager->selectArtworks($category);

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();

        return $this->twig->render('Artworks/index.html.twig', ['artworks'=> $seeArtworks, 'categories'=>$categories]);
    }

    public function single($idArtwork)
    {

        $artworkManager = new ArtworkManager();
        $seeArtworks = $artworkManager->selectArtworks(null, $idArtwork);

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        return $this->twig->render('Artworks/single.html.twig', ['artworks'=> $seeArtworks, 'categories'=>$categories]);
    }
}
