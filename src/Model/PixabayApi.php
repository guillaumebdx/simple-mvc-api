<?php

namespace App\Model;

class PixabayApi extends AbstractApi
{
    /**
     * @param int $id
     * @return array
     */
    public function getBackgroundById(int $id)
    {
        $url = 'https://pixabay.com/api/?key=' . APP_API_KEY_PIXABAY . '&id=' . $id;
        $background = $this->get($url);
        return $background['hits']['0']['largeImageURL'];
    }
}
