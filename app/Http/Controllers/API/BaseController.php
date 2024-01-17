<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result,$message)
    {

        $response=
        [ 
              'success'   =>true,
              'message'   =>$message,
              'data'      =>$result  
        ];
         
         return  response()->json($response,200);
    }
    public function sendError($error,$errormessage=[],$code=404)
    {

        $error=
        [ 
              'success'   =>false,
              'message'   =>$error,
        ];
             if(!empty($errormessage))
             {
                $response['data']=$errormessage;
             }         
         return  response()->json($response,$code);
    }


}
