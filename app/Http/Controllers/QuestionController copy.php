<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::view('questions', [
            'questions' => Question::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Response::view('question', [
            'action' => 'create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                'string',
                'min:3'
            ]
        ]);

        $data = $request->only(['value']);
        $question = new Question($data);
        if ($question->save()) {
            return Response::json([
                'status' => 'ok',
                'data' => [
                    'id' => $question->id
                ]
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while creating question'
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return Response::view('question', [
            'question' => $question,
            'action' => 'view',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return Response::view('question', [
            'question' => $question,
            'action' => 'edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'value' => [
                'required',
                'string',
                'min:3'
            ]
        ]);

        $data = $request->only(['value']);
        $question->value = Arr::get($data, 'value');

        if ($question->save()) {
            return Response::json([
                'status' => 'ok',
                'message' => 'question updated succesfully'
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while updating question'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ($question->delete()) {
            return Response::json([
                'status' => 'ok',
                'message' => 'question destroyed succesfully'
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while destroying question'
        ], 400);
    }
}
