@foreach($tags as $tag)
    <tr>
        <td>{{$tag->id}}</td>
        <td>{{$tag->name}}</td>
        <td><img src="{{Storage::url($tag->image)}}" alt="" style="width: 100px"></td>
        <td>@if($tag->status)
                <button class="btn-success">Active</button>
            @else
                <button class="btn-danger">Inactive</button>
            @endif
        </td>
        <td>
            <button  class="btn btn-info "><i class="fa fa-eye"></i></button>
            <button  class="btn btn-warning"><i class="fa fa-edit"></i></button>
            <button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
@endforeach