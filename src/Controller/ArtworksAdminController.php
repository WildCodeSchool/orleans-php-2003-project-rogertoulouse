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

        if (!empty($_POST['idArtwork'])) {
            $idArtwork = intval($_POST['idArtwork']);
            $artwork= $artworkManager->selectArtwork($idArtwork);
            // suppression de l'oeuvre
            $artworkManager->deleteArtwork($idArtwork);
            unlink('assets/upload/'.$artwork['image']);
            $message="La suppression de l'oeuvre a bien été effectuée.";

            $artworks = $artworkManager->selectArtworks();

            return $this->twig->render('/ArtworksAdmin/index.html.twig', [
                'active' => self::ACTIVE,
                'artworks'=> $artworks,
                'message' => $message
            ]);
        }
    }
}
