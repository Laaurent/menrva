@extends('layouts.app')

@section('content')
<home-component pattern="{{ Request::has('pattern') ? Request::query('pattern') : 'null' }}"
    place="{{ Request::has('place') ?  Request::query('place') : 'null' }}" :user_log="{{ Auth::check() ? 1 : 0 }}"
    :is_student="{{ Auth::user()->user_type_id ==  1 }} ">
</home-component>
@endsection