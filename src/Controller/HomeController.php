<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\CocktailApi;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index()
    {
        $cocktailApi = new CocktailApi();
        $cocktail = $cocktailApi->getRandomCocktail();
        return $this->twig->render('Home/index.html.twig', ['cocktail' => $cocktail]);
    }
}
