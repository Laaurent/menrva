@extends('layouts.app')

@section('content')
<likes-component :user_id="{{ Auth::id() }}"></likes-component>
@endsection