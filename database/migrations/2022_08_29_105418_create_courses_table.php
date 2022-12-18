<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('slug');
            $table->string('course_code');
            $table->string('cover_image')->nullable();
            $table->integer('position');
            $table->boolean('is_active')->default(false);
            $table->integer('status')->default(\App\Utils\Common\CourseStatus::DRAFT);
            $table->string('author')->nullable();
            $table->foreignId('trainer_id')->nullable()->constrained('users');
            $table->foreignId('category_id')->constrained();
            $table->unique(['slug', 'category_id']);
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
        Schema::dropIfExists('courses');
    }
}
