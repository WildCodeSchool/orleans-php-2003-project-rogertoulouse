<?php

namespace App\Controller;

use App\Model\SeeArtworksManager;

class SeeArtworksController extends AbstractController
{
    public function select()
    {
        $seeArtworks = new SeeArtworksManager();
        $listSeeArtworks = $seeArtworks->selectAllArtworks();
        return $this->twig->render('Home/see_artworks.html.twig', ['seeArtworks' => $listSeeArtworks]);
    }
}
