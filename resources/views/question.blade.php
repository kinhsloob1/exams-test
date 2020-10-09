@extends('layouts.app')

@section('title', 'QUestion | {{$action}}')

@section('content')
@if($action === 'create' || $action === 'edit')
<form class="form" data-route="questions" data-action="{{$action}}" data-id="{{$action === 'edit' ? $question->id : 0}}">
  <h3 class="title">{{$action === 'create' ? 'New' : 'Update'}} Question Form</h3>
  <div class="input">
    <label>Please input question</label>
    <input type="text" name="value" value="{{$action === 'edit' ? $question->value : ''}}">
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