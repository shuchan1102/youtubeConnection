<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UrlsearcherController extends Controller
{
    //
    function urlsearch(Request $request){

        $url =  $request->url;
        $sourceCode = file_get_contents($url);
        $jo = json_decode($sourceCode);

        echo count($jo);

        return view('videoList');
    }
}
