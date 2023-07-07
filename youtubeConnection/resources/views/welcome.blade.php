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
    <!-- Styles -->
</head>

<body>
    <div class="header">
        <br>
        <a href="/">youtubeConnection</a>
    </div>
    <div class="main">
        <h1>youtubeConnection</h1>
        <div class="selectMenu">
            <form class="main_select" action="search" method="GET">
                <input type="submit" value="検索画面">
            </form>
            <form class="main_select" action="videoUpload" method="GET">
                <input type="submit" value="動画投稿画面">
            </form>
        </div>
    </div>

</body>

</html>