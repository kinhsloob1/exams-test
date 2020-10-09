@extends('layouts.app')

@section('title', 'Question | {{$action}}')

@section('content')
@if($action === 'create' || $action === 'edit')
<form class="form" data-action="{{$action}}" @if($action==='edit' ) data-save-url="{{route('options.update', ['option' => $option->id])}}" data-save-method="patch" @else data-save-url="{{route('questions.options.store', ['question' => $question->id])}}" data-save-method="post" @endif>
  <h3 class="title">{{$action === 'create' ? 'New' : 'Update'}} Question Option Form</h3>
  <div class="question">
    {{$question->value}}
  </div>
  <div class="input">
    <label>Please input option</label>
    <input type="text" name="value" value="{{$action === 'edit' ? $option->value : ''}}">
  </div>
  <div class="input">
    <label>Please input option Score</label>
    <input type="text" name="score" value="{{$action === 'edit' ? $option->score : 0}}">
  </div>
  <button class="submit">save</button>
</form>
@elseif($action === 'view')

@endif
@endsection


@push('styles')
<link rel="stylesheet" href="{{ mix('/css/form.css') }}">
@endpush

@push('scripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endpush