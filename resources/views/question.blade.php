@extends('layouts.app')

@section('title', 'QUestion | {{$action}}')

@section('content')
@if($action === 'create' || $action === 'edit')
<form class="form" data-action="{{$action}}" @if($action==='edit' ) data-save-url="{{route('questions.update', ['question' => $question->id])}}" data-save-method="patch" @else data-save-url="{{route('questions.store')}}" data-save-method="post" @endif>
  <h3 class="title">{{$action === 'create' ? 'New' : 'Update'}} Question Form</h3>
  <div class="input">
    <label>Please input question</label>
    <input type="text" name="value" value="{{$action === 'edit' ? $question->value : ''}}">
  </div>
  <div class="input">
    <label>Please select categories</label>
    <select name="categories[]" multiple>
      @foreach($categories as $category)
      <option value="{{$category->id}}" @if($action==='edit' && $question->categories->contains($category->id)) selected @endif>{{$category->name}}</option>
      @endforeach
      <option value="" @if(($action==='edit' && $question->categories->isEmpty()) || $action === 'create') selected @endif disabled>none</option>
    </select>
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