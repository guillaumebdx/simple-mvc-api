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
    /**
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
    public function travel()
    {
        $metManager = new MetManager();
        $artwork =[];


        if (isset($_POST['region']) && empty($_POST['dateBegin']) && empty($_POST['dateEnd'])) {
            echo "if";
            $dateBegin = '-3000';
            $dateEnd = '2000';
            $location= $_POST['region'];
            $object=$metManager->getObjectsByLocationAndPeriod($location, $dateBegin, $dateEnd);

            for ($i=0; $i<=3; $i++) {
                $rand =rand(1, count($object['objectIDs']));
                $id=$object['objectIDs'][$rand];
                $artwork[$i] = $metManager->getInfosById($id);
            }

            return $this->twig->render('Met/artView.html.twig', [
                'artwork' => $artwork
            ]);
        } elseif (isset($_POST['region']) && isset($_POST['dateBegin']) && isset($_POST['dateEnd'])) {
            echo "elseif";
            $dateBegin = $_POST['dateBegin'];
            $dateEnd = $_POST['dateEnd'];
            $location= $_POST['region'];

            $object=$metManager->getObjectsByLocationAndPeriod($location, $dateBegin, $dateEnd);

            for ($i=0; $i<=3; $i++) {
                $rand =rand(3, count($object['objectIDs']));
                $id=$object['objectIDs'][$i+$rand];
                $artwork[$i] = $metManager->getInfosById($id);
            }
            return $this->twig->render('Met/artView.html.twig', [
                'artwork' => $artwork
            ]);
        }
    }
}
