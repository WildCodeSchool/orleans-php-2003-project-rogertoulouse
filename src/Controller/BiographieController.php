<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\BiographieManager;

/**
 * Class BiographieController
 *
 */
class BiographieController extends AbstractController
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
        $biographyManager = new BiographieManager();
        $biographies = $biographyManager->selectAllByDate();
        $biographyByYears = [];
        foreach ($biographies as $biography) {
            $biographyByYears[date_format(date_create($biography['date']), 'Y')][$biography['date']] = ['id' => $biography['id'], 'info' => $biography['info']];
        }
        return $this->twig->render('Biography/index.html.twig', [
            'data' => $biographyByYears
        ]);
    }
}
