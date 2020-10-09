@extends('layouts.app')

@section('title', 'Options for Question {{$question->value}}')

@section('content')
<div class="title root">All Options for Question "{{$question->value}}"</div>
<div class="options">
  @forelse ($question->options as $option)
  <div class="option root" data-delete-url="{{route('options.destroy', ['option' => $option->id])}}">
    <span class="no">{{$loop->index + 1}}</span>
    <span class="value">
      <span class="title">Options</span>
      {{$option->value}}
    </span>
    <span class="actions">
      <a class="edit action" href="{{route('options.edit', ['option' => $option->id])}}">Edit</a>
      <button class="delete action">Delete</button>
    </span>
  </div>
  @empty
  <span>No option is available</span>
  @endforelse
</div>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ mix('/css/options.css') }}">
@endpush