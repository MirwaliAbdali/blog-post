@extends('backend.layout.master')
@section('content')
                <div class="container-fluid">
                    <div class="card">
                      <h5 class="card-header">
                        Trashed Posts
                        <a href="{{route('post.create')}}" class="btn btn-success float-right">Add Post</a>
                        <br><br>
                        <a href="{{route('post.index')}}" class="btn btn-danger float-right">All Posts</a>
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
                            @foreach ($posts as $index=>$post)
                            <tr>
                              <td>{{($posts->currentPage()*15)-15 + $index+1}}</td>
                              <td>{{$post->title}}</td>
                              <td>{{$post->sub_title}}</td>
                              {{-- <td>{{$post->description}}</td> --}}
                              {{-- <td>{{$post->slug}}</td> --}}
                              <td>
                                <a href="{{route('post.force-delete',['id'=>$post->id])}}" class="fa fa-trash mr-4 delete"></a>--- 
                                <a href="{{route('post.restore',['id'=>$post->id])}}"><img src="{{asset('backend/img/Restart.ico')}}" style="width:24px"></a></td>
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

{{-- <script>
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
            var url = '/force-delete/' + id; // Ensure this URL matches your route

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'DELETE',
                success: function(data) {
                    location.reload(); // Reload page on success
                },
                error: function(xhr, status, error) {
                    // Handle error case
                    alert('Error: ' + error);
                }
            });
        }
    });
});


  //////////////////////////
</script> --}}

<script>
  const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

@if(Session::has('success'))
Toast.fire({
  icon: "success",
  title: "{{Session::get('success')}}"
});
@endif

</script>


@endsection