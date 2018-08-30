<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('type');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('questions')->insert(
            array(
                'question' => 'How did you feel?',
                'type' => 'radio'
            ),
            array(
                'question' => 'What did you have for Breakfast?',
                'type' => 'checkbox'
            ),
            array(
                'question' => 'Did you run Today?',
                'type' => 'radio'
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
        Schema::dropIfExists('questions');
    }
}
