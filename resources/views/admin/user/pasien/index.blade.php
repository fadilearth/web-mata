@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            {{-- <h5 class="card-title"></h5> --}}
            {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}

            <div class="table-responsive">
                
                <!-- Table with stripped rows -->
                <table class="table table-striped table-bordered nowrap" style="width:100%" id="tbl-pasien">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Active</th>
                        {{-- <th scope="col"></th> --}}
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
        table = $('#tbl-pasien').DataTable({
            destroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.manage-pasien.load_data') }}",
            },
            columns: [
                {
                    data: null,
                    sortable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
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
                    orderable: false,
                    render: function(data, type, row, meta) {
                            var btn = '';
                            if (row.active == 1) {
                                var checked = 'checked';
                                var active = 0;
                            } else {
                                var checked = '';
                                var active = 1;
                            }

                            btn += '<div class="custom-control custom-switch">' +
                                '<input type="checkbox" class="custom-control-input" ' + checked + '>' +
                                '<label class="custom-control-label" onclick="ubah_active(`' + row.id + '`, `' + active + '`)">click</label>' +
                                '</div>';
                        return btn;
                    }
                },
                // {
                //     data: null,
                //     orderable: false,
                //     searchable: false,
                //     render: function(data, type, row, meta) {
                //         return `
                //             <button class="btn btn-outline-success btn-sm" style="border-radius: 10px;" onclick="editData(`+row.id+`)"><i class="bi bi-pencil"></i></button>
                //             <button class="btn btn-outline-danger btn-sm" style="border-radius: 10px;" onclick="deleteData(`+row.id+`)"><i class="bi bi-trash"></i></button>
                //             `;
                //     },
                //     className: "text-center text-nowrap"
                // }
            ]
        });
        $('.dataTables_length label').addClass('small'); 
        $('.dataTables_length select').addClass('form-control'); 
        $('.dataTables_filter input').addClass('form-control'); 
        $('.dataTables_filter label').addClass('small'); 
        $('.dataTables_info').addClass('small'); 
    }

    function ubah_active(id, active) {
        var url = `{{ route('manage-pasien.edit', ':id') }}`;
            url = url.replace(':id', id);
            var method = 'GET';

        $.ajax({
            url: url,
            method: method,
            success: function(res) {
                console.log(res);

                $('#tbl-pasien').DataTable().ajax.reload(null, false);
                if (active == 0) {
                    makeToastr('success', 'toast-top-right', 'Akun Nonaktif!');
                } else {
                    makeToastr('success', 'toast-top-right', 'Akun Aktif!');
                }
            },
        });
    }
</script>
@endpush