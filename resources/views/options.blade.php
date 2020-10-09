@extends('layouts.app')

@section('title', 'Options for Question {{$question->value}}')

@section('content')
<div class="options">
  @forelse ($options as $option)
  <div class="option root" data-route="options" data-id="{{$option->id}}">
    <span class="value">
      <span class="title">Options</span>
      {{$option->value}}
    </span>
    <span class="actions">
      <button class="edit action">Edit</button>
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