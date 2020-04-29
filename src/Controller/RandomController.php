<?php

namespace App\Controller;

class RandomController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Random/random.html.twig');
    }
    public function picture()
    {
        $url = 'https://api.windy.com/api/webcams/v2/list/orderby=random';
        $videoData = $this->get($url.'?show=webcams:player&key=' . APP_API_KEY);
        $paragrapheData = $this->get($url.'?show=webcams:location&key=' .APP_API_KEY);
        $viewData = $this->get($url.'?show=webcams:location,statistics&key=' .APP_API_KEY);
        $view = $viewData['result']['webcams'][0]['statistics'];
        $para = $paragrapheData['result']['webcams'][0];
        //$data3 = 'https://webcams.windy.com/webcams/stream/'.$id;
        $data = $videoData['result']['webcams'][0]['player']['live'];
        $data2 = $videoData['result']['webcams'][0]['player']['day'];
        if ($data['available']==true) {
            return $this->twig->render('Random/random.html.twig', [
                'data' => $data,
                'para' => $para['location'],
                'view' => $view['views'],
            ]);
        } else {
            return $this->twig->render('Random/random.html.twig', [
                'data' => $data2['embed'],
                'para' => $para['location'],
                'view' => $view['views'],
            ]);
        }
    }
}
