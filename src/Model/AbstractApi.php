<?php

namespace App\Model;

use Exception;
use Symfony\Component\HttpClient\HttpClient;

class AbstractApi
{
    protected function get(string $url)
    {
        $client   = HttpClient::create();
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() === 403) {
            throw new Exception('
            Access forbidden, check your API Key.
            ');
        } elseif ($response->getStatusCode() !== 200) {
            throw new Exception('
            Impossible to resolve this request. 
            Please check your URL and your API KEY');
        } else {
            return $response->toArray();
        }
    }
}
