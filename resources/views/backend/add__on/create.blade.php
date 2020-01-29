@extends('backend.layouts.app')

@section('page-title')
    <h2>Create New Add-ons</h2>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <form id="Form" action="{{route('addon.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required class="form-control" value="{{@old('name')}}" id ="name"/>
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="slug" name="slug" required class="form-control" value="{{@old('slug')}}" id ="slug"/>
                    @error('slug')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">price</label>
                    <input type="price" name="price" required class="form-control" value="{{@old('price')}}" id ="price"/>
                    @error('price')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                       <div class="form-group">
                    <label for="images">Add-Ons Images</label>
                    <div id="app">
                        <image-uploader list_url="{{route('addon-image.index')}}"
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


