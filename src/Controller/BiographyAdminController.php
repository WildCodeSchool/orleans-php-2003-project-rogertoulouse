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
use DateTime;
use Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AdminController
 *
 */
class BiographyAdminController extends AbstractController
{
    protected $active = 'biography';
    protected $dataByYears = [];

    /**
     * Display home page
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function index()
    {
        $this->populateData();
        return $this->twig->render('/BiographyAdmin/index.html.twig', [
            'active' => $this->active,
            'data' => $this->dataByYears]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws Exception
     */
    public function add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            if (isset($data['year'])) {
                $year = htmlentities($data['year']);
                $startDate = strtotime('01-01-1916');
                $nowDate = strtotime(date('m-d-Y'));
                $userDate = strtotime('01-01-' . $year);
                if ((strtotime($year)) === false) {
                    $errors['year'][] = 'L\'année n\'est pas valide.';
                } elseif ($userDate <= $startDate || $userDate >= $nowDate) {
                    $errors['year'][] = 'L\'année doit être comprise entre ' .
                        date('Y', $startDate) .
                        ' et ' .
                        date('Y', $nowDate) .
                        '.';
                }
            } else {
                $errors['year'][] = 'L\'année ne doit pas être vide.';
            }
            if (isset($data['biography'])) {
                $errors['biography'][] = 'La biographie ne doit pas être vide.';
            }
            if (!empty($errors)) {
                $this->populateData();
                return $this->twig->render('/BiographyAdmin/_add.html.twig', [
                    'active' => $this->active,
                    'data' => $this->dataByYears,
                    'errors' => $errors]);
            }
            $biographyManager = new BiographyManager();
            $date = new DateTime($data['year'] . '-01-01');
            $biographyManager->insert($date->format('Y-m-d'), htmlentities($data['biography']));
            header('Location:/BiographyAdmin/Index');
        }
        $this->populateData();
        return $this->twig->render('/BiographyAdmin/_add.html.twig', [
            'active' => $this->active,
            'data' => $this->dataByYears,
            'errors' => $errors]);
    }
    private function populateData()
    {
        $biographyManager = new BiographyManager();
        $dataByDates[] = $biographyManager->selectAllBioByDate();
        foreach ($dataByDates as $biographies) {
            foreach ($biographies as $biography) {
                $year = date_format(date_create($biography['date']), 'Y');
                $this->dataByYears[$year][] = $biography;
            }
        }
        ksort($this->dataByYears);
    }
}
