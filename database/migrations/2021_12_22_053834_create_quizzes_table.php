<?php

use App\Utils\Common\SystemTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('trainer_id')->constrained('users')->cascadeOnDelete();
            $table->integer('duration');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('type')->default(SystemTypes::PORTAL);
            $table->integer('total_marks');
            $table->integer('passing_marks');
            $table->integer('allowed_attempts')->default(1);
            // $table->integer('type')->comment(implode(' | ',ResourceTypes::All)); //QUIZ TYPE BASED ON SYSTEM
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
        Schema::dropIfExists('quizzes');
    }
}
