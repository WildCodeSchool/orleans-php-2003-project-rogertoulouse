<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\AssociationManager;

/**
 * Class AdminController
 *
 */
class AssociationAdminController extends AbstractController
{
    const ACTIVE = 'association';

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
        $assocAdminManager = new AssociationManager();
        $association = $assocAdminManager->selectFirst();
        return $this->twig->render('/AssociationAdmin/index.html.twig', [
            'association' => $association]);
    }

    public function update()
    {
        $assocAdminManager = new AssociationManager();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->controlUpdate($data);
            $data = [];
            foreach ($_POST as $key => $value) {
                $data[$key] = trim($value);
            }

            if (empty($errors)) {
                $data['id'] = intval($data['id']);
                $assocAdminManager->update($data);
                header('Location:/AssociationAdmin/index');
            }
        }
        $association = $assocAdminManager->selectFirst();
        return $this->twig->render('/AssociationAdmin/update.html.twig', ['data' => $data ?? [],
            'errors' => $errors ?? [],
            'association' => $association]);
    }

    private function controlUpdate(array $data)
    {
        $lengthTitle = 100;
        $lengthText = 65535;
        $lengthEmail = $lengthAddress = 250;
        $lengthNumber = 30;
        $errors = [];

        foreach ($data as $key) {
            if (empty($key)) {
                $errors[] = " veuillez remplir tous les champs";
            }
        }
        if (strlen($data['title']) > $lengthTitle) {
            $errors[] = 'Le titre dépasse ' . $lengthTitle . ' caractères';
        }
        if (strlen($data['text']) > $lengthText) {
            $errors[] = 'Le texte dépasse ' . $lengthText . ' caractères';
        }
        if (strlen($data['email']) > $lengthEmail) {
            $errors[] = 'L\'email dépasse ' . $lengthEmail . ' caractères';
        }
        if (strlen($data['address']) > $lengthAddress) {
            $errors[] = 'L\'adresse dépasse ' . $lengthAddress . ' caractères';
        }
        if (strlen($data['numberphone']) > $lengthNumber) {
            $errors[] = 'Le numéro dépasse ' . $lengthNumber . ' caractères';
        }
        return $errors ?? [];
    }
}
