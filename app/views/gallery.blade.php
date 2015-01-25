@extends('template')

@section('content')
	<div class="panel panel-default">
	    <div class="panel-body">
	    	<h3>{{$gallery->name}}</h3>
			{{$gallery->description}}
	    </div>
	</div>
	
    <div class="row">
    	@foreach($images as $image)
		    <div class="col-xs-6 col-lg-4">
		        <div class="thumbnail">
			        <img src="{{$image->image}}" alt="...">
			        <div class="caption">
				        {{$image->description}}
			        </div>
		        </div>
		    </div><!--/.col-xs-6.col-lg-4-->
	    @endforeach
    </div><!--/row-->
    <div class="panel panel-default">
    	<div class="panel-body">
	    	<h3>Comments</h3>
	    	@if(Auth::check())
		    	{{Form::open()}}
				{{Form::textarea('comment','',array('class'=>'form-control'))}}
				{{Form::submit('Add Comment', array('class'=>'btn btn-default'))}}
				{{Form::close()}}
			@endif
			@foreach($comments as $comment)
			<div class="panel panel-default">
			    <div class="panel-body">
			    	<h3><a href="{{URL::to('user/index/'.$comment->user_id)}}">{{$comment->user()->first()->username}}</a></h3>
					{{{$comment->comment}}}
			    </div>
			</div>
			@endforeach
	    </div>
    </div>

@stop
