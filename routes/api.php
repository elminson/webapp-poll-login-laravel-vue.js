<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UsersAnswersController;

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
	return 	AuthController::login(Request::All());

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
return  QuestionsController::GetQuestions();
});

/*
|--------------------------------------------------------------------------
| API User Answers
|--------------------------------------------------------------------------
|	Recive the users Answers and save it in users_answers
*/

Route::post('/useranswers', function (){
	return UsersAnswersController::Save(Request::all());
});

