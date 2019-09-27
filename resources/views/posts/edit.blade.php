@extends('layouts.app')
<style>
    #category_id{
        float: right;
    }
</style>
@section('content')

    <div class="cart">
        <div class="cart-title">
            <h1>Sửa thông tin bài viết</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="cart-body">
            <form action="{{route('update',$post->id)}}" method="post">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="title"> Tiêu đề:</label>
                    <input type="text" name="title" value="{{$post->title}}" class="form-control">
                </div>
                <div class="form-group form-inline">
                    <label for="publish">Xuất bản:</label>
                    <select class="form-control required col-md-2" name="publish">
                        @if($post->publish ==1)
                            <option value="1" selected="selected">Công khai</option>
                            <option value="0">Chỉ mình tôi</option>
                        @else
                            <option value="1">Công khai</option>
                            <option value="0" selected="selected">Chỉ mình tôi</option>
                        @endif

                    </select>
                    <label for="status" id="category_id"> Trạng thái:</label>
                    <select class="form-control required col-md-2" name="status">
                        @if($post->status ==1)
                            <option value="1" selected="selected">Enable</option>
                            <option value="0">Disable</option>
                        @else
                            <option value="1">Enable</option>
                            <option value="0" selected="selected">Disable</option>
                        @endif

                    </select>
                </div>
                <div class="form-group">
                    <label for="category_id">Thể loại:</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content"> Nội dung:</label>
                    <textarea name="content" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection
