<?php


namespace App\Controller;

use App\Model\QuizzManager;

class QuizzController extends AbstractController
{
    public function play(string $theme)
    {
        $quizz = new QuizzManager();
        $questions = $quizz->selectByTheme($theme);
        return $this->twig->render('Quizz/play.html.twig', ['questions' => $questions]);
    }
}
