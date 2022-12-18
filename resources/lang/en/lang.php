<?php

return [
    'leftbar' => [
        'dashboard'         => 'Dashboard',
        'home'              => 'Home',
        'management'        => 'Management',
        'users'             => 'Users',
        'banks'             => 'Banks',
        'question-banks'    => 'Question Banks',
        'quizzes'           => 'Quizzes',
        'categories'        => 'Categories',
        'site_settings'     => 'Site Configurations',
        'courses'           => 'Trainings'

    ],
    'fields' => [
        'user' => [
            'singular'          => 'User',
            'plural'            => 'Users',
            'username'          => 'Username',
            'email'             => 'Primary Email',
            'secondary_email'   => 'Secondary Email',
            'contact_number'    => 'Contact Number',
            'messages'          => [
                "edit_user_info" => "Edit User Information",
            ],
        ],
        'trainer' => [
            'singular'          => 'Trainer',
            'plural'            => 'Trainers',
        ],
        'trainee' => [
            'singular'          => 'Trainee',
            'plural'            => 'Trainees',
        ],
        'category' => [
            'singular'          => 'Category',
            'plural'            => 'Categories',
            'show'              => 'Show',
            'slug'              => 'Category Slug',
            'sub_categories'    => 'Sub Categories',
            'parent_category'   => 'Parent Category',
            'name'              => 'Category Name',
            'messages'          => [
                "select_category_to_show_courses" => "Please Select Category From Left Side To Show Courses",
                "no_courses_in_category"          => "No Courses In Select Category",
            ],
        ],
        'course' => [
            'singular'          => 'Course',
            'plural'            => 'Courses',
            'title'             => 'Title',
            'course_code'       => 'Course Code',
            'description'       => 'Description',
            'author'            => 'Author',
            'cover_image'       => 'Cover Image',
            'enrolled'          => 'Courses Enrolled',
            'enroll'            => 'Enroll',
            'enrollment_type'   => 'Enrollment Type',
            'disenroll'         => 'UnEnroll'

        ],
        'topic' => [
            'singular'          => 'Topic',
            'plural'            => 'Topics',
            'title'             => 'Title',
            'description'       => 'Description',
            'slug'              => 'Slug',
            'completed'         => 'Topics Completed',
        ],
        'activity' => [
            'singular'          => 'Activity',
            'plural'            => 'Activities',
            'title'             => 'Title',
            'slug'              => 'Slug',
            'type'              => 'Type',
        ],
        'question-bank' => [
            'singular'          => 'Question Bank',
            'plural'            => 'Question Banks',
        ],
        'question' => [
            'singular'          => 'Question',
            'plural'            => 'Questions',
            'name'              => 'Name',
            'difficulty_level'  => 'Difficulty Level',
        ],
        'scorm' => [
            'scorm'             => 'Scorm'
        ],
        'quiz' => [
            'singular'          => 'Quiz',
            'plural'            => 'Quizes',
            'name'              => 'Name',
            'duration'          => 'Duration',
            'start_date'        => 'Start Date',
            'end_date'          => 'End Date',
            'total_questions'   => 'Total Questions',
            'total_marks'       => 'Total Marks',
            'passing_marks'     => 'Passing Marks'


        ]



    ],
    'commons' => [
        'view_report'                       => 'View Report',
        'course'                            => 'Training',
        'attempt'                           => 'Attempt',
        'cancel'                            => 'Cancel',
        'yes_delete'                        => 'Yes Delete',
        'data_saved'                        => 'Data saved!',
        'data_updated'                      => 'Data Updated',
        'are_you_sure'                      => 'Are You sure you want to delete the selected items',
        'please_select_at_least_one_item'   => 'Please Select Atleast One Item',
        'edit'                              => 'Edit',
        'add'                               => 'Add',
        'delete'                            => 'Delete',
        'create'                            => 'Create',
        'enter'                             => 'Enter',
        'save'                              => 'Save',
        'update'                            => 'Update',
        'select'                            => 'Select',
        'bulk-upload'                       => 'Bulk upload',
        'total_users'                       => 'Total Users',
        'total_courses'                     => 'Total Courses',
        'active_users'                      => 'Active Users',
        'total_topics'                      => 'Total Topics',
        'body'                              => 'Body',
        'file'                              => 'File',

    ],
    'portalsidebar' => [
        'my_profile'                            => 'My Profile',
        'my_training_calendar'                  => 'My Training Calendar',
        'leaderboard'                            => 'Leaderboard',
        'weekly_quiz'                            => 'Weekly Quiz',

    ],
    'errors' => [
        'something_went_wrong'  => 'Something Went Wrong',
        'data_deleted'          => 'Data Deleted',
        'data_not_found'        => 'Data Not Found'
    ]
];
