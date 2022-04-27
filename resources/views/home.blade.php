@extends('layouts.app')

@section('content')
<home-component pattern="{{ Request::has('pattern') ? Request::query('pattern') : 'null' }}"
    place="{{ Request::has('place') ?  Request::query('place') : 'null' }}"></home-component>
@endsection