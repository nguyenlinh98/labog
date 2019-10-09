@extends('layouts.app')
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
                <form class="el-form mt-4" action="{{route('profile.update',['id' => auth()->user()->id ])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex justify-content-center mt-2">
                        <div title="Click to upload your avatar." class="btn-change-avatar" >
                            <img src="{{Storage::url(auth()->user()->images)}}" class="avatar "
                                 style="height: 128px; width: 128px; border-radius: 50%">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label for="name" class="col-2">Username:</label>
                        <input type="text" autocomplete="off" name="name" class=" form-control col-8" value="{{ auth()->user()->name    }}">
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
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

