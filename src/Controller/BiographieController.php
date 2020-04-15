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
        $bioManager = new BiographieManager();
        $biography = $bioManager->selectAllByDate();
        $result = [];
        foreach ($biography as $bio){
            $date = explode('-', $bio['date']);
            $result[] = $date[0];
        }
        return $this->twig->render('Biography/index.html.twig', ['biography' => $biography, 'years' => array_unique($result)]);
    }

    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $bioManager = new BiographieManager();
        $biography = $bioManager->selectOneById($id);

        return $this->twig->render('Biography/show.html.twig', ['biography' => $biography]);
    }

    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $bioManager = new BiographieManager();
        $biography = $bioManager->selectOneById($id);
        $btn = 'Editer';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $biography['date'] = $_POST['date'];
            $biography['info'] = $_POST['info'];
            $bioManager->update($biography);
        }

        return $this->twig->render('Biography/edit.html.twig', ['biography' => $biography, 'btn' => $btn]);
    }

    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $btn = 'Ajouter';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bioManager = new BiographieManager();
            $biography = [
                'date' => $_POST['date'],
                'info' => $_POST['info'],
            ];
            $bioManager->insert($biography);
            header('Location:/Biographie/');
        }

        return $this->twig->render('Biography/add.html.twig', ['btn' => $btn]);
    }

    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $bioManager = new BiographieManager();
        $bioManager->delete($id);
        header('Location:/Biographie/');
    }
}
