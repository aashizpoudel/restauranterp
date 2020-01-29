@extends('backend.layouts.app')

@section('page-title')
    <h2>Create New Category</h2>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <form id="Form" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
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
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_offer" id="is_offer" value="1" checked>
                    <label class="form-check-label" for="is_offer">
                      Is Offer
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_offer" id="not_offer" value="0">
                    <label class="form-check-label" for="not_offer">
                      Is Not Offer
                    </label>
                    @error('is_offer')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="images">Category Images</label>
                    <div id="app">
                        <image-uploader list_url="{{route('category-image.index')}}"
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


