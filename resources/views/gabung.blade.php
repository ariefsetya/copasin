@extends('app')

@section('header')
	<title>Gabung &raquo; Copas Aja Disini</title>
@endsection

@section('content')
<h1>Gabung</h1>
<form method="POST" action="{{url('auth/register')}}">
<table>
	<tr>
		<td>Nama</td>
		<td><input required type="text" name="name">
		<input required type="hidden" name="_token" value="{{csrf_token()}}"></td>
	</tr>
	<tr>
		<td>E-Mail</td>
		<td><input required type="email" name="email"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password" required></td>
	</tr>
	<tr>
		<td></td>
		<td><button type="submit">Gabung</button></td>
	</tr>
</table>
</form>
@endsection