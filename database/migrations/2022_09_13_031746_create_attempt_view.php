<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Schema;
class CreateAttemptView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         \DB::statement($this->createView());

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW attemptview');
    }

    private function createView()
    {
         return <<<SQL
                CREATE OR REPLACE VIEW attempt_views  AS
                    SELECT attempts.user_id,
                    attempts.quiz_id,
                    sum(attempts.marks) as score,
                    quizzes.total_marks,
                    quizzes.passing_marks
                FROM `attempts` 
                INNER JOIN quizzes ON attempts.quiz_id = quizzes.id
                GROUP BY attempts.user_id
        SQL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView()
    {
        return <<<SQL
            DROP VIEW IF EXISTS `attempt_views`;
        SQL;
    }
}
