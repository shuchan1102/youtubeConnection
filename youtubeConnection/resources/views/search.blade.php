<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/welcomeStyle.css">
    <link rel="stylesheet" href="/css/headerStyle.css">
    <link rel="stylesheet" href="/css/searchStyle.css">
    <!-- Styles -->
</head>

<body>
    <div class="header">
        <br>
        <a href="/">youtubeConnection</a>
    </div>
    <div class="main">
        <h1>youtubeConnection</h1>
        <div>
            検索したいyoutubeチャンネルのトップページURLを入力
            <form action="search/urlSearcher" method="POST">
                @csrf
                <br>
                <input type="text" class="url" name="url" id="url" placeholder="例）https://www.youtube.com/@HikakinTV">
                <br><br>
                <input type="submit" value="検索開始">
            </form>
        </div>
    </div>

</body>

</html>