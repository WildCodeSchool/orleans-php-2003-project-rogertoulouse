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
        if (isset($_GET['validation'])) {
            if ($_GET['validation']=='update') {
                $message[] = 'La mise à jour de l\'oeuvre a bien été effectuée.';
            } elseif ($_GET['validation']=='add') {
                $message[] = 'L\'ajout de l\'oeuvre a bien été effectuée.';
            } elseif ($_GET['validation']=='delete') {
                $message[] = 'La suppression de l\'oeuvre a bien été effectuée.';
            }
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
        $startYear=1917;
        $endYear=1995;

        if ($artwork['year'] < $startYear || $artwork['year'] > $endYear) {
            $messages[]='L\'année de la création de l\'oeuvre doit être comprise entre 1918 et 1994';
        }
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
            $artwork['year']=$artwork['date'];
            $artwork['date'] = $artwork['date'] . '-01-01';
            if (isset($artwork['carousel'])) {
                $artwork['carousel'] = true;
            } else {
                $artwork['carousel'] = false;
            }
            $messages = $this->validData($artwork, $categories);
            if (empty($messages)) {
                $artworkManager->updateArtwork($artwork);
                header('location:/ArtworksAdmin/index/?validation=update');
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
    public function preDelete()
    {
        if (isset($_GET['idArtwork'])) {
            $idArtwork = intval(trim($_GET['idArtwork']));
            $artworkManager = new ArtworkManager();
            $artwork = $artworkManager->selectArtwork($idArtwork);
            return $this->twig->render('/ArtworksAdmin/delete.html.twig', [
                'active' => self::ACTIVE,
                'artwork' => $artwork
            ]);
        } else {
            header('location:/ArtworksAdmin/index');
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

            header('location:/ArtworksAdmin/index/?validation=delete');
        }
    }


    public function verifData($artwork, $categories):array
    {
        $errorMessages = [];
        $typeFileAllowed=['image/jpg','image/jpeg','image/png','image/gif'];
        if ($_FILES['image']['size']>1000000 || !in_array($_FILES['image']['type'], $typeFileAllowed)) {
            $errorMessages[]="Seules les images .jpg, .jpeg, .png et .gif sont autorisées.<br>
             La taille maximal de celles-ci ne doit pas dépasser 1Mo.";
        }

        $startYear=1917;
        $endYear=1995;

        if ($artwork['year'] < $startYear || $artwork['year'] > $endYear) {
            $errorMessages[]='L\'année de la création de l\'oeuvre doit être comprise entre 1918 et 1994';
        }
        if (empty($artwork['name']) || empty($artwork['date'])
            || empty($artwork['description'])) {
            $errorMessages[] = 'Les champs nom, date et description sont obligatoires.';
        }
        if (!in_array($artwork['category_id'], array_column($categories, 'id'))) {
            $errorMessages[] = 'La catégorie renseignée n\'est pas valide';
        }
        return $errorMessages;
    }
    public function add():string
    {
        $errorMessages=[];
        $artwork=[];
        // récupération des catégories
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();
        if (isset($_FILES['image']) && isset($_POST['name'])) {
            $artwork = $_POST;
            $artwork['year'] = intval($artwork['date']);
            $artwork['date'] = $artwork['date'] . '-01-01';
            $uploadDir = 'assets/upload/';
            $errorMessages = $this->verifData($artwork, $categories);

            if (empty($errorMessages)) {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . "." . $extension;
                $uploadFile = $uploadDir . $fileName;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

                $artwork['image']=$fileName;
                $artworkManager = new ArtworkManager();
                $artworkManager->addArtwork($artwork);
                $errorMessages[]='L\'ajout de l\'oeuvre a bien été effectué.';

                header('location:/ArtworksAdmin/index/?validation=add');
            }
        }

        return $this->twig->render('/ArtworksAdmin/add.html.twig', [
            'active' => self::ACTIVE,
            'artwork' => $artwork,
            'categories'=>$categories,
            'messages'=>$errorMessages
        ]);
    }
}
