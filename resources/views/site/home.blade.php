@extends('layouts.app')

@section('content')
    @guest
        <guest-component></guest-component>
    @else
        <loged-component></loged-component>
    @endguest
@endsection
