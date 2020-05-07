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
        // récupération des oeuvres
        $artworkManager = new ArtworkManager();
        $artworks = $artworkManager->selectArtworks();

        return $this->twig->render('/ArtworksAdmin/index.html.twig', [
            'active' => self::ACTIVE,
            'artworks'=> $artworks,
            ]);
    }

    public function delete():string
    {
        $artworkManager = new ArtworkManager();

        if (!empty($_GET['act']) && $_GET['act']=='delete' && (!empty($_POST['idArtwork']))) {
            $idArtwork = intval($_POST['idArtwork']);
            $step=$_GET['act'];

            // récupération de l'oeuvre à supprimer
            $artwork = $artworkManager->selectArtwork($idArtwork);

            return $this->twig->render('/ArtworksAdmin/index.html.twig', [
                'active' => self::ACTIVE,
                'artwork' => $artwork,
                'step' => $step,
                ]);
        } elseif (!empty($_GET['act']) && $_GET['act']=='confirmDelete' && (!empty($_POST['idArtwork']))) {
            $idArtwork = intval($_POST['idArtwork']);
            $picture = htmlentities($_POST['pictureArtwork']);
            $step = $_GET['act'];
            // suppression de l'oeuvre
            $artworkManager->deleteArtwork($idArtwork, $picture);

            $artworks = $artworkManager->selectArtworks();

            return $this->twig->render('/ArtworksAdmin/index.html.twig', [
                'active' => self::ACTIVE,
                'artworks'=> $artworks,
                'step' => $step
            ]);
        }
    }
}
