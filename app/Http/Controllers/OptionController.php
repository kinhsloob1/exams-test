<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::view('options', [
            'questions' => Option::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Response::view('option', [
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
            ],
            'question_id' => [
                'required',
                Rule::exists(Question::class, 'id')
            ]
        ]);

        $data = $request->only(['value']);
        $option = new Option($data);
        $isSaved = Question::find(Arr::get($data, 'question_id'))->save($option);
        if ($isSaved) {
            return Response::json([
                'status' => 'ok',
                'data' => [
                    'id' => $option->id
                ]
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while creating option'
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return Response::view('option', [
            'option' => $option,
            'action' => 'view',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        return Response::view('option', [
            'option' => $option,
            'action' => 'edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'value' => [
                'required',
                'string',
                'min:3'
            ]
        ]);

        $data = $request->only(['value']);
        $option->value = Arr::get($data, 'value');

        if ($option->save()) {
            return Response::json([
                'status' => 'ok',
                'message' => 'option updated succesfully'
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while updating option'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        if ($option->delete()) {
            return Response::json([
                'status' => 'ok',
                'message' => 'option destroyed succesfully'
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while destroying option'
        ], 400);
    }
}
