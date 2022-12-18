<?php

use App\Utils\Common\AttemptStatus;
use App\Utils\Common\SystemTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->foreignId('answer_id')->nullable()->constrained('answers')->cascadeOnDelete();
            $table->boolean('is_correct')->default(0);
            $table->double('marks',8,2);
            $table->double('total_marks')->nullable();
            $table->integer('type')->default(SystemTypes::PORTAL);
            $table->foreignId('quiz_id')->constrained('quizzes')->cascadeOnDelete();
            $table->integer('count')->default(1);
            $table->integer('status')->default(AttemptStatus::PENDING);
            $table->unique(['user_id','quiz_id','question_id']);
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
        Schema::dropIfExists('attempts');
    }
}
