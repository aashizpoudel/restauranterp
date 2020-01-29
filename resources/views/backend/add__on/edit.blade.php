@extends('backend.layouts.app')

@section('page-title')
    <h2>Edit Add-ons</h2>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <form id="Form" action="{{route('addon.update', [$addon->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required class="form-control" value="{{@old('name')?@old('name'):$addon->name}}" id ="name"/>
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="slug" name="slug" required class="form-control" value="{{@old('slug')?@old('slug'):$addon->slug}}" id ="slug"/>
                    @error('slug')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">price</label>
                    <input type="price" name="price" required class="form-control" value="{{@old('price')?@old('price'):$addon->price}}" id ="price"/>
                    @error('price')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{$addon->status==1?'selected':''}} value="1">Active</option>
                        <option {{$addon->status==0?'selected':''}} value="0">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                       <div class="form-group">
                    <label for="images">Add-Ons Images</label>
                    <div id="app">
                        <image-uploader list_url="{{route('addon-image.index',['id'=>$addon->id])}}"
                            delete_url="{{route('addon-image.index')}}"
                            upload_url="{{route('addon-image.store')}}" />
                    </div>

                </div>
                <button name="submit" value="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection


