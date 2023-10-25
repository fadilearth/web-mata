@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            {{-- <h5 class="card-title"></h5> --}}
            {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}

            <div class="d-flex justify-content-end mt-4 mb-3">
                <button type="button" class="btn btn-primary "><i class="bi bi-plus"></i> Tambah</button>
            </div>

            <!-- Table with stripped rows -->
            <table class="table table-striped table-bordered nowrap" style="width:100%" id="tbl-admin">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Active</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
var table = '';
$(document).ready(function(){
    // var table = $('#tbl-admin').DataTable({
    //     responsive: true,
    // }); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    load()
})

function load(){

table = $('#tbl-admin').DataTable({
    destroy: true,
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ route('admin.manage-admin.load') }}",
    },
    columns: [
        {
            data: "id",
            name: "id"
        },
        {
            data: "name",
            name: "name"
        },
        {
            data: "email",
            name: "email"
        },
        {
            data: "active",
            name: "active"
        },
        {
            data: null,
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
                    return `<span class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item edit edit" data-bs-toggle="modal" data-bs-target="#modalEditIzin" data-id="${data.id}">Ubah</a>
                            </div>
                        </span>`;
            },
            className: "text-center text-nowrap"
        }
    ]
});

}
</script>
@endpush