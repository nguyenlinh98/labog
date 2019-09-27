@extends('layouts.app')
@section('content')
    <div class="tab">
        <div class="header_title">
            <h1><i class="fa fa-pencil-alt"></i>Sửa thông tin  thể loại</h1>
        </div>
        <hr width="100%" color="#dfe6e9">
        <div class="body-category">
            <form action="{{route('category/update',$category->id)}}" method="post">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Tên thể loại:</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái:</label>
                    <select class="form-control required col-md-2" name="status">
                        @if($category->status ==1)
                            <option value="1" selected="selected">Enable</option>
                            <option value="0">Disable</option>
                        @else
                            <option value="1">Enable</option>
                            <option value="0" selected="selected">Disable</option>
                        @endif

                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
