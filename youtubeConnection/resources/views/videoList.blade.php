<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>動画情報一覧</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/welcomeStyle.css">
    <link rel="stylesheet" href="/css/headerStyle.css">
    <!-- Styles -->
</head>

<body>
    <div class="header">
        <br>
        <a href="/">youtubeConnection</a>
    </div>
    <div class="main">
        <h1>動画情報詳細一覧</h1>
        <div class="message">
            @for($i = 0; $i < count($videosInfo);$i++)
            <table>
                <tr>
                    <th>動画タイトル</th>
                    <td style="text-align:left;">{{$videosInfo[$i]['title']}}</td>
                </tr>
                <tr>
                    <th>再生回数</th>
                    <td style="text-align:left;">{{$videosInfo[$i]['viewCount']}}回</td>
                </tr>
                <tr>
                    <th>コメント数</th>
                    <td style="text-align:left;">{{$videosInfo[$i]['commentCount']}}件</td>
                </tr>
                <tr>
                    <th>高評価数</th>
                    <td style="text-align:left;">{{$videosInfo[$i]['likeCount']}}件</td>
                </tr>
                <tr>
                    <th>高評価率</th>
                    <td style="text-align:left;">{{$videosInfo[$i]['likeCountPer']}}％</td>
                </tr>
                </table>

                @endfor
        </div>
        <br>
        <a style="text-decoration:none;color:white;" href="/">トップページへ戻る</a>
    </div>

</body>

</html>