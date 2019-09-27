@extends('layouts.app')
@section('content')
    <div class="cart" style="padding: 20px">
{{--        <div class="img_header"--}}
{{--             style="background-image:url({{ URL::asset('image/img2.jpg')}}); background-size: cover; width: 100%; height: 300px">--}}
{{--        </div>--}}

        <div class="card-header sy">
            <h1>Thêm bài viết</h1>
        </div>
        {{--      show error validate quickstart--}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="cart-body">
            <form action="{{route('store')}}" method="post" class="form_add">
                @csrf
                <div class="form-group  float-right py-2">
                    <select name="publish" id="" class="form-control">
                        <option value="1">Công khai</option>
                        <option value="0">Chế độ mình tôi</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="title">Tiêu đề:</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="fom-group">
                    <label for="category_id">Thể loại:</label>
                    <select name="category_id" class="form-control">
                        <option value="">----Option-----</option>
                        @foreach($categories as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="Content">Nội dung:</label>
                    <textarea name="content" cols="50" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Thêm bài viết" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>

@endsection
