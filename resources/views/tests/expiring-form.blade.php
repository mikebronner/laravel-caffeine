@extends('layouts.app')

@section('content')
    <form method="post">
        {{ csrf_field() }}
        <input type="hidden" name="success" value="true">
        <input type="submit" value="Test Form Submit">
    </form>
@endsection
