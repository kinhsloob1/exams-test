@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="title root">All Categories</div>
<div class="categories">
  @forelse ($categories as $category)
  <div class="category root" data-delete-url="{{route('categories.destroy', ['category' => $category->id])}}">
    <div class="no">
      {{$loop->index + 1}}
    </div>
    <span class="name">{{$category->name}}</span>
    <span class="actions">
      <a class="edit action" href="{{route('categories.edit', ['category' => $category->id])}}">Edit</a>
      <button class="delete action">Delete</button>
    </span>
  </div>
  @empty
  <span>No category is available <a href="{{route('categories.create')}}">click here to create one at {{route('categories.create')}}</a></span>
  @endforelse
</div>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ mix('/css/categories.css') }}">
@endpush

@push('scripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endpush