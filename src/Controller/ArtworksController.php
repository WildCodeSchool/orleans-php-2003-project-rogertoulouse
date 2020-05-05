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

    public function index():string
    {
        $category = $_GET['cat'] ?? null;
        $errors = [];
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();

        if (isset($category)) {
            $category = intval($category);
            $idsCategories=array_column($categories, 'id');

            if (!in_array($category, $idsCategories)) {
                $errors[] ='La recherche sur cette catégorie d\'oeuvre n\'est pas possible.';
            }
        }

        $artworkManager = new ArtworkManager();
        $artworks = $artworkManager->selectArtworks($category);

        return $this->twig->render('Artworks/index.html.twig', [
            'artworks'=> $artworks,
            'categories'=>$categories,
            'errors'=>$errors,
            ]);
    }

    public function single(int $idArtwork):string
    {
        $errors = [];

        $artworkManager = new ArtworkManager();
        $artwork = $artworkManager->selectArtwork($idArtwork);

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        if (empty($artwork)) {
            $errors[] = 'La recherche liée à cette référence n\'a retourné aucun résultat.';
        }
        return $this->twig->render('Artworks/single.html.twig', [
            'artwork' => $artwork,
            'categories' => $categories,
            'errors'=>$errors,
        ]);
    }
}
