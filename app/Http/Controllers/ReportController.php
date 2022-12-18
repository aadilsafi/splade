<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(3);
        $quiz = Quiz::find(1);
        

        dd($user->quizzes);
        // $attempts = [
        //     [
        //         'user_id' => $user->id,
        //         'question_id' => 1,
        //         'quiz_id'     => 1,
        //         'marks'       => 1,
        //     ],
        //     [
        //         'user_id' => $user->id,
        //         'question_id' => 2,
        //         'quiz_id'     => 1,
        //         'marks'       => 1,
        //     ],
        //     [
        //         'user_id' => $user->id,
        //         'question_id' => 3,
        //         'quiz_id'     => 1,
        //         'marks'       => 1,
        //     ],
        //     [
        //         'user_id' => $user->id,
        //         'question_id' => 4,
        //         'quiz_id'     => 1,
        //         'marks'       => 1,
        //     ],
        //     [
        //         'user_id' => $user->id,
        //         'question_id' => 5,
        //         'quiz_id'     => 1,
        //         'marks'       => 1,
        //     ],
        //     ];
        //     Attempt::insert($attempts);
        // dd($user->quiz);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
