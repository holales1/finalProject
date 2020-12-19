<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function store(Request $request)
    {
            //
            //
            //return response()->json(['success'=>'Data is successfully added']);
            $arrayResult=[];
            $url1 = $request->url1;
            $url2 = $request->url2;
            //$arr = array('a' => $url1, 'b' => $url2);
            $result = shell_exec('python ' . app_path(). '\http\controllers\ORB\trafi.py "'.$url1.'"');
            $result2 = shell_exec('python ' . app_path(). '\http\controllers\ORB\trafi.py "'.$url2.'"');
            array_push($arrayResult,explode(' ,.,.,. ',$result));
            array_push($arrayResult,$result2);
            return json_encode($arrayResult);
    }
}
