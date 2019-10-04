@extends('layouts.app')
@section('content')
    <div class="tab">
        <div class="title_category">
            <h1>Danh sách thể loại</h1>
        </div>
        <div class="add_category float-right">
            <a href="{{route('create')}}" class="btn btn-primary">Thêm thể loại <i class="fa fa-folder-plus"></i></a>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#list" role="tab" aria-controls="home"
                   aria-selected="true"><i class="fa fa-list-alt"></i> Danh sách thể loại</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#delete_flag" role="tab"
                   aria-controls="profile" aria-selected="false"><i class="fa fa-backspace"></i>Vô hiệu hóa</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
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
                                    <form action="">
                                        <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{route('category.inactive',$category->id)}}" class="btn btn-danger"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                    class="fa fa-trash-alt"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Stt</th>
                        <th>Tên thể loại</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="delete_flag" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-hover ">
                    <thead class="thead-light">
                    <tr>
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
                                        <form action="">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('category.inactive',$inactivecategory->id)}}" class="btn btn-info"
                                               onclick="return confirm('Bạn có chắc chắn muốn khôi phục lại?')"><i class="fa fa-sync-alt"></i></a>
                                            <a href="{{route('category.destroy',$inactivecategory->id)}}" class="btn btn-danger"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                        class="fa fa-trash-alt"></i></a>
                                        </form>
                                    </td>
                                </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Stt</th>
                        <th>Tên thể loại</th>
                        <th>Trạng thái</th>
                        <th>Khôi phục</th>
                        <th>Hành động</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
