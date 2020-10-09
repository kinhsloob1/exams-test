@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="categories">
  @forelse ($categories as $category)
  <div class="category" data-type="category" data-id="{{$category->id}}">
    <span class="name">{{$category->name}}</span>
    <span class="actions">
      <button class="edit action">Edit</button>
      <button class="delete action">Delete</button>
    </span>
  </div>
  @empty
  <span>No category is available</span>
  @endforelse
</div>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ mix('/css/categories.css') }}">
@endpush

@push('scripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endpush