@extends('layouts.app')

@section('title', 'Questions')

@section('content')
<div class="title root">All Questions</div>
<div class="questions">
  @forelse ($questions as $question)
  <div class="question root" data-delete-url="{{route('questions.destroy', ['question' => $question->id])}}">
    <div class="no">
      {{$loop->index + 1}}
    </div>
    <div class="value">
      {{$question->value}}
    </div>
    <div class="categories">
      <span class="category">Categorized as:</span>
      @foreach($question->categories as $category)
      <span class="category">{{$category->name}}{{!$loop->last ? ',' : ''}}</span>
      @endforeach
    </div>
    <div class="options">
      @forelse ($question->options as $option)
      <div class="option root" data-edit-url="{{route('options.edit', ['option' => $option->id])}}" data-delete-url="{{route('options.destroy', ['option' => $option->id])}}">
        <span class="value">{{$option->value}}</span>
        <span class="actions">
          <a class="edit action" href="{{route('options.edit', ['option' => $option->id])}}">Edit</a>
          <button class="delete action">Delete</button>
        </span>
      </div>
      @empty
      <span>No option is available</span>
      @endforelse
    </div>
    <div class="actions">
      <a class="edit action" href="{{route('questions.edit', ['question' => $question->id])}}">Edit</a>
      <a class="add-option action" href="{{route('questions.options.create', ['question' => $question->id])}}">Add option</a>
      <button class="delete action">Delete</button>
    </div>
  </div>
  @empty
  <span>No question is available <a href="{{route('questions.create')}}">click here to create one at {{route('questions.create')}}</a></span>
  @endforelse
</div>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ mix('/css/questions.css') }}">
@endpush