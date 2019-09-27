@extends('layouts.app')
@section('content')
    <div class="edit_form">
        <div class="title">
            <h1>Sửa thông tin tài khoản</h1>
        </div>
        <hr>
        <div class="main_content">
            <form action="" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group form-inline">
                    <label for="name" class="col-md-2">Username:</label>
                    <input type="text" value="{{$user->name}}" class="form-control col-md-10">
                </div>
                <div class="form-group form-inline">
                    <label for="email" class="col-md-2">Địa chỉ mail:</label>
                    <input type="email" class="form-control col-md-10" value="{{$user->email}}">
                </div>
                <div class="form-group form-inline">
                    <label for="password" class="col-md-2">Password:</label>
                    <input type="password" class="form-control col-md-10" value="{{$user->password}}" disabled>
                </div>
                <div class="form-group form-inline">
                    <label for="role" class="col-md-2">Loại quyền</label>
                    <select name="role" id="" class="form-control col-2">
                        <option value="">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary float-right" value="Cập nhật">
                </div>
            </form>
        </div>
    </div>
@endsection