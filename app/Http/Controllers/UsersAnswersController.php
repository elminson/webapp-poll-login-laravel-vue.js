<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\UsersAnswers;

class UsersAnswersController extends Controller
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
    public static function Save($result){
		if(empty($result)) return array('error'=>true);
		$user=$result['id'];
		$token=$result['token'];
		unset($result['id']);
		unset($result['token']);
		//Validate with the token valid user
		//
		//
		$arra_data=array();
			foreach ($result as $key => $value) {
				if(is_array($value)){
					foreach ($value as $key_a => $val) {
						foreach ($val as $key_b => $val) {
							if($val==1){
							$array_data[]=array('id_user'=>$user,'id_question'=>$key,'id_answer'=>$key_a,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
							}
						}
					}
				} else {
				$array_data[]=array('id_user'=>$user,'id_question'=>$key,'id_answer'=>$value,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
				}
			}
		UsersAnswers::insert($array_data);		
		return $array_data;
    }
}
