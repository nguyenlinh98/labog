@extends('layouts.app')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
    <style>
        .btn {
            margin-bottom: 10px ;
        }
    </style>
@endsection
@section('content')
    <!-- Button trigger modal -->
    <div class=" row ">
        <div class="col-md-7">
            <table id="example" class="display table-bordered table-hover text-center" style="width:100%" >
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="list">
                @foreach($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td><img src="{{Storage::url($tag->image)}}" alt="" style="width: 100px"></td>
                    <td>@if($tag->status)
                            <button class="btn-success">Active</button>
                        @else
                            <button class="btn-danger">Inactive</button>
                            @endif
                    </td>
                    <td>
                        <button  class="btn btn-info "><i class="fa fa-eye"></i></button>
                        <button  class="btn btn-warning"><i class="fa fa-edit"></i></button>
                        <button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Avatar</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-5">
            <form action="" method="post">
                @csrf
                <div class="title">
                    <h1>Thêm tag</h1>
                </div>
                <div class="form-group">
                    <label for="name"> Name: </label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="active"> Status: </label>
                    <select name="status" id="" class="form-control">
                        <option value="" disabled="disabled">--- Select  active tag ---</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Images: </label>
                    <input type="file" name="image" class="form-control">
                </div>
                 <div class="form-group">
                     <button class="btn btn-primary " id="saveData">Save </button>
                     <button class="btn btn-warning " onclick="updateData()">Update </button>
                 </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();

            $('#example tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
            } );
            $('#saveData').click(function(event){
                event.preventDefault();
                var data = $ ('input').serialize();
                $. ajax({
                    type : "post",
                    url : "{{route('tag.store')}}",
                    data : data,
                    success: function (data) {
                        $('#list').html('');
                        $('#list').append(data);
                       console.log(data);
                    }

                });

            });
        } );
    </script>
    @endsection
