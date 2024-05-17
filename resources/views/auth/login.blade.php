@extends('layouts.app')

@section('content')
<br><br><br><br><br>
    <login-component csrf_token="{{ @csrf_token() }}"></login-component>
@endsection
