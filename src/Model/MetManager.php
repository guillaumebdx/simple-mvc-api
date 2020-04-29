<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;

class MetManager
{
    /**
     * @param string $location
     * @param string $dateBegin
     * @param string $dateEnd
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getObjectsByLocationAndPeriod(string $location, string $dateBegin, string $dateEnd)
    {
        $url = "https://collectionapi.metmuseum.org/public/collection/v1/search?geoLocation=".$location;
        $url .= "&dateBegin=".$dateBegin."&dateEnd=".$dateEnd."&q=".$location;
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        return $response->toArray();
    }

    public function getInfosById(int $id)
    {
        $url = "https://collectionapi.metmuseum.org/public/collection/v1/objects/".$id;
        $client = HttpClient::create();
        $response = $client->request('GET', $url);
        return $response->toArray();
    }
}
