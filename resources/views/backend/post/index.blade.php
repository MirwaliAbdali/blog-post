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
                              <th>Description</th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr>
                              <td>khan</td>
                              <td>khan</td>
                              <td>khan</td>
                              <td>khan</td>
                            </tr>

                            
                            <tr>
                              <td>khan</td>
                              <td>khan</td>
                              <td>khan</td>
                              <td>khan</td>
                            </tr>
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
@endsection