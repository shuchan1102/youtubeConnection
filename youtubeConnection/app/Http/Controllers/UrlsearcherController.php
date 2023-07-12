<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpQuery;
use Illuminate\Support\Facades\Log;



class UrlsearcherController extends Controller
{
    //
    function urlsearch(Request $request)
    {
        $url =  $request->url;
        $DEVELOPER_KEY = 'AIzaSyD9HNmBtYAovPaHFO4ecUlwsR2-kOh2zPw';

        require_once("phpQuery-onefile.php");
        $html = file_get_contents($url);

        // ytInitialDataで分割する
        $ytInitialData = explode("ytInitialData", $html);
        //channelId": で分割する
        $gridChannelRenderer = explode("channelId", $ytInitialData[1]);

        //整形
        $beforeChanenelId = explode(",", $gridChannelRenderer[1]);
        $channelId = str_replace("\":\"", "", $beforeChanenelId[0]);
        $channelId = str_replace("\"", "", $channelId);

        $api_url_idGetter = 'https://www.googleapis.com/youtube/v3/search?key=' . $DEVELOPER_KEY . '&q=' . $url . '&type=channnel&part=snippet';
        // echo '<br>' . $api_url_idGetter;
        $channelId_info = file_get_contents($api_url_idGetter);
        $channelId_info = json_decode($channelId_info, true);

        $channelId = $channelId_info['items'][0]['snippet']['channelId'];
        
        // echo $channelId;
        // echo '<br>';

        $api_url_channels = 'https://www.googleapis.com/youtube/v3/channels?key=' . $DEVELOPER_KEY . '&id=' . $channelId . '&part=contentDetails';
        // echo "<br>..channels：" . $api_url_channels;
        $playlistId_info = file_get_contents($api_url_channels);
        $playlistId_info = json_decode($playlistId_info, true);

        $playlistId = $playlistId_info['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

        // echo $playlistId;
        // echo '<br>';

        //動画情報
        $api_url_playlistItems = 'https://www.googleapis.com/youtube/v3/playlistItems?key=' . $DEVELOPER_KEY . '&playlistId=' . $playlistId . '&maxResults=50&part=snippet';
        // echo "<br>..playlistItems：" . $api_url_playlistItems;
        $video_info = file_get_contents($api_url_playlistItems);
        $video_info = json_decode($video_info, true);

        foreach ($video_info['items'] as $vi) {
            $playlistIds[] = $vi['snippet']['resourceId']['videoId'];
        }

        //デバッグ
        // foreach ($playlistIds as $pli) {
        //     echo $pli;
        //     echo "<br>";
        // }

        $playlistId = implode(",", $playlistIds);

        //動画詳細情報
        $api_url_videos = 'https://www.googleapis.com/youtube/v3/videos?key=' . $DEVELOPER_KEY . '&id=' . $playlistId . '&part=snippet,statistics';
        // echo $api_url_videos;
        $video_details_info = file_get_contents($api_url_videos);
        $video_details_info = json_decode($video_details_info, true);

        $videosInfo;
        $loopCount = 0;

        foreach ($video_details_info['items'] as $vdi) {
            $videosInfo[$loopCount]['title'] = $vdi['snippet']['title']; // 動画タイトル
            $videosInfo[$loopCount]['viewCount'] = $vdi['statistics']['viewCount']; // 視聴回数
            $videosInfo[$loopCount]['likeCount'] = $vdi['statistics']['likeCount']; // 高評価数
            $videosInfo[$loopCount]['commentCount'] = $vdi['statistics']['commentCount']; // コメント数
            $videosInfo[$loopCount]['likeCountPer'] = self::likeCountPerCalc($vdi['statistics']['viewCount'], $vdi['statistics']['likeCount']); // 高評価割合
            $loopCount++;
        }

        //デバッグ
        // foreach ($videosInfo as $vi) {
        //     foreach ($vi as $video) {
        //         echo $video;
        //         echo "<br>";
        //     }
        // }

        return view('videoList')->with('videosInfo',$videosInfo);
    }

    // 高評価割合計算処理
    function likeCountPerCalc($viewCount, $likeCount)
    {   
        if($viewCount == 0 or $likeCount ==0){
            $likeCountPer = 0;
        }else{
            $likeCountPer = (int)$likeCount / (int)$viewCount;
        }
        return round(($likeCountPer * 100), 2);
    }
}
