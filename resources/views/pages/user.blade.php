@extends('layouts.app')

@section('content')
    <div class="user-container">
        @include('pages.user-content')
        @include('pages.user-side')
    </div>
@endsection
