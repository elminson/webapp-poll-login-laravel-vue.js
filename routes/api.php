<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

/*
|--------------------------------------------------------------------------
| API User
|--------------------------------------------------------------------------
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/login', function () {
		$request=Request::All();
		if(empty($request)) return array('error'=>true);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
  			$user_data=Auth::getuser();
  			return array('id'=>$user_data->id,'token'=>$user_data->remember_token,'name'=>$user_data->name,'email'=>$user_data->email);
		} else {
		return array('error'=>'Invalid Credential');
	}
});

Route::post('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


/*
|--------------------------------------------------------------------------
| API Questions
|--------------------------------------------------------------------------
|	Get all question in the table questinos and the possibles answers
*/
Route::get('/questions', function (){


	$result = DB::table('questions')->get();
	foreach ($result as $key => $value) {
		$value->answers=DB::table('answers')->where('answers.id_question',$value->id)->get();
		$data[]= $value;

	}	
return $data;
});

/*
|--------------------------------------------------------------------------
| API User Answers
|--------------------------------------------------------------------------
|	Recive the users Answers and save it in users_answers
*/

Route::post('/useranswers', function (){
		$result=Request::All();
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
DB::table('users_answers')->insert($array_data);		
return $array_data;

	//return App\UsersAnswers::create(Request::all());
});

