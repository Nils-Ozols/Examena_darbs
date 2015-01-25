@extends('template')

@section('content')
	
	{{ Form::open(array('class' => 'form-signin')) }}
	    <h2 class="form-signin-heading">Please sign in</h2>
	    {{ Form::text('username', Input::get('username') or '', array('placeholder' => 'User', 'class' => 'form-control')) }}
	    {{ Form::text('email', Input::get('email') or '', array('placeholder' => 'E-mail', 'class' => 'form-control')) }}
	    {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
	    {{ Form::password('password_confirmation', array('placeholder' => 'Password confirmed', 'class' => 'form-control')) }}
	    {{ Form::submit('Register', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    {{ Form::close() }}

@stop
