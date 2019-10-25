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
                                class="fa fa-plus-circle"></i><span>Thêm thể loại</span></a>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#list" role="tab" aria-controls="home"
                   aria-selected="true"><i class="fa fa-list-alt"></i> Danh sách thể loại</a>
            </li>
            @can('create',\App\User::class)
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#delete_flag" role="tab"
                       aria-controls="profile" aria-selected="false"><i class="fa fa-backspace"></i>Vô hiệu hóa</a>
                </li>
            @endcan
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="home-tab">
                <form action="{{url('category/inactiveAll')}}" method="post">
                    @csrf
                    @method('PATCH')
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox"  class="selectAll"></th>
                            <th>Stt</th>
                            <th>Tên thể loại</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($activeCategories == null)
                            <div class="alert alert-danger" role="alert">
                                Không có bản ghi nào!
                            </div>
                        @else
                            @foreach($activeCategories as $category)
                                <tr>
                                    <td><input type="checkbox" name="option[]" value="{{$category->id}}"></td>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @if($category->status ==1)
                                            <a href="#" class="btn btn-success">Enable</a>
                                        @else
                                            <a href="#" class="btn btn-danger">Disable</a>
                                        @endif

                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            @if(auth()->user()->role ==='admin')
                                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning"  ><i class="fa fa-edit"></i></a>
                                            @else
                                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning disabled"  ><i class="fa fa-edit"></i></a>
                                            @endif

                                            @can('create',\App\User::class)
                                                @csrf
{{--                                                @method('DELETE')--}}
                                                <a href="{{route('category.inactive',$category->id)}}" class="btn btn-danger"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                            class="fa fa-trash-alt"></i></a>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-danger">Chuyển trạng thái hoạt động</button>
                </form>
                <div class="float-right page-item">
                    <span>
                    @if ($activeCategories->total() <= $activeCategories->perPage() && $activeCategories->hasMorePages() == false)

                            <ul role="navigation" class="pagination">
                            <li aria-disabled="true" aria-label="« Previous" class="page-item disabled">
                                <span aria-hidden="true" class="page-link">‹</span>
                            </li>
                            <li aria-current="page" class="page-item active">
                                <span class="page-link">1</span>
                            </li>

                            <li class="page-item">
                                <a href="http://localhost:8000/category?page=2" rel="next" aria-label="Next »" class="page-link">›</a>
                            </li>
                        </ul>
                        @else
                            {{ $activeCategories->links() }}
                        @endif
                     </span>
                </div>
            </div>
            <div class="tab-pane fade" id="delete_flag" role="tabpanel" aria-labelledby="profile-tab">
                <form action="{{route('category.destroy')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <table class="table table-hover ">
                        <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox" class="selectAll"></th>
                            <th>Stt</th>
                            <th>Tên thể loại</th>
                            <th>Trạng thái</th>
                            <th>Khôi phục</th>
                            <th>Hành động</th>
                        </thead>
                        <tbody>
                        @if($inactiveCategories == null)
                            <div class="alert alert-danger" role="alert">
                                Empty data!
                            </div>
                        @else
                            @foreach($inactiveCategories as $inactivecategory)
                                <tr>
                                    <td><input type="checkbox" name="option[]" value="{{$inactivecategory->id}}"></td>
                                    <td>{{$inactivecategory->id}}</td>
                                    <td>{{$inactivecategory->name}}</td>
                                    <td>
                                        @if($inactivecategory->status ==1)
                                            <a href="#" class="btn btn-success">Enable</a>
                                        @else
                                            <a href="#" class="btn btn-danger">Disable</a>
                                        @endif

                                    </td>
                                    <td>{{$inactivecategory->active}}</td>

                                    <td>
                                        <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            @can('create',\App\User::class)
                                                <a href="{{route('category.inactive',$inactivecategory->id)}}" class="btn btn-info"
                                                   onclick="return confirm('Bạn có chắc chắn muốn khôi phục lại?')"><i class="fa fa-sync-alt"></i></a>
                                            @endcan
                                        </form>

                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @can('create',\App\User::class)
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa các bản ghi được chọn</button>
                    @endcan
                </form>
                <div class="float-right page-item">
                    <span>
                    @if ($inactiveCategories->total() <= $inactiveCategories->perPage() && $inactiveCategories->hasMorePages() == false)

                            <ul role="navigation" class="pagination">
                            <li aria-disabled="true" aria-label="« Previous" class="page-item disabled">
                                <span aria-hidden="true" class="page-link">‹</span>
                            </li>
                            <li aria-current="page" class="page-item active">
                                <span class="page-link">1</span>
                            </li>

                            <li class="page-item">
                                <a href="http://localhost:8000/category?page=2" rel="next" aria-label="Next »" class="page-link">›</a>
                            </li>
                        </ul>
                        @else
                            {{ $inactiveCategories->links() }}
                        @endif
                     </span>
                </div>
            </div>
            <div id="addPostModal" class="modal fade">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action ="{{route('categories.store')}}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm thể loại </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Thể loại:</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                                    <span class="invalid-feedback col-md-3" >
                                       Trường dữ liệu không được để trống !
                                        <small><i class="fa fa-star-of-life"></i></small>
                                    </span>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
{{--                                    @if($errors->has('name'))--}}
{{--                                        <span class="invalid-feedback">--}}
{{--                                          {{$errors->first('name')}}--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
                                </div>
                                <div class="form-group">
                                    <label for="status">Trạng thái:</label>
                                    <select name="status" id="" class="form-control @error('name') is-invalid @enderror">
                                        <option value="1">Công khai</option>
                                        <option value="0">Chế độ mình tôi</option>
                                    </select>
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
    <script type="text/javascript">
        $(document).ready(function(){
            var checkbox = $('table tbody input[type="checkbox"]');
            $(".selectAll").click( function () {
                if(this.checked){
                    checkbox.each(function(){
                        this.checked = true;
                    });
                }else {
                    checkbox.each(function () {
                        this.checked =false;
                    });
                }
            });
             checkbox.click(function () {
                 $('.selectAll').prop("checked",false);
             });
        });
    </script>
    @endsection
