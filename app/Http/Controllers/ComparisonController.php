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
            if(file_exists('data.json')){
                unlink("data.json"); 
            }
            if(file_exists('myfile.json')){
                unlink("myfile.json"); 
            }
            $arrayResult=[];
            $url1 = $request->url1;
            $url2 = $request->url2;
            //$arr = array('a' => $url1, 'b' => $url2);
            $result = shell_exec('python ' . app_path(). '\http\controllers\ORB\trafi.py "'.$url1.'"');
            $result2 = shell_exec('python ' . app_path(). '\http\controllers\ORB\trafi.py "'.$url2.'"');
            $result=iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($result));
            $result2=iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($result2));
            if($result=="Web site does not exist\n" || $result2=="Web site does not exist\n"){
                return "Error";
            }
            $arrayResult["url1"]=explode(' ,.,.,. ',$result);
            $arrayResult["url2"]=explode(' ,.,.,. ',$result2);
            $r =json_encode($arrayResult);
            $bytes = file_put_contents("myfile.json", $r);
            $result3 = shell_exec('python ' . app_path(). '\http\controllers\ORB\test.py');
            return $result3;
    }
}
