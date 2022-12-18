<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Utils\Helper;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home


// Breadcrumbs::for('bingo', function (BreadcrumbTrail $trail) {

//     $trail->push('dashboard', route('dashboard'));
//     $trail->push('category');
// });


Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(__('lang.leftbar.dashboard'), route('dashboard'));
});

// PROFILE BREADCRUMBS
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard', route('dashboard'));
    $trail->push(__('lang.commons.edit'));
});

// USERS BREADCRUMBS
Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard', route('dashboard'));
    $trail->push(__('lang.fields.user.plural'), route('user.index'));
});
Breadcrumbs::for('user.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.index', route('user.index'));
    $trail->push(__('lang.commons.add'));
});
Breadcrumbs::for('user.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('user.index', route('user.index'));
    $trail->push(__('lang.commons.edit'));
});

// CATEGORY BREADCRUMBS
Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard', route('dashboard'));
    $trail->push(__('lang.fields.category.plural'), route('category.index'));
});
Breadcrumbs::for('category.show', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category.index', route('category.index'));
    $name = Helper::mask($category->name);
    $trail->push($name, route('category.show', $category->slug));
});
Breadcrumbs::for('category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('category.index');
    $trail->push(__('lang.commons.add'));
});
Breadcrumbs::for('category.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category.show', $category);
    $trail->push(__('lang.commons.edit'));
});

// COURSE BREADCRUMBS
Breadcrumbs::for('course.index', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category.show', $category);
    $trail->push(__('lang.fields.course.plural'), route('category.show', $category->slug));
});
Breadcrumbs::for('course.create', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category.show', $category);
    $trail->push(__('lang.commons.add'));
});
Breadcrumbs::for('course.show', function (BreadcrumbTrail $trail, $category, $course) {
    $trail->parent('category.show', $category);
    $name = Helper::mask($course->title);
    $trail->push($name, route('category.course.show', [$category->slug, $course->slug]));
});

// TOPIC BREADCRUMBS
Breadcrumbs::for('topic.index', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('course.show', $course->category, $course);
    $trail->push(__('lang.fields.topic.plural'), route('category.course.show', [$course->category->slug, $course->slug]));
});
Breadcrumbs::for('topic.show', function (BreadcrumbTrail $trail, $course, $topic) {
    $trail->parent('course.show', $course->category, $course);
    $name = Helper::mask($topic->title);
    $trail->push($name, route('course.topic.show', [$course->slug, $topic->slug]));
});
Breadcrumbs::for('topic.create', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('course.show', $course->category, $course);
    $trail->push(__('lang.commons.add'));
});
Breadcrumbs::for('topic.edit', function (BreadcrumbTrail $trail, $course, $topic) {
    $trail->parent('topic.show', $course, $topic);
    $trail->push(__('lang.commons.edit'));
});

// ACTIVITY BREADCRUMBS
Breadcrumbs::for('activity.show', function (BreadcrumbTrail $trail, $topic, $activity) {
    $trail->parent('topic.show', $topic->course, $topic);
    $name = Helper::mask($activity->title);
    $trail->push($name);
});
Breadcrumbs::for('activity.create', function (BreadcrumbTrail $trail, $topic) {
    $trail->parent('topic.show', $topic->course, $topic);
    $trail->push(__('lang.commons.add'));
});
Breadcrumbs::for('activity.edit', function (BreadcrumbTrail $trail, $topic, $activity) {
    $trail->parent('activity.show', $topic, $activity);
    $trail->push(__('lang.commons.edit'));
});


// QUESTION BANK BREADCRUMBS
Breadcrumbs::for('question-bank.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard', route('dashboard'));
    $trail->push(__('lang.fields.question-bank.plural'), route('question-banks.index'));
});
Breadcrumbs::for('question-bank.show', function (BreadcrumbTrail $trail, $questionBank) {
    $trail->parent('question-bank.index');
    $trail->push($questionBank->name, route('question-banks.show', $questionBank->slug));
});

// QUESTION BREADCRUMBS
Breadcrumbs::for('questions.create', function (BreadcrumbTrail $trail, $questionBank) {
    $trail->parent('question-bank.show', $questionBank);
    $trail->push(__('lang.commons.add'));
});
Breadcrumbs::for('questions.edit', function (BreadcrumbTrail $trail, $questionBank, $quetion) {
    $trail->parent('question-bank.show', $questionBank);
    $trail->push(__('lang.commons.edit'));
});
