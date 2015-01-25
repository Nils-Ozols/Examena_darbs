@extends('template')

@section('content')
	
	{{ Form::open(array('class' => 'form-signin')) }}
	    <h2 class="form-signin-heading">Please sign in</h2>
	    {{ Form::text('username', Input::get('username') or '', array('placeholder' => 'User', 'class' => 'form-control')) }}
	    {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
	    <div class="checkbox">
	      <label>
	        {{ Form::checkbox('remember', false) }} Remember me
	      </label>
	    </div>
	    {{ Form::submit('Login', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    {{ Form::close() }}

@stop
