@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            QUẢN LÝ ROLE
            <p><small>Quản lý quyền hạn của nhân viên ! Đảm bảo các thao tác không vượt quá quyền</small></p>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Quản lý</a></li>
{{--            <li><a href="#">Role and Permission</a></li>--}}
            <li class="active">Quản lý Role</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <!-- role table  -->
            <div class="col-xs-12 container">


                <div class="box">
                    <div class="box-header">
                        <button class="btn btn-success" data-toggle="modal" data-target="#form-role"> + Role</button>

                        <div class="modal fade" id="form-role" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm nhóm Quyền</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">
                                        <form class="" action="#" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Nhóm</label>
                                                <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" requrie>
                                                @if($errors->has('name'))
                                                    <span>{{$errors->first('name')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="display_name">Hiển thị</label>
                                                <input type="text" name="display_name" id="display_name" value="{{old('display_name')}}" class="form-control" requrie>
                                                @if($errors->has('display_name'))
                                                    <span>{{$errors->first('display_name')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Miêu tả</label>
                                                <input type="text" name="description" id="description" value="{{old('description')}}" class="form-control" requrie>

                                            </div>
                                            <button type="submit" name="button" class="btn btn-success">Tạo mới</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="content">
                        <table id="role-table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Nhóm</th>
                                <th>Mô tả tên</th>
                                <th>Danh sách các quyền tồn tại</th>
                                <th>Miêu tả</th>
                                <th>Thời gian cập nhật</th>
                                <th>Tước quyền</th>
                                <th>Quyền mới</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="list-role">
                            @foreach($roles as $ro)
{{--                                {{dd($roles)}}--}}

                                <tr>
                                    <td>{{$ro->name}}</td>
                                    <td>{{$ro->display_name}}</td>
                                    <td>{{$ro->display_name}}</td>
                                    <td>{{$ro->description}}</td>
                                    <td>{{$ro->created_at}}</td>
                                    <th>
                                        permission
{{--                                        @foreach($ro->permission as $per)--}}
{{--                                            <span>{{$per->name}} ,</span>--}}
{{--                                        @endforeach--}}
                                    </th>
{{--                                    <td>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <select class="form-control" id="permission-out-{{$ro->id}}">--}}
{{--                                                <option value="">Default</option>--}}
{{--                                                @foreach($ro->permission as $per)--}}
{{--                                                    <option value="{{$per->id}}">{{$per->display_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <select class="form-control" id="permission-in-{{$ro->id}}">--}}
{{--                                                <option value="">Default</option>--}}
{{--                                                @foreach($permission as $per)--}}
{{--                                                    <option value="{{$per->id}}">{{$per->display_name}}</option>--}}
{{--                                                @endforeach--}}

{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                    <td>permission</td>
                                    <td>
                                        <input type="hidden" name="role" value="{{$ro->id}}" class="hidden">
                                        <a href="" name="delete">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>

                                            </button>
                                        </a>
                                        <a href="" name="update">
                                            <button type="button" class="btn btn-warning">
                                                <i class="fa fa-redo"></i>
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- end role -->

        </div>
    </section>

@endsection