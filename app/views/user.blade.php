@extends('template')

@section('content')
	<div class="panel panel-default">
	    <div class="panel-body">
			Username: {{{ $user->username }}}
			<br>
			E-mail: {{{ $user->email }}}
			<br>
			Galleries: {{count($galleries)}}
			<br>
			<a href="{{ URL::to('gallery/add') }}" class="btn btn-success">Add gallery</a>
	    </div>
	</div>
    <div class="row">
    	@foreach($galleries as $gallery)
		    <div class="col-xs-6 col-lg-4">
		        <div class="thumbnail">
			        <img src="{{$gallery->thumb()}}" alt="...">
			        <div class="caption">
				        <h3>{{$gallery->name}}</h3>
				        {{$gallery->description}}
				        <p>
				        	<a href="{{URL::to('gallery/view/'.$gallery->id)}}" class="btn btn-primary" role="button">View</a>
				        	@if($gallery->user_id == Auth::id() || Auth::user()->isAdmin())
				        		<a href="{{URL::to('gallery/edit/'.$gallery->id)}}" class="btn btn-primary" role="button">Edit</a>
				        	@endif
				        </p>
			        </div>
		        </div>
		    </div><!--/.col-xs-6.col-lg-4-->
	    @endforeach
    </div><!--/row-->

@stop
