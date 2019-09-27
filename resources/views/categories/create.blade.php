@extends('layouts.app')
@section('content')
    <div class="cart" style="padding: 20px">
        <div class="img_header"
             style="background-image:url({{ URL::asset('image/img12.png')}}); background-size: cover; width: 100%; height: 300px">
        </div>

        <div class="card-header">
            <h1>Thêm thể loại mới</h1>
        </div>
{{--              show error validate quickstart--}}
        <div class="cart-body">
            <form action="{{route('categories.store')}}" method="post" class="form_add">
                @csrf
                <div class="form-group">
                    <label for="name">Tên thể loại:</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="status">Trạng thái:</label>
                    <select name="status" id="" class="form-control col-md-2">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>

@endsection
