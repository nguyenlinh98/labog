@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('css/header_content.css')}}">
@endsection
@section('content')
    <div class="tab">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Danh sách <b>Bài viết</b></h1>
                </div>
                <div class="col-sm-6 add_post float-right">
                    <a href="#addPostModal" class="btn btn-success" data-toggle="modal"><i
                                class="fa fa-plus-circle"></i><span>Thêm bài viết </span></a>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#list" role="tab" aria-controls="home"
                   aria-selected="true"><i class="fa fa-list-alt"></i> Danh sách bài viết</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#delete_flag" role="tab"
                   aria-controls="profile" aria-selected="false"><i class="fa fa-backspace"></i> Vô hiệu hóa </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="home-tab">
                <div class="col-md-4" style="margin: 10px ">
                    <form action="{{route('posts')}}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-prepend">
                                <button type="submit" class="form-control btn btn-primary">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
                <form action="{{route('inactiveAll')}}" method="post">
                    @csrf
                    @method('PATCH')
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr class="active">
                            <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
							</span>
                            </th>
                            <th>Stt</th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Thể loại</th>
                            <th>Tình trạng</th>
                            <th>Tác giả</th>
                            <th>Xuất bản</th>
                            <th colspan="3">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                    {{dd($activePost)}}--}}
                        @if( $activePosts == null)
                            <p>Không có bản ghi nào !</p>
                        @else
                            @foreach ($activePosts as $activePost)
                                @if($activePost->delete_flag == null)
                                    <tr><td><input type="checkbox" name="check[]" value="{{$activePost->id}}"></td>
                                        <td>{{$activePost->id}}</td>
                                        {{--                                    <td>{{$activePost->user}}</td>--}}
                                        <td><a href="{{route('show',$activePost->id)}}">{{$activePost->title}}</a></td>
                                        <td >{{$activePost->content}}</td>
                                        <td>
                                            {{ $activePost->category->name }}
                                        </td>
                                        <td>
                                            @if($activePost->status== 1)

                                                <button type="button" class="btn btn-success">Enable</button>

                                            @else
                                                <button type="button" class="btn btn-danger">Disable</button>
                                            @endif
                                        </td>
                                        <td>{{ $activePost->user->name }}</td>
                                        <td>
                                            @if($activePost->publish == 1)
                                                <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                            @else
                                                <button type="button" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="">
                                                @csrf
                                                @method('PATCH')
                                                <a href="{{route('edit', $activePost->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('inactive',$activePost->id)}}" class="btn btn-danger"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                            class="fa fa-trash-alt"></i></a>

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


                    @if ( $activePosts->total() <= $activePosts->perPage() && $activePosts->hasMorePages() == false)

                            <ul role="navigation" class="pagination">
                            <li aria-disabled="true" aria-label="« Previous" class="page-item disabled">
                                <span aria-hidden="true" class="page-link">‹</span>
                            </li>
                            <li aria-current="page" class="page-item active">
                                <span class="page-link">1</span>
                            </li>

                            <li class="page-item">
                                <a href="http://localhost:8000/post?page=2" rel="next" aria-label="Next »" class="page-link">›</a>
                            </li>
                        </ul>

                        @else
                            {{ $activePosts->links() }}
                        @endif
                     </span>
                </div>
            </div>
            <div class="tab-pane fade" id="delete_flag" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-hover table-bordered ">
                        <thead class="thead-light">
                        <tr class="active">
                            <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
							</span>
                            </th>
                            <th>Stt</th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Thể loại</th>
                            <th>Tình trạng</th>
                            <th>Xuất bản</th>
                            <th colspan="3">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($inactivePosts == null)
                            <div class="alert alert-danger" role="alert">
                                Empty data!
                            </div>
                        @else
                            @foreach ($inactivePosts as $inactivePost)
                                <tr>
                                    <td><input type="checkbox" name="check[]" value="{{$inactivePost->id}}"></td>
                                    <td>{{$inactivePost->id}}</td>
                                    <td>{{$inactivePost->title}} </td>
                                    <td >{{$inactivePost->content}}</td>
                                    <td>
                                        {{ $inactivePost->category->first()->name }}
                                    </td>
                                    <td>
                                        @if($inactivePost->status== 1)

                                            <button type="button" class="btn btn-success">Enable</button>

                                        @else
                                            <button type="button" class="btn btn-danger">Disable</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($inactivePost->publish == 1)
                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        @else
                                            <button type="button" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button>
                                        @endif
                                    </td>
                                    <td class="form-inline">
                                        <form action="" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <a href="{{route('inactive',$inactivePost->id)}}" class="btn btn-info"
                                               onclick="return confirm('Bạn có chắc chắn muốn khôi phục dữ liệu?')"><i
                                                        class="fa fa-sync-alt"></i></a>
                                        </form>

                                        @if( auth()->user()->role === 'admin' || $inactivePost->user_id === Auth::user()->id)
                                            <a href="#" class="btn btn-danger"
                                               onclick=" event.preventDefault();  document.getElementById('formDel-{{$inactivePost->id}}').submit();">
                                                <i class="fa fa-trash-alt"></i></a>

                                            <form action="{{ route('destroy', $inactivePost->id) }}" method="post"
                                                  id="formDel-{{$inactivePost->id}}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                <div class="float-right page-item">
                    <span>
                    @if ($inactivePosts->total() <= $inactivePosts->perPage() && $inactivePosts->hasMorePages() == false)

                            <ul role="navigation" class="pagination">
                            <li aria-disabled="true" aria-label="« Previous" class="page-item disabled">
                                <span aria-hidden="true" class="page-link">‹</span>
                            </li>
                            <li aria-current="page" class="page-item active">
                                <span class="page-link">1</span>
                            </li>

                            <li class="page-item">
                                <a href="http://localhost:8000/post?page=2" rel="next" aria-label="Next »" class="page-link">›</a>
                            </li>
                        </ul>
                        @else
                            {{ $inactivePosts->links() }}
                        @endif
                     </span>
                </div>
            </div>
            <!-- Add Modal HTML -->
            <div id="addPostModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action ="{{route('store')}}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm bài viết </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Tiêu đề:</label>
                                    <input type="text" name="title" class="form-control" required>
                                    <span class="invalid-feedback col-md-3" >
                                       Trường dữ liệu không được để trống !
                                        <small><i class="fa fa-star-of-life"></i></small>
                                    </span>
                                    @if($errors->has('title'))
                                        <span class="invalid-feedback">
                                          {{$errors->first('title')}}
                                        </span>
                                    @endif
                                </div>
                                <div class="fom-group">
                                    <label for="category_id">Thể loại:</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">----Option-----</option>
                                        @foreach($categories as $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                        @if($errors->has('category_id'))
                                            <span class="invalid-feedback">
                                          {{$errors->first('category_id')}}
                                        </span>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Content">Nội dung:</label>
                                    <textarea name="content" cols="50" rows="10" class="form-control"></textarea>
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback">
                                          {{$errors->first('content')}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="status">Public:</label>
                                    <select name="publish" id="" class="form-control">
                                        <option value="1">Công khai</option>
                                        <option value="0">Chế độ mình tôi</option>
                                    </select>
                                </div>
                                    @if($errors->has('status'))
                                        <span class="invalid-feedback">
                                          {{$errors->first('status')}}
                                        </span>
                                    @endif
                                </div>
                            <div class="form-group">
                                <input type="submit" value="Thêm bài viết" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
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