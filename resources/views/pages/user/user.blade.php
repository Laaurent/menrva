@extends('layouts.app')

@section('content')
<div class="user-container flex flex-col xl:flex-row">
    @include('pages.user.user-content')
    @include('pages.user.user-side')
</div>
@endsection