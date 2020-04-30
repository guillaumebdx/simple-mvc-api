<?php


namespace App\Controller;

use App\Model\MetManager;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ArtController extends AbstractController
{
    const PERIODS = array(
        "antiquity" => [
            "begin" => '-3000',
            "end" => '475'
        ],
        "middleAge" => [
            "begin" => '476',
            "end" => '1491'
        ],
        "modern" => [
            "begin" => '1492',
            "end" => '1788'
        ],
        "contemporary" => [
            "begin" => '1789',
            "end" => '2020'
        ]);

    /**
     * Treat the form
     */
    public function initiate()
    {
        $location ='';
        $periodBegin = 'antiquity';
        if (isset($_POST['region']) && empty($_POST['periodBegin'])) {
            $location = $_POST['region'];
        } elseif (isset($_POST['region']) && !empty($_POST['periodBegin'])) {
            $periodBegin = $_POST['periodBegin'];
            $location = $_POST['region'];
        }
        header("Location: /art/journey/{$location}/{$periodBegin}");
    }

    /**
     * Get the informations to display
     * @param string $location
     * @param string $currentPeriod
     * @return string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function journey(string $location, string $currentPeriod)
    {
        $nextPeriod = [];

        if (!isset($_POST['region'])) {
            $nextPeriod = $this->getNextPeriod($currentPeriod);
        }

        return $this->output($location, $currentPeriod, $nextPeriod);
    }

    /**
     * Display the informations
     * @param string $location
     * @param string $currentPeriod
     * @param  mixed $nextPeriod
     * @return string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function output(string $location, string $currentPeriod, $nextPeriod): string
    {
        $metManager = new MetManager();
        $periods = self::PERIODS;
        $begin = $periods[$currentPeriod]["begin"];
        $end = $periods[$currentPeriod]["end"];

        $object = $metManager->getObjectsByLocationAndPeriod($location, $begin, $end);

        if (!empty($nextPeriod)) {
            $target = '/art/journey/'.$location.'/'.$nextPeriod;
        } else {
            $target = '/';
        }

        $artworks = $this->randomPick(3, $object['objectIDs']);
        return $this->twig->render('Met/artView.html.twig', [
            'artworks' => $artworks,
            'target' => $target,
        ]);
    }

    /**
     * @param string $period
     * @return mixed
     */
    private function getNextPeriod(string $period)
    {
        if (!empty($period)) {
            $array = self::PERIODS;

            $begin = $array[$period]["begin"];

            foreach ($array as $item) {
                $isTargetPeriod = in_array($begin, $item);
                next($array);
                if ($isTargetPeriod === true) {
                    break;
                }
            }
            $target = key($array);
        } else {
            $target = '/';
        }

        return $target;
    }

    /**
     * @param int $number
     * @param array $objects.
     * @var MetManager $metManager
     * @var int $rand
     * @var int $id
     * @return array
     */
    private function randomPick(int $number, array $objects): array
    {
        $metManager = new MetManager();
        $artworks = [];
        for ($i=0; $i<$number; $i++) {
            $rand = rand(1, count($objects));
            $id = $objects[$rand];
            $artworks[$i] = $metManager->getInfosById($id);
        }

        return $artworks;
    }
}
