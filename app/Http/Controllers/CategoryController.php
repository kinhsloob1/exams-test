<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::view('categories', [
            'categories' => Category::query()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Response::view('category', [
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
            'name' => [
                'required',
                'string',
                'min:3',
                Rule::unique(Category::class, 'name')
            ]
        ]);

        $data = $request->only(['name']);
        $category = new Category($data);

        if ($category->save()) {
            return Response::json([
                'status' => 'ok',
                'data' => [
                    'id' => $category->id
                ]
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while creating category'
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return Response::view('category', [
            'category' => $category,
            'action' => 'view',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return Response::view('category', [
            'category' => $category,
            'action' => 'edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'string',
                'min:3',
                Rule::unique(Category::class, 'name')
            ]
        ]);

        $data = $request->only(['name']);
        foreach ($data as $key => $value) {
            if (isset($category->{$key})) $category->{$key} = $value;
        }

        if ($category->save()) {
            return Response::json([
                'status' => 'ok',
                'message' => 'category updated succesfully'
            ]);
        }

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while updating category'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if ($category->delete()) {
            return Response::json([
                'status' => 'ok',
                'message' => 'category destroyed succesfully'
            ]);
        }


        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return Response::json([
            'status' => 'error',
            'message' => 'an error occurred while destroying category'
        ], 400);
    }
}
