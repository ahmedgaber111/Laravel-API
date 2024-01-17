<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\books;
use Illuminate\Support\Facades\Validator;

class BookController extends BaseController
{

    public function index()
     {
    
     $books=books::all();
     return $this->sendResponse($books->toArray(),'Books are success');
    }

    public function store(Request$request)
    {
        $input=$request->all();
        $Validator=Validator::make($input,
        [
            'name'=>'required',
            'details'=>'required',
        ]);
           
        if ($Validator->fails()) 
        {
            return $this->sendError('error validation',$Validator->errors());
        }
        $books=books::create($input);
     return   $this->sendResponse($books->toArray(),'book is success');
    }

    public function show($id)
    {
         $book=books::find($id);
           
        if (!$book) 
        {
            return $this->sendError('book not found id');
        }
     return   $this->sendResponse($book->toArray(),'book found');
    }
    public function update(Request$request,books$book)
    {
        $input=$request->all();
        $Validator=Validator::make($input,
        [
            'name'=>'required',
            'details'=>'required',
        ]);
           
        if ($Validator->fails()) 
        {
            return $this->sendError('error validation',$Validator->errors());
        }
        $book->name=$input['name'];
        $book->details=$input['details'];
        $book->save();
        return   $this->sendResponse($book->toArray(),'book is updated');
    }



}
