<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\BiographyManager;

/**
 * Class BiographieController
 *
 */
class BiographyController extends AbstractController
{
    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $biographyManager = new BiographyManager();
        $dataByDates[] = $biographyManager->selectAllBioByDate();
        $dataByDates[] = $biographyManager->selectAllArtByDate();
        $dataByYears = [];
        foreach ($dataByDates as $biographies) {
            foreach ($biographies as $biography) {
                $year = date_format(date_create($biography['date']), 'Y');
                $dataByYears[$year][] = $biography;
            }
        }
        ksort($dataByYears);
        return $this->twig->render('Biography/index.html.twig', [
            'data' => $dataByYears
        ]);
    }
}
