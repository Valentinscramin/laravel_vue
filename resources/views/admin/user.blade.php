@extends('layouts.app')

@section('content')
    <user-component recived_props="{{ json_encode($users) }}"></user-component>
@endsection
