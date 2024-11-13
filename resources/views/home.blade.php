@extends('layouts.app')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
        @include('components.page.home.admin')
    @elseif (auth()->user()->role == 'student')
        @include('components.page.home.student')
    @endif
@endsection
