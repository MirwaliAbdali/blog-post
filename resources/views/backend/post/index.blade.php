@extends('backend.layout.master')
@section('content')
                <div class="container-fluid">
                    <div class="card">
                      <h5 class="card-header">
                        Posts
                        <a href="{{route('post.create')}}" class="btn btn-success float-right">Add Post</a>
                      </h5>

                      <div class="card-body">
                        <table class="table table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th>No</th>
                              <th>Title</th>
                              <th>Sub_Title</th>
                              <th>Action</th>
                              {{-- <th>Description</th> --}}
                              {{-- <th>Slug</th> --}}
                            </tr>
                          </thead>
                          
                          <tbody>
                            @foreach ($posts as $post)
                            <tr>
                              <td>{{$post->id}}</td>
                              <td>{{$post->title}}</td>
                              <td>{{$post->sub_title}}</td>
                              {{-- <td>{{$post->description}}</td> --}}
                              {{-- <td>{{$post->slug}}</td> --}}
                              <td>
                                <a href="#" id="{{$post->id}}" class="fa fa-trash mr-4 delete"></a> 
                                <a href="{{route('post.edit',['post'=>$post->id])}}" class="fa fa-edit"></a></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{$posts->links('pagination::bootstrap-5')}}
                      </div>

                    </div>

                  </div>
@endsection

@section('script')

<script>
  $('.delete').click(function(){
        Swal.fire({
        title: "Are you sure to delete?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {

            var id = $(this).attr('id');
            var url = 'post/'+id;

                   $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url: url,
                      type: 'DELETE',
                      datatype: 'json',
                      data: {
                          '_method': 'DELETE'
                      },
                      success: function(data) {
                        location.reload();
                      },
                      error: function(xhr, status, error) {
                          // Handle error case
                          alert('Error: ' + error);
                      }
                  });
                   
        }
      });
  })
</script>

@endsection