@extends('backend.layouts.app')

@section('page-title')
<h2>Edit User {{$user->name}}</h2>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <form id="submit" action="{{route('user.update', [$user->id])}}" method="post">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" required class="form-control" value="{{@old('name')?old('name'):$user->name}}" id ="name"/>
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required class="form-control" value="{{@old('email')?old('email'):$user->email}}" id ="email"/>
                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        @foreach (App\Role::latest()->where('slug', '!=', 'admin')->get() as $role)
                            <option {{$user->role_id==$role->id?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach

                    </select>
                    @error('role_id')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" required class="form-control" value="{{@old('password')}}" id ="password"/>
                    @error('password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="con_password">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="form-control" value="{{@old('password_confirmation')}}" id ="con_password"/>
                    @error('confirm_password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div> --}}
                <button name="submit" value="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>



@endsection
