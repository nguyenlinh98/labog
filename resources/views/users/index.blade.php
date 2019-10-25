@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('css/header_content.css')}}">
    @endsection
@section('content')
    <div class="tab">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Danh sách <b>Tài khoản</b></h1>
                </div>
                <div class="col-sm-6">
                    <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i
                                class="fa fa-plus-circle"></i><span>Thêm tài khoản</span></a>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#list">Danh sách người dùng </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#inactive">Tài khoản vô hiệu hóa</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane container active" id="list">
                <form action="{{route('users.deleteAll')}}" method="post">
                    @csrf
                    @method('PATCH')
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
                            </th>
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
                                        <td><input type="checkbox" name="option[]" value="{{$user->id}}"></td>
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
                    </table>
                    <button type="submit" class="btn btn-danger"><i
                                class="fa fa-minus-circle"></i> <span>Vô hiệu hóa tài khoản</span></button>
                </form>
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
                                <a href="http://localhost:8000/user?page=2" rel="next" aria-label="Next »"
                                   class="page-link">›</a>
                            </li>
                        </ul>
                        @else
                            {{ $activeUsers->links() }}
                        @endif
                     </span>
                </div>
            </div>
            <div class="tab-pane container fade" id="inactive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
                        </th>
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
                                <td><input type="checkbox" name="option[]" value="{{$inactiveUser->id}}"></td>
                                <td>{{$inactiveUser->id}}</td>
                                <td>{{$inactiveUser->name}}</td>
                                <td>{{$inactiveUser->email}}</td>
                                <td>{{$inactiveUser->role}}</td>
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
                                <a href="http://localhost:8000/user?page=2" rel="next" aria-label="Next »"
                                   class="page-link">›</a>
                            </li>
                        </ul>
                        @else
                            {{ $inactiveUsers->links() }}
                        @endif
                     </span>
                </div>
            </div>
            <!-- Add Modal HTML -->
            <div id="addUserModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action ="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Đăng ký tài khoản </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name"> Tên đăng nhập:</label>
                                    <input type="text" name="name" class="form-control" value ="{{old('name')}}" required>
                                    <span class="invalid-feedback col-md-3" >
                                       Trường dữ liệu không được để trống !
                                        <small><i class="fa fa-star-of-life"></i></small>
                                    </span>
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback">
                                          {{$errors->first('name')}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email"> Địa chỉ email:</label>
                                    <input type="email" name="email" class="form-control"  value ="{{'email'}}"required>
                                    <span class="invalid-feedback col-md-3" >
                                       Trường dữ liệu không được để trống !
                                        <small><i class="fa fa-star-of-life"></i></small>
                                    </span>
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                          {{$errors->first('email')}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="role"> Loại quyền:</label>
                                    <input type="text" name="role" class="form-control"  value="{{old('role')}}" required>
                                    <span class="invalid-feedback col-md-3" >
                                       Trường dữ liệu không được để trống !
                                        <small><i class="fa fa-star-of-life"></i></small>
                                    </span>
                                    @if($errors->has('role'))
                                        <span class="invalid-feedback">
                                          {{$errors->first('role')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editUserModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title"> Sửa thể loaị</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-info" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            $("#registerBtn").click(function () {

                $input = $('#storeForm input');
                $length = $input.length;

                $input.each(function () {

                    $parent = $(this).parent();
                    $spanElement = $parent.children('span');
                    if ($(this).val() == "") {

                        $spanElement.css("display", "block");
                    } else {
                        $spanElement.css("display", "none");
                    }
                });
            });
        });
        $(document).click(function () {
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function () {
                if (this.checked) {
                    checkbox.each(function () {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function () {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function () {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });

    </script>
@endsection