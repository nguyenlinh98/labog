@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="edit_form">
        <div class="title">
            <h1>Sửa thông tin tài khoản</h1>
        </div>
        <hr>
        <div class="main_content">
            <form action="{{route('users.update',['id' => $user->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group form-inline">
                    <label for="name" class="col-md-2">Username:</label>
                    <input type="text" name ="name" value="{{$user->name}}" class="form-control col-md-10">
                    @if( $errors->has('name') )
                        <span class="invalidated-feedback">
                                    {{  $errors->first('name') }}
                                </span>
                    @endif
                </div>
                <div class="form-group form-inline">
                    <label for="email" class="col-md-2">Địa chỉ mail:</label>
                    <input type="email" name = "email"class="form-control col-md-10" value="{{$user->email}}">
                    @if( $errors->has('name') )
                        <span class="invalidated-feedback">
                                    {{  $errors->first('email') }}
                                </span>
                    @endif
                </div>
                <div class="form-group form-inline">
                    <label for="images" class="col-md-2"> Hình ảnh: </label>
                    <input type="file" class="form-control col-md-10" value="{{$user->images}} " name="images">
                    @if( $errors->has('name') )
                        <span class="invalidated-feedback">
                                    {{  $errors->first('images') }}
                                </span>
                    @endif
                </div>
                <div class="form-group form-inline">
                    <label for="password" class="col-md-2">Password:</label>
                    <input type="password" class="form-control col-md-10" value="{{$user->password}}"name="password">
                    @if( $errors->has('name') )
                        <span class="invalidated-feedback">
                                    {{  $errors->first('password') }}
                                </span>
                    @endif
                </div>
                <div class="form-group form-inline">
                    <label for="role" class="col-md-2">Loại quyền</label>
                    <select name="role" id="" class="form-control col-2">
                        <option value="{{$user->id}}">{{$user->role}}</option>
                    </select>
                    @if( $errors->has('name') )
                        <span class="invalidated-feedback">
                                    {{  $errors->first('name') }}
                                </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary float-right" value="Cập nhật">
                </div>
            </form>
        </div>
    </div>
@endsection