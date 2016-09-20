<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Answers;

class QuestionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get All Questions and Answare
     */
    public static function GetQuestions(){
        $result = Questions::Get();
        foreach ($result as $key => $value) {
            $data[$key]= $value; 
            $answers=Answers::where('id_question', $value->id)->get();
            $data[$key]['answers']=$answers;
        }
        return $data;
    }
  
}
