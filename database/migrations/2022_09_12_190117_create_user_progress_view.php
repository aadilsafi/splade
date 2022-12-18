<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProgressView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement($this->dropView());
        // DB::statement($this->createView());
    }

    private function dropView(): string
    {
        return <<<SQL
       DROP VIEW IF EXISTS `user_progress_view`;
       SQL;
    }

    private function createView(): string
    {
                    //course_id topic_id activity_id user_id progress % 
                    
        return <<<SQL
                CREATE VIEW `user_progress_view` AS
                SELECT 
                    attempts.user_id,attempts.quiz_id
                        
            FROM attempts
            GROUP BY attempts.user_id
       SQL;
    }
}
// CREATE VIEW view_user_data AS

// SELECT 

//     users.id, 

//     users.name, 

//     users.email,

//     (SELECT count(*) FROM posts

//                 WHERE posts.user_id = users.id

//             ) AS total_posts,

//     (SELECT count(*) FROM comments

//                 WHERE comments.user_id = users.id

//             ) AS total_comments

// FROM users