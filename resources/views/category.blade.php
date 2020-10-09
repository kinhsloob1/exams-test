@extends('layouts.app')

@section('title', 'Question | {{$action}}')

@section('content')
@if($action === 'create' || $action === 'edit')
<form class="form" data-action="{{$action}}" @if($action==='edit' ) data-save-url="{{route('categories.update', ['category' => $category->id])}}" data-save-method="patch" @else data-save-url="{{route('categories.store')}}" data-save-method="post" @endif>
  <h3 class="title">{{$action === 'create' ? 'New' : 'Update'}} Category</h3>
  <div class="input">
    <label>Please input name</label>
    <input type="text" name="name" value="{{$action === 'edit' ? $category->name : ''}}">
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