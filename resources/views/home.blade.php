@extends('layouts.app')

@section('title', 'Question | {{$action}}')

@section('content')
<div class="title root">Welcome to your exams portal</div>
<h4 class="w-100">Follow the following inks to get started</h4>
<ul class="instructions">
    <li>To create a new question, please access <a href="{{route('questions.create')}}">{{route('questions.create')}}</a> </li>
    <br />
    <li>To view questions, please access <a href="{{route('questions.index')}}">{{route('questions.index')}}</a> </li>
    <br />
    <li>To create a new category, please access <a href="{{route('categories.create')}}">{{route('categories.create')}}</a> </li>
    <br />
    <li>To create view categories, please access <a href="{{route('categories.index')}}">{{route('categories.index')}}</a> </li>
</ul>
<h4 class="w-100 mt">Enjoy!!!</h4>
@endsection


@push('styles')
<link rel="stylesheet" href="{{ mix('/css/index.css') }}">
@endpush

@push('scripts')
<script src="{{ mix('/js/app.js') }}"></script>
@endpush