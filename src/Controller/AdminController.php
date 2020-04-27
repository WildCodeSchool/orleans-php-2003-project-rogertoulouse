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
use App\Model\BiographyManager;

/**
 * Class AdminController
 *
 */
class AdminController extends AbstractController
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
        return $this->twig->render('/Admin/index.html.twig');
    }
    public function home()
    {
        return $this->twig->render('/Admin/Pages/home.html.twig', ['active' => 'home']);
    }
    public function biography()
    {
        $biographyManager = new BiographyManager();
        $dataByDates[] = $biographyManager->selectAllBioByDate();
        $dataByYears = [];
        foreach ($dataByDates as $biographies) {
            foreach ($biographies as $biography) {
                $year = date_format(date_create($biography['date']), 'Y');
                $dataByYears[$year][] = $biography;
            }
        }
        ksort($dataByYears);
        return $this->twig->render('/Admin/Pages/biography.html.twig', [
            'active' => 'biography',
            'data' => $dataByYears]);
    }
    public function artworks()
    {
        return $this->twig->render('/Admin/Pages/artworks.html.twig', ['active' => 'artworks']);
    }
    public function association()
    {
        return $this->twig->render('/Admin/Pages/association.html.twig', ['active' => 'association']);
    }
}
