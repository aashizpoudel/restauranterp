@extends('backend.layouts.app')

@section('links')

@endsection

@section('page-title')
    <h2>View All Category</h2>
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
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Is_Offer</th>
                        <th>image</th>
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
          ajax: "{{ route('category.index') }}",
          columns: [
              {data:'id', name:'id',orderable: false},
              {data: 'name', name: 'name',orderable: false},
              {data: 'slug', name: 'slug',orderable: false},
              {data:'status', name:'status' ,orderable: false},
              {data:'is_offer', name:'is_offer',orderable: false},
              {data:'image', name:'image',orderable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>

@endsection
@endsection
