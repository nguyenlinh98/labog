@extends('layouts.app')
@section('content')
    <div class="tab">
        <div class="title_category">
            <h1>Danh sách bài viết</h1>
        </div>
        <div class="add_post float-right">
            <a href="{{route('add')}}" class="btn btn-primary">Thêm bài viết <i class="fa fa-folder-plus"></i></a>
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
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr class="active">
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
{{--                    {{dd($activePost)}}--}}
                    @if( $activePosts == null)
                        <p>Không có bản ghi nào !</p>
                    @else
                        @foreach ($activePosts as $activePost)
                            @if($activePost->delete_flag == null)
                                <tr>
                                    <td>{{$activePost->id}}</td>
                                    <td>{{$activePost->title}} </td>
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
                                    <td>
                                        @if($activePost->publish == 1)
                                            <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        @else
                                            <button type="button" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="">
                                            <a href="{{route('edit', $activePost->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('delete', $activePost->id)}}" class="btn btn-danger"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                        class="fa fa-trash-alt"></i></a>
                                        </form>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif

                    </tbody>
                    <tfoot>
                    <tr class="active">
                        <th>Stt</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Thể loại</th>
                        <th>Tình trạng</th>
                        <th>Xuất bản</th>
                        <th colspan="3">Hành động</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="delete_flag" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-hover ">
                    <thead class="thead-light">
                    <tr class="active">
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
                                    <td>
                                        <form action="">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('delete',$inactivePost->id)}}" class="btn btn-info"
                                               onclick="return confirm('Bạn có chắc chắn muốn khôi phục dữ liệu?')"><i
                                                        class="fa fa-sync-alt"></i></a>

                                            <a href="{{route('destroy',$inactivePost->id)}}" class="btn btn-danger"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                        class="fa fa-trash-alt"></i></a>
                                        </form>

                                    </td>
                                </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr class="active">
                        <th>Stt</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Thể loại</th>
                        <th>Tình trạng</th>
                        <th>Xuất bản</th>
                        <th colspan="3">Hành động</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection