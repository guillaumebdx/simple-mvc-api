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
        $art = new MetManager();
        $objects = $art->getObjectsByLocationAndPeriod("Greece", "-3000", "476");
        $id = $objects["objectIDs"][0];
        $artwork = $art->getInfosById($id);
        return $this->twig->render('Met/artView.html.twig', [
            'artwork' => $artwork
        ]);
    }
}
