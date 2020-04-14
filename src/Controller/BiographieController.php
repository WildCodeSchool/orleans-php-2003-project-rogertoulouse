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
    public function indexAction(){
        $bioManager = new BiographieManager();
        $biography = $bioManager->selectAll();

        return $this->twig->render('Biography/index.html.twig', ['biography' => $biography]);
    }

    public function index()
    {
        $bioManager = new BiographieManager();
        $biography = $bioManager->selectAll();

        return $this->twig->render('Biography/index.html.twig', ['biography' => $biography]);
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $biography['date'] = $_POST['date'];
            $biography['info'] = $_POST['info'];
            if (isset($_POST['art'])){
                $biography['art'] = $_POST['art'];
                $biography['image'] = $_POST['image'];
            } else {
                $biography['art'] = 0;
                $biography['image'] = '';
            }
            $bioManager->update($biography);
        }

        return $this->twig->render('Biography/edit.html.twig', ['biography' => $biography]);
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bioManager = new BiographieManager();
            $biography = [
                'date' => $_POST['date'],
                'info' => $_POST['info'],
            ];
            if (isset($_POST['art'])){
                $biography = [
                'art' => $_POST['art'],
                'image' => $_POST['image'],
                ];
            }
            $bioManager->insert($biography);
            header('Location:/Biographie/');
        }

        return $this->twig->render('Biography/add.html.twig');
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
        header('Location:/Biography/');
    }
}
