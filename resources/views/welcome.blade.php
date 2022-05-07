@extends('layouts.app')

@section('content')
<welcome-component :user_log="{{ Auth::check() ? 1 : 0 }}"
    :is_student="{{ Auth::check() && Auth::user()->user_type_id ==  1 ? 1 : 0}} "></welcome-component>
@endsection