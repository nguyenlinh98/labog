@extends('layouts.app')
@section('style')
    <style type="text/css">
        .el-card {
            border-radius: 4px;
            border: 1px solid #ebeef5;
            background-color: #fff;
            overflow: hidden;
            color: #303133;
            transition: .3s;
            padding: 20px;
        }
        .justify-content-center
        {
            margin-bottom: 20px ;
        }
        /*}*/
    </style>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="el-card is-never-shadow">
            <div class="el-card__body">
                <h1 class="card-title">Thông tin cá nhân </h1>
                <p class="card-subtitle">
                    Quản lý thông tin cá nhân của bạn và thông tin liên lạc.
                </p>
                <form class="el-form mt-4"  method="post" enctype="multipart/form-data" id="form-update" >
                    @csrf
                    @method('PATCH')
                    <div class="d-flex justify-content-center mt-2">
                        <div title="Click to upload your avatar." class="btn-change-avatar" >
                            <img src="{{Storage::url(auth()->user()->images)}}" class="avatar "
                                 style="height: 128px; width: 128px; border-radius: 50%" id="avatar">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label for="name" class="col-2">Username:</label>
                        <input type="text" autocomplete="off" name="name" class=" form-control col-8" value="{{ auth()->user()->name }}">
                        @if( $errors->has('name') )
                            <span class="invalidated-feedback">
                                    {{  $errors->first('name') }}
                                </span>
                        @endif
                    </div>
                    <div class="form-group form-inline">
                        <label for="email" class="col-2">Email:</label>
                        <input type="email" class="form-control col-8" value="{{    auth()->user()->email   }}" name="email">
                        @if($errors->has('email'))
                            <span class="invalid-feedback">
                                {{  $errors->first('email')  }}
                            </span>
                            @endif
                    </div>
                    <div class=" form-group form-inline">
                        <label for="password" class="col-2">Password:</label>
                        <input type="password" name="password" class="form-control col-8" />
                        @if( $errors->has('password') )
                            <span class="invalidated-feedback">
                                    {{  $errors->first('password') }}
                                </span>
                        @endif
                    </div>
                    <div class="form-group form-inline">
                        <label for="image" class="col-2">Change Picture: </label>
                        <input type="file" class="el-input__inner form-control col-8" name ="images">
                        @if( $errors->has('images') )
                            <span class="invalidated-feedback">
                                    {{  $errors->first('images') }}
                                </span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" style="margin-right: 5px; margin-left: 5px; " id="updateImage">Thay ảnh</button>
                        <button class="btn btn-primary" value="Update" id="UpdateButton">Cập nhật thông tin</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#UpdateButton").click( function(event) {
            event.preventDefault();
            var data = $('input').serialize();
            var form_Data = new FormData();
            $.ajaxSetup({
                headers: {
                    'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: " {{  route('profile.update', ['id' => auth()->user()->id]) }}",
                cache: false,
                // contentType: false,
                // processData: false,
                dataType: 'json',
                data: data,
                beforeSend : function() {
                    console.log(data);
                },
                 success:function(data){
                    // console.log(data);
                 }
            });
        });
        $("#updateImage").click( function (event) {
            event.preventDefault();
            var content = $('input').serialize();
            var image = $('input[name=images]').prop('files')[0];
            var form_Data = new FormData();
            form_Data.append('images', image);
            form_Data.append('_token', $("input[name=_token]").val() );
            form_Data.append('_method', $("input[name=_method]").val() );
            $.ajax({
               type : "post",
                url : " {{  route('profile.update', ['id' => auth()->user()->id]) }}",
                cache: false,
                contentType : false,
                processData : false,
                dataType : 'text',
                data : form_Data,
                success:function (data) {
                    var obj = JSON.parse(data);
                    var url = obj.image;
                    //  var link = '/storage/'+ image;
                    // console.log(link);
                    if(obj.success)
                    {
                        var link = '/storage/' +url;
                         $('img').attr('src' , link);
                    }
                }
            });
        });


    </script>

@endsection

