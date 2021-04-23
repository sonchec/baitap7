@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
	    
	    <div class="col-md-8 col-md-offset-2">
	        
    		<h1>Edit post</h1>
    		
    		<form action="{{ route('posts.update',$post->id) }}" method="POST">
                @csrf
                @method('PUT')
    		    
    		    <div class="form-group has-error">
    		        <label for="slug">name <span class="require">*</span> <small>(Dien ten.)</small></label>
    		        <input type="text" class="form-control" name="slug" value="{{$post->name}}"/>
    		        <span class="help-block">Field not entered!</span>
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="title">Email<span class="require">*</span></label>
    		        <input type="text" class="form-control" name="title" value="{{$post->Email}}"/>
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="content">content</label>
    		        <textarea rows="5" class="form-control" name="content">{{$post->content}} </textarea>
    		    </div>
    		    
				<div class="form-group">
					<label for="$categories">Choose a car:</label>
					<select name="$categories[]" id="$categoriess" multiple>
					@foreach ($categories as $category)
					  <option value="{{$category->id}}" selected="{{$post->categories->contains($category->id) ? 'selected' : ''}}">
						{{$category->name}}
					</option>
					  @endforeach
					</select>
					
    		    </div>

    		    <div class="form-group">
    		        <p><span class="require">*</span> - required fields</p>
    		    </div>
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">Edit</button>
    		    </div>
    		    
    		</form>
		</div>
		
	</div>
</div>
@endsection