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
        $message=[];
        $artworkManager = new ArtworkManager();
        $artworks = $artworkManager->selectArtworks();
        if (isset($_GET['update'])) {
            $message[]='La mise à jour a bien été effectuée.';
        }
        return $this->twig->render('/ArtworksAdmin/index.html.twig', [
            'active' => self::ACTIVE,
            'artworks' => $artworks,
            'messages' => $message,
            ]);
    }
    public function validData($artwork, $categories)
    {
        $messages=[];
        $sizeLenght=40;
        $nameLenght=100;
        $moreInfoLenght=255;

        if (strlen($artwork['name'])>$nameLenght) {
            $messages[]='Le titre ne peut dépasser ' . $nameLenght . ' caractères.';
        }
        if (!in_array($artwork['category'], array_column($categories, 'id'))) {
            $messages[]='La catégorie n\'est pas valide';
        }
        if (strlen($artwork['more_info'])>$moreInfoLenght) {
            $messages[] = 'La longueur de l\'info en plus doit être inférieure à '
                . $moreInfoLenght . ' caractères.';
        }
        if (strlen($artwork['size'])>$sizeLenght) {
            $messages[]='Le champ taille ne peut dépasser ' . $sizeLenght . ' caractères.';
        }
        return $messages;
    }


    public function update()
    {
        //recup categories
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();

        $artworkManager = new ArtworkManager();
        $messages = [];

        if (!empty($_POST['action']) == 'update') {
            $artwork = [];
            //validation des données
            foreach ($_POST as $key => $value) {
                $artwork[$key] = trim($value);
            }
            $artwork['date'] = $artwork['date'] . '-01-01';
            if (isset($artwork['carousel'])) {
                $artwork['carousel'] = true;
            } else {
                $artwork['carousel'] = false;
            }
            $messages = $this->validData($artwork, $categories);
            if (empty($messages)) {
                $artworkManager->updateArtwork($artwork);
                header('location:/ArtworksAdmin/index/?update=valid');
            } else {
                return $this->twig->render('/ArtworksAdmin/update.html.twig', [
                    'active' => self::ACTIVE,
                    'artwork' => $artwork,
                    'categories' => $categories,
                    'messages' => $messages
                ]);
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

    public function delete()
    {
        $artworkManager = new ArtworkManager();

        if (!empty($_POST['idArtwork'])) {
            $idArtwork = intval($_POST['idArtwork']);
            $artwork = $artworkManager->selectArtwork($idArtwork);
            // suppression de l'oeuvre
            $artworkManager->deleteArtwork($idArtwork);
            unlink('assets/upload/' . $artwork['image']);

            header('location:/ArtworksAdmin/index');
        }
    }
    public function verifDataAdd($artwork, $categories):array
    {
        $errorMessages = [];
        $typeFileAllowed=['image/jpg','image/jpeg','image/png','image/gif'];
        if ($_FILES['image']['size']>1000000) {
            $errorMessages[]="La taille maximal du fichier ne doit pas dépasser 1Mo.";
            echo "taille";
        }
        if (!in_array($_FILES['image']['type'], $typeFileAllowed)) {
            $errorMessages[]="Seuls les images .jpg, .jpeg, .png, .gif sont autorisés.";
        }
        if (empty($artwork['name']) || empty($artwork['date'])
            || empty($artwork['category_id']) || empty($artwork['description'])) {
            $errorMessages[] = 'Les champs nom, date, categorie et description sont obligatoires.';
        }
        if (!in_array($artwork['category_id'], array_column($categories, 'id'))) {
            $errorMessages[] = 'La catégorie renseignée n\'est pas valide';
        }
        return $errorMessages;
    }
    public function add():string
    {
        $errorMessages=[];
        // récupération des catégories
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        if (isset($_FILES['image']) && isset($_POST['name'])) {
            $artwork = $_POST;
            $artwork['date'] = $artwork['date'] . '-01-01';
            $uploadDir = 'assets/upload/';
            $errorMessages = $this->verifDataAdd($artwork, $categories);

            if (empty($errorMessages)) {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . "." . $extension;
                $uploadFile = $uploadDir . $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

                $artwork['image']=$fileName;
                $artworkManager = new ArtworkManager();
                $artworkManager->addArtwork($artwork);
                $errorMessages[]='L\'ajout de l\'oeuvre a bien été effectué.';
            }
        }

        return $this->twig->render('/ArtworksAdmin/add.html.twig', [
            'active' => self::ACTIVE,
            'categories'=>$categories,
            'messages'=>$errorMessages
        ]);
    }
}
