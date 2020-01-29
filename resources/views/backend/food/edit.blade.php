@extends('backend.layouts.app')

@section('page-title')
    <h2>Edit Food</h2>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <form id="Form" action="{{route('food.update', [$food->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach ($category as $cate)
                            <option {{ $food->category_id==$cate->id?'selected':''}} value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required class="form-control" value="{{@old('name')?@old('name'):$food->name}}" id ="name"/>
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="slug" name="slug" required class="form-control" value="{{@old('slug')?@old('slug'):$food->slug}}" id ="slug"/>
                    @error('slug')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="components">Components</label>
                    <input type="components" name="components" required class="form-control" value="{{@old('components')?@old('components'):$food->components}}" id ="components"/>
                    @error('components')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <input type="notes" name="notes" required class="form-control" value="{{@old('notes')?@old('notes'):$food->notes}}" id ="notes"/>
                    @error('notes')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{@old('description')?@old('description'):$food->description}}</textarea>
                    @error('description')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="price" name="price" required class="form-control" value="{{@old('price')?@old('price'):$food->price}}" id ="price"/>
                    @error('price')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="vat">VAT%</label>
                    <input type="vat" name="vat" required class="form-control" value="{{@old('vat')?@old('vat'):$food->vat}}" id ="vat"/>
                    @error('vat')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{$food->status==1?'selected':''}} value="1">Active</option>
                        <option {{$food->status==0?'selected':''}} value="0">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_offer" id="is_offer" value="1" {{$food->is_offer==1?'checked':''}}>
                    <label class="form-check-label" for="is_offer">
                      Is Offer
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_offer" id="not_offer" value="0" {{$food->is_offer==0?'checked':''}}>
                    <label class="form-check-label" for="not_offer">
                      Is Not Offer
                    </label>
                    @error('is_offer')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="is_special">Is Special</label>
                    <select name="is_special" id="is_special" class="form-control">
                        <option {{$food->is_offer==1?'selected':''}} value="1">Yes</option>
                        <option {{$food->is_offer==0?'selected':''}} value="0">No</option>
                    </select>
                    @error('is_special')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="images">Hotel Images</label>
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


