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
    protected $modifier = '';
    protected $errors = [];


    public function __construct()
    {
        parent::__construct();
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
        if (isset($_POST['control'])) {
            if ($_POST['control'] == 'cancel') {
                $this->modifier = '';
                $this->errors = array();
            }
            if ($_POST['control'] == 'new') {
                $this->modifier = 'new';
            }
        }
        return $this->twig->render('/BiographyAdmin/index.html.twig', [
            'active' => $this->active,
            'data' => $this->dataByYears,
            'form' => $this->modifier,
            'errors' => $this->errors]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws Exception
     */
    public function add()
    {
        $this->errors = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $biographyManager = new BiographyManager();
            if ($_POST['year'] != '') {
                $startDate = strtotime('01-01-1916');
                $nowDate = strtotime(date('m-d-Y'));
                $userDate = strtotime('01-01-' . $_POST['year']);
                if ((strtotime($_POST['year'])) === false) {
                    $this->errors['year'][] = 'L\'année n\'est pas valide.';
                }
                if ($userDate <= $startDate || $userDate >= $nowDate) {
                    var_dump($startDate);
                    var_dump($nowDate);
                    var_dump($userDate);
                    $this->errors['year'][] = 'L\'année doit être comprise entre ' .
                        date('Y', $startDate) .
                        ' et ' .
                        date('Y', $nowDate) .
                        '.';
                }
            } else {
                $this->errors['year'][] = 'L\'année ne doit pas être vide.';
            }
            if ($_POST['biography'] == '') {
                $this->errors['biography'][] = 'La biography ne doit pas être vide.';
            }
            if (isset($this->errors)) {
                $this->modifier = 'new';
                return $this->twig->render('/BiographyAdmin/index.html.twig', [
                    'active' => $this->active,
                    'data' => $this->dataByYears,
                    'form' => $this->modifier,
                    'errors' => $this->errors]);
            } else {
                $date = new DateTime($_POST['year'] . '-01-01');
                $biographyManager->insert($date->format('Y-m-d'), htmlentities($_POST['biography']));
                header('Location:/BiographyAdmin/Index');
            }
        }
        return $this->twig->render('/BiographyAdmin/index.html.twig', [
            'active' => $this->active,
            'data' => $this->dataByYears,
            'form' => $this->modifier,
            'errors' => $this->errors]);
    }
}
