<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Resource;
use App\Models\Topic;
use App\Models\Wysiwig;
use App\Utils\Common\ActivityTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'cover_image'   => "../../../lms/app-assets/images/illustration/api.svg",
                'title'         => 'Introduction To Computer Programming',
                'slug'          => Str::slug('Introduction To Computer Programming'),
                'description'   => 'Why learn computer programming?',
                'course_code'   => 'CD-123818',
                'author'        => 'Stephen Hawking',
                'trainer_id'    => '1',
                'category_id'   => '1',
                'is_active'     => true,
                'status'        => '1',
                'position'      => '1',
                'topics'        => [
                    [
                        'title'        => 'Introduction To Programming Fundamentals',
                        'slug'         => Str::slug('Introduction To Programming Fundamentals'),
                        'description'  => 'Variables | Loops | Conditions',
                        'position'     => '1',
                        'activities'   => [
                            [
                                'title' => 'Learn Loops (For, While & Do While)',
                                'slug' => Str::slug('Learn Loops (For, While & Do While)'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 1,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 1,
                            ],
                            [
                                'title' => 'Variables & Operators',
                                'slug' => Str::slug('Variables & Operators'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 3,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 2,
                            ],
                        ],
                    ],
                    [
                        'title'        => 'Basic Programming Techniques',
                        'slug'         => Str::slug('Basic Programming Techniques'),
                        'description'  => 'Divide And Conquer',
                        'position'     => '2',
                        'activities'   => [
                            [
                                'title' => 'Top Down Approach',
                                'slug' => Str::slug('Top Down Approach'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 1,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 1,
                            ],
                            [
                                'title' => 'Bottom Up Approach',
                                'slug' => Str::slug('Bottom Up Approach'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 3,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 2,
                            ],
                        ],
                    ],

                ]
            ],
            [
                'cover_image'   => "../../../lms/app-assets/images/illustration/sales.svg",
                'title'         => 'Data Structure and Algorithms',
                'slug'          => Str::slug('Data Structure and Algorithms'),
                'description'   => 'We learn basic data-structures and algorithms',
                'course_code'   => 'CD-123818-2',
                'author'        => 'Walter Dornberger',
                'trainer_id'    => '2',
                'category_id'   => '2',
                'is_active'     => true,
                'status'        => '1',
                'position'      => '1',
                'topics'        => [
                    [
                        'title'        => 'Introduction',
                        'slug'         => Str::slug('Introduction'),
                        'description'  => 'What is data structures?',
                        'position'     => '1',
                        'activities'   => [
                            [
                                'title' => 'Programming Quiz',
                                'slug' => Str::slug('Programming Quiz'),
                                'type' => ActivityTypes::QUIZ,
                                'position' => 1,
                                'activity_type' => Quiz::class,
                                'activity_id' => 1,
                            ],
                            [
                                'title' => 'What Are Queues?',
                                'slug' => Str::slug('What Are Queues?'),
                                'type' => ActivityTypes::RESOURCE,
                                'position' => 2,
                                'activity_type' => Resource::class,
                                'activity_id' => 1,
                            ]
                        ],
                    ],
                    [
                        'title'         => 'Basic Algorithms',
                        'slug'          => Str::slug('Basic Algorithms'),
                        'description'  => 'description TOPIC',
                        'position'     => '2',
                        'activities'   => [
                            [
                                'title' => 'Open Shortest Path First?',
                                'slug' => Str::slug('Open Shortest Path First'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 1,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 1,
                            ],
                            [
                                'title' => 'Depth First Traversal',
                                'slug' => Str::slug('Depth First Traversal'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 2,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 2,
                            ]
                        ],

                    ],

                ]
            ],
            [
                'cover_image'   => "../../../lms/app-assets/images/illustration/email.svg",
                'title'         => 'Human Resource Management',
                'slug'          => Str::slug('Human Resource Management'),
                'description'   => 'You will learn basics about how to work with people.',
                'course_code'   => 'CD-124818-2',
                'author'        => 'Walter Dornberger',
                'trainer_id'    => '2',
                'category_id'   => '2',
                'is_active'     => true,
                'status'        => '1',
                'position'      => '1',
                'topics'        => [
                    [
                        'title'        => 'Introduction',
                        'slug'         => Str::slug('Introduction'),
                        'description'  => 'Background Check',
                        'position'     => '1',
                        'activities'   => [
                            [
                                'title' => 'What Is HRM Quiz',
                                'slug' => Str::slug('What Is HRM Quiz'),
                                'type' => ActivityTypes::QUIZ,
                                'position' => 1,
                                'activity_type' => Quiz::class,
                                'activity_id' => 1,
                            ],
                            [
                                'title' => 'Handouts',
                                'slug' => Str::slug('Handouts'),
                                'type' => ActivityTypes::RESOURCE,
                                'position' => 2,
                                'activity_type' => Resource::class,
                                'activity_id' => 1,
                            ],
                            [
                                'title' => 'Case Study 3',
                                'slug' => Str::slug('Case Study 3'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 3,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 1,
                            ],
                        ],
                    ],
                    [
                        'title'         => 'Popular Techniques',
                        'slug'          => Str::slug('Popular Techniques'),
                        'description'  => 'You will see how can people do work in organizations',
                        'position'     => '2',
                        'activities'   => [
                            [
                                'title' => 'Case Study 1',
                                'slug' => Str::slug('Case Study 1'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 1,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 1,
                            ],
                            [
                                'title' => 'Case Study 2',
                                'slug' => Str::slug('Case Study 2'),
                                'type' => ActivityTypes::WYSIWIG,
                                'position' => 2,
                                'activity_type' => Wysiwig::class,
                                'activity_id' => 2,
                            ]
                        ],

                    ],

                ]
            ]
        ];

        foreach ($courses as $course) {
            $topics = $course['topics'];
            unset($course['topics']);
            $courseObj = Course::create($course);
            foreach ($topics as $topic) {
                $activities = $topic['activities'];
                unset($topic['activities']);
                $topic['course_id'] = $courseObj->id;
                $topic['slug'] = $topic['slug'] . '-' . $courseObj->id;
                $topicObj = Topic::create($topic);

                foreach ($activities as $activity) {
                    $activity['topic_id'] = $topicObj->id;
                    $activity['slug'] = $activity['slug'] . '-' . $topicObj->id;

                    Activity::create($activity);
                    // $topicObj->contents()->create($activity);
                }
            }
        }
    }
}
