@extends('layouts.app')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>name</th>
        <th>Email</th>
        <th>image</th>
        <th>birth_name</th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
      <tr>
      <td>{{$post->id}}</td>
      <td>{{$post->name}}</td>
      <td>{{$post->email}}</td>
      <td><img width="100" height="100" src="{{$post->image}}" alt=""></td>
      <td>{{$post->birth_name}}</td>
     <td>
         <a class="btn btn-warning" href="{{route('posts.edit', $post->id)}}">Edit</a>
         <button type="button" class="btn btn-danger delete-post" data-id="{{ $post->id }}">Delete</button>
     </td>
    </tr>

      @endforeach
    </tbody>
  </table>
  <div class="d-flex justify-content-end">
  <a class="btn btn-primary" href=" {{$posts->nextPageUrl()}};">Next</a>
  </div>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', evt => {
        $('.delete-post').click(function (e) {
            if (confirm('Are you sure ???')) {
                $.ajax({
                    url: '/posts/' + $(this).data('id'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    success: function(result){
                        location.reload();
                    }
                });
            }
        });
    })
</script>
@endsection