<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testRadioQuestions()
    {
    	//test radio questions
        $this->json('POST', 'api/useranswers', ['user' => '1','1'=>'2','3'=>'1'])
             ->seeJson([
                 'id_user' => '1'
             ]);
    }

    public function testCheckboxQuestions()
    {
    	//test checkbox questions
        $this->json('POST', 'api/useranswers', ['user' => '1','1'=>'2',"2"=>["7"=>["Cereal"=>true]],'3'=>'1']) 
             ->seeJson([
                 'id_user' => '1'
             ]);
    }

    public function testPostEmptyAnswers()
    {
    	//test checkbox questions
        $this->json('POST', 'api/useranswers', []) 
             ->seeJson([
                 'error' => true
             ]);
    }

    public function testGetQuestions()
    {
    	//test checkbox questions
        $this->json('GET', 'api/questions') 
             ->seeText("answers");
    }

}
