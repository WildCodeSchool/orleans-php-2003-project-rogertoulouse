<?php

namespace App\Controller;

use App\Model\SeeArtworksManager;

class SeeArtwoksController extends AbstractController
{
    public function index()
    {
        $seeArtworks = new SeeArtworksManager();
        $listSeeArtworks = $seeArtworks->selectAll();
        return $this->twig->render('Home/see_artworks.html.twig', ['seeArtworks' => $listSeeArtworks]);
    }
}