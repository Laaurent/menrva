@extends('layouts.app')

@section('content')
<welcome-component :user_log="{{ Auth::check() ? 1 : 0 }}"></welcome-component>
@endsection