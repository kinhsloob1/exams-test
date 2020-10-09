<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isEmpty;

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
            'questions' => Question::query()->with(['options', 'categories'])->get()
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
            'action' => 'create',
            'categories' => Category::query()->get()
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
            ],
            'categories' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    if (isEmpty($value)) return $fail('Ooops... at lease a category should be selected');

                    foreach ($value as $category) {
                        if (!Category::find($category)) return $fail('Ooops... invalid category selected');
                    }
                },
            ]
        ]);

        $data = $request->only(['value', 'categories']);
        $categories = Arr::pull($data, 'categories', null);
        $question = new Question($data);

        if ($question->save()) {
            if (is_array($categories)) {
                $question->categories()->sync($categories);
            }

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
            'action' => 'edit',
            'categories' => Category::query()->get()
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
                'string',
                'min:3'
            ],
            'categories' => [
                'array',
                function ($attribute, $value, $fail) {
                    return Response::json($value, 400);
                    if (isEmpty($value)) return $fail('Ooops... at lease a category should be selected');

                    foreach ($value as $category) {
                        if (!Category::find($category)) return $fail('Ooops... invalid category selected');
                    }
                },
            ]
        ]);

        $data = $request->only(['value', 'categories']);
        foreach ($data as $key => $value) {
            if ($key === 'categories') {
                if (is_array($value)) $question->categories()->sync($value);
                continue;
            }
            if (isset($question->{$key})) $question->{$key} = $value;
        }

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
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if ($question->delete() && $question->options()->delete()) {
            return Response::json([
                'status' => 'ok',
                'message' => 'question destroyed succesfully'
            ]);
        }

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while destroying question'
        ], 400);
    }
}
