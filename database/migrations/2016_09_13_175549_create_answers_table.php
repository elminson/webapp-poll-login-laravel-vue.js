<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_question');
            $table->text('answer');
            $table->timestamps();
        });
        // Insert some stuff
        DB::table('questions')->insert(
            array(
                'id_question' => 1,
                'answer' => 'Bad'
            ),
            array(
                'id_question' => 1,
                'answer' => 'Good'
            ),
            array(
                'id_question' => 1,
                'answer' => 'Excelent'
            ),
            array(
                'id_question' => 2,
                'answer' => 'Fruits'
            ),
            array(
                'id_question' => 2,
                'answer' => 'Cereal'
            ),
            array(
                'id_question' => 2,
                'answer' => 'Coffee'
            ),
            array(
                'id_question' => 3,
                'answer' => 'Yes'
            ),
            array(
                'id_question' => 3,
                'answer' => 'No'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
