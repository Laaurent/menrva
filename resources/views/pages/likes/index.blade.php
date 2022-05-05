@extends('layouts.app')

@section('content'){{ json_encode(Storage::disk('public')->exists('avatars/avatar.png')) }}<likes-component
    :user_id="{{ Auth::id() }}">
</likes-component>
@endsection