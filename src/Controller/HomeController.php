<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class HomeController extends AbstractController
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

        $url = 'https://api.windy.com/api/webcams/v2/map/90,180,-90,-180,3';
        $picData = $this->get($url.'?show=webcams:location,image&key=' . APP_API_KEY);

        $webcams = $picData['result']['webcams'];



        //echo "<pre>";
        //var_dump($picData['result']['webcams']);
        //echo "</pre>";
        return $this->twig->render('Home/index.html.twig', ['webcams' => $webcams]);
    }
}
