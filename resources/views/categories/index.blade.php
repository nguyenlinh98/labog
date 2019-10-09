@extends('layouts.app')
<style>
    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
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
            @can('create',\App\User::class)
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#delete_flag" role="tab"
                   aria-controls="profile" aria-selected="false"><i class="fa fa-backspace"></i>Vô hiệu hóa</a>
            </li>
                @endcan
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
                                         @if(auth()->user()->role ==='admin')
                                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning"  ><i class="fa fa-edit"></i></a>
                                             @else
                                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning disabled"  ><i class="fa fa-edit"></i></a>
                                             @endif

                                            @can('create',\App\User::class)
                                        @csrf
                                        @method('DELETE')
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
                    <tfoot>
                    <tr class="thead-light">
                        <th>Stt</th>
                        <th>Tên thể loại</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </tfoot>
                </table>
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
                                            @can('create',\App\User::class)
                                            <a href="{{route('category.inactive',$inactivecategory->id)}}" class="btn btn-info"
                                               onclick="return confirm('Bạn có chắc chắn muốn khôi phục lại?')"><i class="fa fa-sync-alt"></i></a>
                                            <a href="{{route('category.destroy',$inactivecategory->id)}}" class="btn btn-danger"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                        class="fa fa-trash-alt"></i></a>
                                            @endcan
                                        </form>

                                    </td>

                                </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr class="thead-light">
                        <th>Stt</th>
                        <th>Tên thể loại</th>
                        <th>Trạng thái</th>
                        <th>Khôi phục</th>
                        <th>Hành động</th>
                    </tr>
                    </tfoot>
                </table>
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
        </div>
    </div>
@endsection
