<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->integer('type');
            $table->integer('position');
            $table->foreignId('topic_id')->constrained();
            $table->morphs('activity'); // wysiwigs | Quiz | Resources /
            $table->boolean('is_record')->default(0);
            // $table->foreignId('user_id')->nullable();
            $table->unique(['slug','topic_id']);
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
        Schema::dropIfExists('activities');
    }
}
