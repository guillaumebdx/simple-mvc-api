<?php
namespace App\Controller;

class VideoController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Video/index.html.twig');
    }
    public function picture($id)
    {
        $url = 'https://api.windy.com/api/webcams/v2/list/webcam=';
        $videoData = $this->get($url.$id.'?show=webcams:player&key=' . APP_API_KEY);
        $paragrapheData = $this->get($url.$id.'?show=webcams:location&key=' .APP_API_KEY);
        $para = $paragrapheData['result']['webcams'][0];
        $data3 = 'https://webcams.windy.com/webcams/stream/'.$id;
        $data = $videoData['result']['webcams'][0]['player']['live'];
        $data2 = $videoData['result']['webcams'][0]['player']['day'];

        if ($data['available']==true) {
            return $this->twig->render('Video/index.html.twig', [
                'data' => $data3,
                'para' => $para['location'],
            ]);
        } else {
            return $this->twig->render('Video/index.html.twig', [
                'data' => $data2['embed'],
                'para' => $para['location'],
            ]);
        }
    }
}
