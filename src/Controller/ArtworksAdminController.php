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
use DateTime;

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
        $artworkManager = new ArtworkManager();
        $artworks = $artworkManager->selectArtworks();

        return $this->twig->render('/ArtworksAdmin/index.html.twig', [
            'active' => self::ACTIVE,
            'artworks' => $artworks,
            ]);
    }

    public function update()
    {
        //recup categories
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();

        $artworkManager = new ArtworkManager();
        $messages=[];

        if (!empty($_POST['action'])=='update') {
            //validation des données
            $artwork=$_POST;
            $artwork['date'] = $artwork['date'] . '-01-01';
            if (isset($artwork['carousel'])) {
                $artwork['carousel']=true;
            } else {
                $artwork['carousel']=false;
            }
            if (strlen($artwork['name'])>100) {
                $messages[]='Le TITRE ne peut dépasser 100 caractères';
            }
            if (!in_array($artwork['category'], array_column($categories, 'id'))) {
                $messages[]='La CATEGORIE n\'est pas valide';
            }
            if (strlen($artwork['more_info'])>255) {
                $messages[]='La longueur de l\'INFO+ doit être inférieure à 255 caractères.';
            }
            if (strlen($artwork['size'])>40) {
                $messages[]='Le champ TAILLE ne peut dépasser 40 caractères.';
            }
            if (empty($messages)) {
                $artworkManager->updateArtwork($artwork);
                header('location:/ArtworksAdmin/index/?update=valid');
            }
        }
        if (!empty($_POST['idArtwork'])) {
            $idArtwork = intval($_POST['idArtwork']);

            $artwork = $artworkManager->selectArtwork($idArtwork);
            return $this->twig->render('/ArtworksAdmin/update.html.twig', [
                'active' => self::ACTIVE,
                'artwork' => $artwork,
                'categories' => $categories,
                'messages' => $messages
            ]);
        }
    }
}
