@extends('layouts.app')

@section('title', 'Questions')

@section('content')
<div class="questions">
  @forelse ($questions as $question)
  <div class="question root" data-route="questions" data-id="{{$question->id}}">
    <div class="value">

      <span class="title">Question</span><br />
      {{$question->value}}
    </div>
    <div class="categories">

    </div>
    <div class="options">
      <span class="title">Options</span>

      @forelse ($question->options as $option)
      <div class="option root" data-route="options" data-id="{{$option->id}}">
        <span class="value">{{$option->value}}</span>
        <span class="actions">
          <button class="edit action">Edit</button>
          <button class="delete action">Delete</button>
        </span>
      </div>
      @empty
      <span>No option is available</span>
      @endforelse
    </div>
    <div class="actions">
      <button class="edit action">Edit</button>
      <button class="delete action">Delete</button>
    </div>
  </div>
  @empty
  <span>No question is available</span>
  @endforelse
</div>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ mix('/css/questions.css') }}">
@endpush