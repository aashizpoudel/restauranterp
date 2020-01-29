@extends('backend.layouts.app')

@section('page-title')
<h2>Edit Category {{ $category->name}}</h2>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <form id="submit" action="{{route('category.update',[$category->id])}}" method="post">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required class="form-control" value="{{@old('name')?@old('name'):$category->name}}" id ="name"/>
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="slug" name="slug" required class="form-control" value="{{@old('slug')?@old('slug'):$category->slug}}" id ="slug"/>
                    @error('slug')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{$category->status==1?'selected':""}}>Active</option>
                        <option value="0" {{$category->status==0?'selected':""}}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_offer" id="is_offer" value="1" {{$category->is_offer==1?'checked':""}}>
                    <label class="form-check-label" for="is_offer">
                      Is Offer
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_offer" id="not_offer" value="0" {{$category->is_offer==0?'checked':""}}>
                    <label class="form-check-label" for="not_offer">
                      Is Not Offer
                    </label>
                    @error('is_offer')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="images">Hotel Images</label>
                    <div id="app">
                        <image-uploader list_url="{{route('category-image.index',['id'=>$category->id])}}"
                            delete_url="{{route('category-image.index')}}"
                            upload_url="{{route('category-image.store')}}" />
                    </div>

                </div>

                <button name="submit" value="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>



@endsection
