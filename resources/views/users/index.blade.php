@extends('layouts.app')
@section('content')
    <div class="content_list">
        <div class="header_title">
            <h1>Danh sách người dùng</h1>
        </div>
        <div class="add_post float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formadd">
                Tạo tài khoản mới
            </button>
        </div>

        <!-- The Modal -->
        <div class="modal" id="formadd">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    @if (session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                    @endif
                    <form action="{{route( 'users.store' )}}" method="post" id="storeForm">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Đăng ký tài khoản</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group form-inline">
                                <label for="name" class="col-md-2">Username : </label>
                                <input type="text" class="form-control col-md-7" name="name" required>

                                <span class="invalid-feedback col-md-3" >
                                    Trường dữ liệu không được để trống ! <small><i class="fa fa-star-of-life"></i></small>
                                </span>
                                @if( $errors->has('name') )
                                <span class="invalidated-feedback">
                                    {{  $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group form-inline">
                                <label for="name" class="col-md-2">Địa chỉ Email : </label>
                                <input type="text" class="form-control col-md-7" name="email" required>

                                <span class="invalid-feedback col-md-3" >
                                    Trường dữ liệu không được để trống ! <small><i class="fa fa-star-of-life"></i></small>
                                </span>
                                @if( $errors->has('email') )
                                    <span class="invalidated-feedback">
                                    {{  $errors->first('email') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group form-inline">
                                <label for="password" class="col-md-2">Image : </label>
                                <input type="file" class="form-control col-md-7" name="images" required>
                                <span class="invalid-feedback col-md-3" >
                                    Trường dữ liệu không được để trống ! <small><i class="fa fa-star-of-life"></i></small>
                                </span>
                                @if( $errors->has('images') )
                                    <span class="invalid-feedback">
                                    {{  $errors->first('images') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group form-inline">
                                <label for="role" class="col-md-2">Roles : </label>
                                <input type="text" class="form-control col-md-7" name="role" required>

                                <span class="invalid-feedback col-md-3" >
                                    Trường dữ liệu không được để trống ! <small><i class="fa fa-star-of-life"></i></small>
                                </span>
                                @if( $errors->has('role') )
                                    <span class="invalidated-feedback">
                                    {{  $errors->first('role') }}
                                </span>
                                @endif
                            </div>
                            <div class="form-group form-inline">
                                <label for="password" class="col-md-2">Password : </label>
                                <input type="password" class="form-control col-md-7" name="password" required>
                                <span class="invalid-feedback col-md-3" >
                                    Trường dữ liệu không được để trống ! <small><i class="fa fa-star-of-life"></i></small>
                                </span>
                                @if( $errors->has('password') )
                                    <span class="invalidated-feedback">
                                    {{  $errors->first('password') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                        <input type="submit" value="Đăng ký" class="btn btn-primary float-right" id="registerBtn">
                        <input type="button"  class="btn btn-danger" data-dismiss="modal" value="Close">
                        </div>
                    </form>

                    <!-- Modal footer -->
{{--                    <div class="modal-footer">--}}
{{--                        <input type="submit" value="Đăng ký" class="btn btn-primary float-right" id="registerBtn">--}}
{{--                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
        <div class="content_form">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#list">Danh sách người dùng </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#inactive">Tài khoản vô hiệu hóa</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="list">
                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr >
                            <th>Stt</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Loại quyền</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($activeUsers == null)
                            <span>Không có bản ghi nào trong bảng!</span>
                        @else
                            @foreach($activeUsers as $user)
                                @if($user->active ==null)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>
                                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning"><i
                                                        class="fa fa-user-edit"></i></a>
                                            <a href="#" class="btn btn-danger"
                                               onclick=" event.preventDefault();  document.getElementById('formDel-{{$user->id}}').submit();"><i
                                                        class="fa fa-user-lock"></i></a>

                                            <form action="{{ route('users.inactive', $user->id) }}" method="post"
                                                  id="formDel-{{$user->id}}" style="display: none;">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr class="thead-light">
                            <th>Stt</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Loại quyền</th>
                            <th>Hành động</th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="float-right page-item">
                    <span>
                    @if ($activeUsers->total() <= $activeUsers->perPage() && $activeUsers->hasMorePages() == false)

                            <ul role="navigation" class="pagination">
                            <li aria-disabled="true" aria-label="« Previous" class="page-item disabled">
                                <span aria-hidden="true" class="page-link">‹</span>
                            </li>
                            <li aria-current="page" class="page-item active">
                                <span class="page-link">1</span>
                            </li>

                            <li class="page-item">
                                <a href="http://localhost:8000/user?page=2" rel="next" aria-label="Next »" class="page-link">›</a>
                            </li>
                        </ul>
                        @else
                            {{ $activeUsers->links() }}
                        @endif
                     </span>
                    </div>
                </div>
                <div class="tab-pane container fade" id="inactive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>Stt</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Loại quyền</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($inactiveUsers == null)
                            <span>Không có bản ghi nào trong bảng!</span>
                        @else
                            @foreach($inactiveUsers as $inactiveUser)
                                <tr>
                                    <td>{{$inactiveUser->id}}</td>
                                    <td>{{$inactiveUser->name}}</td>
                                    <td>{{$inactiveUser->email}}</td>
                                    <td></td>
                                    <td>
                                        <a href="#" class="btn btn-warning"
                                           onclick=" event.preventDefault();  document.getElementById('formActive-{{$inactiveUser->id}}').submit();">
                                            <i class="fa fa-redo-alt"></i></a>
                                        <form action="{{ route('users.inactive', $inactiveUser->id) }}" method="post"
                                              id="formActive-{{$inactiveUser->id}}" style="display: none;">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <a href="#" class="btn btn-danger"
                                           onclick=" event.preventDefault();  document.getElementById('formDel-{{$inactiveUser->id}}').submit();">
                                            <i class="fa fa-trash-alt"></i></a>

                                        <form action="{{ route('users.destroy', $inactiveUser->id) }}" method="post"
                                              id="formDel-{{$inactiveUser->id}}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr class="thead-light">
                            <th>Stt</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Loại quyền</th>
                            <th>Hành động</th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="float-right page-item">
                    <span>
                    @if ($inactiveUsers->total() <= $inactiveUsers->perPage() && $inactiveUsers->hasMorePages() == false)

                            <ul role="navigation" class="pagination">
                            <li aria-disabled="true" aria-label="« Previous" class="page-item disabled">
                                <span aria-hidden="true" class="page-link">‹</span>
                            </li>
                            <li aria-current="page" class="page-item active">
                                <span class="page-link">1</span>
                            </li>

                            <li class="page-item">
                                <a href="http://localhost:8000/user?page=2" rel="next" aria-label="Next »" class="page-link">›</a>
                            </li>
                        </ul>
                        @else
                            {{ $inactiveUsers->links() }}
                        @endif
                     </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            $("#registerBtn").click( function () {

                $input = $('#storeForm input');
                $length = $input.length;

                $input.each( function () {

                    $parent = $(this).parent();
                    $spanElement = $parent.children('span');
                    if ( $(this).val() == ""  )
                    {

                        $spanElement.css("display","block");
                    } else
                    {
                        $spanElement.css("display","none");
                    }
                });
            });
        });

    </script>
@endsection