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
 * Class AdminController
 *
 */
class ArtworksAdminController extends AbstractController
{
    const ACTIVE = 'artworks';
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
        // récupération des catégories
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        // récupération des oeuvres
        $artworkManager = new ArtworkManager();
        $artworks = $artworkManager->selectArtworks();

        return $this->twig->render('/ArtworksAdmin/index.html.twig', [
            'active' => self::ACTIVE,
            'artworks'=> $artworks,
            'categories'=>$categories,
            ]);
    }
    public function add():string
    {
        // récupération des catégories
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();

        if (isset($_FILES['image']) && isset($_POST['name'])) {
            $artwork=$_POST;
            $uploadDir = 'assets/upload/';
            $errorMessage = array();
            $typeFileAllowed=['image/jpg','image/jpeg','image/png','image/gif',];

            if ($_FILES['image']['size']>1000000) {
                $errorMessage[]="La taille maximal du fichier ne doit pas dépasser 1Mo.";
                echo "taille";
            }
            if (in_array($_FILES['image']['type'], $typeFileAllowed)==false){
                $errorMessage[]="Seuls les images .jpg, .jpeg, .png, .gif sont autorisés.";
                echo "extension";
            }
            if (empty($errorMessage)) {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $name = uniqid() . "." . $extension;
                $uploadFile = $uploadDir . $name;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
            }
            $artwork['image']=$name;
            $artworkManager = new ArtworkManager();
            $artworkManager->addArtwork($artwork);
            //header('location:artworksAdmin/index/');
        }

        return $this->twig->render('/ArtworksAdmin/add.html.twig', [
            'active' => self::ACTIVE,
            'categories'=>$categories,
        ]);
    }
}
