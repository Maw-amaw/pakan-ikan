@extends('admin.index')
@section('content')

<h2>Edit Data</h2>

<form method="POST" action="{{ route('admin.update', $alat->id) }}">
    @csrf
    @method('PUT')

    <label for="ssid">SSID:</label>
    <input type="text" name="ssid" value="{{ $alat->ssid }}" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" value="{{ $alat->password }}" required>
    <br>

    <label for="alat">Nama Alat:</label>
    <input type="text" name="alat" value="{{ $alat->alat }}" required>
    <br>

    <label for="status">status:</label>
    <input type="text" name="status" value="{{ $status->status }}" required>
    <br>

    <button type="submit">Update Data</button>
</form>
@endsection
