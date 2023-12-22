@extends('admin.index')
@section('content')


<div class="row mt-5">
    <div class="div">
        <h1>Welcome, {{ session('username') }}</h1>
    </div>
</div>

@endsection
