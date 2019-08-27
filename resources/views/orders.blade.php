@extends('layouts.app')

@section('content')
    <div class="container">
        <orders :user="{{ auth()->user() }}"></orders>
    </div>
@endsection
