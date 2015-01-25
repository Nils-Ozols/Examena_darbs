@extends('template')

@section('content')
	
	{{ Form::open(array('class' => 'form-signin')) }}
	    <h2 class="form-signin-heading">Manage Gallery</h2>
	    {{ Form::text('name', $gallery->name, array('placeholder' => 'Gallery name', 'class' => 'form-control')) }}
	    {{ Form::textarea('description', $gallery->description, array('placeholder' => 'Description', 'class' => 'form-control', 'id' => 'ckeditor')) }}
	    <script>
	    	CKEDITOR.replace('ckeditor');
	    </script>
	    <div class="checkbox">
	      <label>
	        {{ Form::checkbox('public', false) }} Public
	      </label>
	    </div>
	    <input type="file" name="images" multiple/>
	    <table class="table table-bordered">
	    	<thead>
		    	<tr>
		    		<td>Image</td>
		    		<td>Description</td>
		    		<td>Delete</td>
		    	</tr>
	    	</thead>
	    	<tbody>
	    		@foreach($images->get() as $image)
		    		<tr>
		    			<td><a target="_blank" href="{{$image->image}}">{{$image->image}}</a><input type="hidden" name="image[]" value="{{$image->image}}"/></td>
		    			<td><textarea name="imgdescr[]">{{$image->description}}</textarea></td>
		    			<td><a class="btn btn-danger deleteimage">Delete</a></td>
		    		</tr>
	    		@endforeach
    		</tbody>
	    </table>
	    <div class="popup hide">
	    	<div class="content">
	    	</div>
	    </div>
	    <script>
	    	$('.deleteimage').on('click',function(e){
	    		e.preventDefaults();
	    		$(e.target).parent().parent().remove();
	    	});
	    	$('[name=images]').change( function (e) {
	    		e.preventDefault();
                var form_data = new FormData();
                for (i in $(this).prop('files')) {
                    var file_data = $(this).prop('files')[i];
                    form_data.append(i, file_data);
                }
                form_data.append('_token',$('input[name="_token"').val());
                $.ajax({
                    url: '{{ URL::to("/gallery/addimages") }}', 
                    dataType: 'text', 
                    headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data:  form_data,
                    type: 'post', 
                    success: function(data){
                        data = $.parseJSON(data);
                        for(i in data) {
                            $('table').append('<tr><td><a target="_blank" href="'+data[i]+'">'+data[i]+'</a><input type="hidden" name="image[]" value="'+data[i]+'"/></td><td><textarea name="imgdescr[]"></textarea></td><td><a class="btn btn-danger delete">Delete</a></td></tr>');
						}
                    }
                 });
	    	});
	    </script>
	    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}<a href="{{URL::to('user')}}" class="btn btn-danger">Cancel</a>
    {{ Form::close() }}

@stop
