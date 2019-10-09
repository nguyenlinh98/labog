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
                    <tfoot>
                        <tr class="thead-light">
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
                                        <form action="" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <a href="{{route('inactive',$inactivePost->id)}}" class="btn btn-info"
                                               onclick="return confirm('Bạn có chắc chắn muốn khôi phục dữ liệu?')"><i
                                                        class="fa fa-sync-alt"></i></a>
                                        </form>
                                        @can('delete-post')
                                        <a href="#" class="btn btn-danger"
                                           onclick=" event.preventDefault();  document.getElementById('formDel-{{$inactivePost->id}}').submit();">
                                            <i class="fa fa-trash-alt"></i></a>

                                        <form action="{{ route('destroy', $inactivePost->id) }}" method="post"
                                              id="formDel-{{$inactivePost->id}}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endcan
                                </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr class="thead-light">
                        <th>Stt</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Thể loại</th>
                        <th>Tình trạng</th>
                        <th>Xuất bản</th>
                        <th colspan="3">Hành động</th>
                    </tfoot>
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
        </div>
    </div>
@endsection