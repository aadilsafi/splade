<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_imports', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->foreignId('difficulty_level_id')->constrained();
            $table->foreignId('question_bank_id')->constrained('question_banks')->cascadeOnDelete();
            $table->text('answers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_imports');
    }
}
