@extends('backend.layouts.app')

@section('links')

@endsection

@section('page-title')
    <h2>View All Users</h2>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mt-4">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
          ajax: "{{ route('user.index') }}",
          columns: [
              {data:'id', name:'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data:'role.name', name:'role'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>

@endsection
@endsection
