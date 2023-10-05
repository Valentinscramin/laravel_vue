@extends('layouts.app')

@section('content')
    @guest
        <guest-component></guest-component>
    @endguest
@endsection
