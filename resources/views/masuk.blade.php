@extends('app')

@section('header')
	<title>Masuk &raquo; Copas Aja Disini</title>
@endsection

@section('content')
<h1>Masuk</h1>
<form method="POST" action="<?php echo url("vauth/login");?>">
<table>
	<tr>
		<td>E-Mail</td>
		<td><input required type="email" name="email">
		<input required type="hidden" name="_token" value="{{csrf_token()}}"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password" required></td>
	</tr>
	<tr>
		<td></td>
		<td><button type="submit">Masuk</button></td>
	</tr>
</table>
</form>
@endsection