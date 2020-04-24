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
        $artworkManager = new ArtworkManager();
        $artworks = $artworkManager->selectAllArtworks();
        shuffle($artworks);

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();

        return $this->twig->render('Artworks/index.html.twig', ['artworks'=> $artworks, 'categories'=>$categories]);
    }

    public function select()
    {
        $idCategory=$_GET['cat'];
        $artworkManager = new ArtworkManager();
        $seeArtworks = $artworkManager->selectArtworksByCategory($idCategory);
        shuffle($seeArtworks);
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        return $this->twig->render('Artworks/index.html.twig', ['artworks'=> $seeArtworks, 'categories'=>$categories]);
    }

    public function time($direction)
    {
        $artworkManager = new ArtworkManager();
        $seeArtworks = $artworkManager->selectAllByDate($direction);
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        return $this->twig->render('Artworks/index.html.twig', ['artworks'=> $seeArtworks, 'categories'=>$categories]);
    }
}
