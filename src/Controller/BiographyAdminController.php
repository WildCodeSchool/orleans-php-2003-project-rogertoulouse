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
    const ACTIVE = 'biography';

    /**
     * Display home page
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function index(): string
    {
        $dataByYears = $this->populateData();
        return $this->twig->render('/BiographyAdmin/index.html.twig', [
            'active' => self::ACTIVE,
            'data' => $dataByYears]);
    }

    /**
     * Display item creation page
     *
     * @return string
     * @throws Exception
     */
    public function add(): string
    {
        $dataByYears = $this->populateData();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validationSQL($data['year'], $data['biography']);
            if (!empty($errors) && $errors != '') {
                return $this->twig->render('/BiographyAdmin/_add.html.twig', [
                    'active' => self::ACTIVE,
                    'data' => $dataByYears,
                    'errors' => $errors]);
            }
            $biographyManager = new BiographyManager();
            $date = new DateTime($data['year'] . '-01-01');
            $biographyManager->insert($date->format('Y-m-d'), $data['biography']);
            header('Location:/BiographyAdmin/Index');
        }
        return $this->twig->render('/BiographyAdmin/_add.html.twig', [
            'active' => self::ACTIVE,
            'data' => $dataByYears]);
    }

    /**
     * Display item creation page
     *
     * @param int $id
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function edit(int $id): string
    {
        $dataByYears = $this->populateData();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->validationSQL($data['year'], $data['biography']);
            if (!empty($errors) && $errors != '') {
                return $this->twig->render('/BiographyAdmin/_edit.html.twig', [
                    'active' => self::ACTIVE,
                    'id' => $id,
                    'data' => $dataByYears,
                    'errors' => $errors]);
            }
            $biographyManager = new BiographyManager();
            $date = new DateTime($data['year'] . '-01-01');

            $biographyManager->update($id, $date->format('Y-m-d'), $data['biography']);
            header('Location:/BiographyAdmin/Index');
        }
        return $this->twig->render('/BiographyAdmin/_edit.html.twig', [
            'active' => self::ACTIVE,
            'id' => $id,
            'data' => $dataByYears,
            'errors' => $errors]);
    }

    /**
     * Display item creation page
     *
     * @param int $id
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function delete(int $id): string
    {
        $dataByYears = $this->populateData();
        $biographyManager = new BiographyManager();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $biographyManager->delete($id);
            header('Location:/BiographyAdmin/Index');
        }
        return $this->twig->render('/BiographyAdmin/_delete.html.twig', [
            'active' => self::ACTIVE,
            'id' => $id,
            'data' => $dataByYears,
            'errors' => $errors]);
    }

    /**
     * Display item creation page
     *
     * @return array
     */
    private function populateData(): array
    {
        $data = [];
        $biographyManager = new BiographyManager();
        $dataByDates[] = $biographyManager->selectAllBioByDate();
        foreach ($dataByDates as $biographies) {
            foreach ($biographies as $biography) {
                $year = date_format(date_create($biography['date']), 'Y');
                $data[$year][] = $biography;
            }
        }
        ksort($data);
        return $data;
    }

    /**
     * Display item creation page
     *
     * @param string $year
     * @param string $biography
     * @return array
     * @throws Exception
     */
    private function validationSQL(string $year, string $biography): array
    {
        $errors = [];
        if ($year != '') {
            $userDate = '01-01-' . $year;
            $startDate = new DateTime('01-01-1916');
            $nowDate = new DateTime();
            $userDate = new DateTime($userDate);
            if ((strtotime($year)) === false) {
                $errors['year'][] = 'L\'année n\'est pas valide.';
            } elseif ($userDate <= $startDate || $userDate >= $nowDate) {
                $errors['year'][] = 'L\'année doit être comprise entre ' .
                    $startDate->format('Y') .
                    ' et ' .
                    $nowDate->format('Y') .
                    '.';
            }
        } else {
            $errors['year'][] = 'L\'année ne doit pas être vide.';
        }
        if ($biography == '') {
            $errors['biography'][] = 'La biographie ne doit pas être vide.';
        }
        return $errors;
    }
}
