@extends('layouts.app')

@section('title', 'QUestion | {{$action}}')

@section('content')
@if($action === 'create' || $action === 'edit')
<form class="form" data-route="options" data-action="{{$action}}" data-id="{{$action === 'edit' ? $option->id : 0}}">
  <h3 class="title">{{$action === 'create' ? 'New' : 'Update'}} Option Form</h3>
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