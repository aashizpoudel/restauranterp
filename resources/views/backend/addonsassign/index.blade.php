@extends('backend.layouts.app')

@section('links')

@endsection

@section('page-title')
    <h2>Assigned Add-ons</h2><br>
    <button type="button" data-toggle="modal" data-target="#addassign" class="btn btn-success">Add-on assign</button>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Foods</th>
                        <th>Addons</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addassign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add-ons Assign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="Form" action="{{route('addonassign.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="food">Foods</label>

                    <select name="food" class="form-control" id="food">
                        @foreach($foods as $food)
                            <option value="{{$food->id}}">{{$food->name}}</option>
                        @endforeach
                    </select>
                    @error('food')
                    <p class="text-danger">{{$message}}</p>
                     @enderror
                </div>
                <div class="form-group">
                    <label for="addon">Add-ons</label>
                    <select name="addon" class="form-control" id="addon">
                        @foreach($addons as $addon)
                            <option value="{{$addon->id}}">{{$addon->name}}</option>
                        @endforeach
                    </select>
                    @error('addon')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <button name="submit" value="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
 <div class='modal fade' id='editassign' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Update Add-ons Assign</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
            <form id='editForm' action='#' method='post' enctype='multipart/form-data'>
                {{ csrf_field() }}
                @method('PUT')
                <div class='form-group'>
                    <label for='food'>Foods</label>

                    <select name='food' class='form-control' id='food'>
                        @foreach($foods as $food)
                            <option value='{{$food->id}}'>{{$food->name}}</option>
                        @endforeach
                    </select>
                    @error('food')
                    <p class='text-danger'>{{$message}}</p>
                     @enderror
                </div>
                <div class='form-group'>
                    <label for='addon'>Add-ons</label>
                    <select name='addon' class='form-control' id='addon'>
                        @foreach($addons as $addon)
                            <option value='{{$addon->id}}'>{{$addon->name}}</option>
                        @endforeach
                    </select>
                    @error('addon')
                        <p class='text-danger'>{{$message}}</p>
                    @enderror
                </div>
                <button name='submit' value='submit' class='btn btn-success'>Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>

@section('scripts')


<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('addonassign.index') }}",
          columns: [
              {data: 'foods', name: 'foods',orderable: false},
              {data: 'add_on', name: 'addons',orderable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });


  </script>
  <script>
      $(document).ready(function(){
        $('#editassign').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var food = button.data('food');
            var addon = button.data('addon');
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body #food').val(food);
            modal.find('.modal-body #addon').val(addon);
            modal.find('#editForm').attr('action', "addonassign/" + id);

        })
      });
  </script>



@endsection
@endsection
