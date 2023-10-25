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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-admin" onclick="tambahData()"><i class="bi bi-plus" style="font-size: 18px;"></i> Tambah</button>
            </div>

            <div class="table-responsive">
                
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
    </div>
</section>

<!-- Modal Tambah Branch -->
<div class="modal modal-blur fade" id="modal-admin" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-admin" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" placeholder="id">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="name" id="name">
                          <div class="invalid-feedback">Name tidak boleh kosong.</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="email" id="email">
                          <div class="invalid-feedback">Email tidak boleh kosong.</div>
                        </div>
                    </div>
                    <div class="row mb-3" id="div-password">
                        <label for="inputText" class="col-sm-3 col-form-label">Password <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group has-validation">
                                <input type="password" name="password" class="form-control" id="password">
                                <a href="javascript:void(0)" onclick="showHidePassword()" class="input-group-text" id="icon-password"><i class="bi bi-lock"></i></a>
                              <div class="invalid-feedback">Password tidak boleh kosong.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Active</label>
                        <div class="col-sm-9">
                            <div class="input-group has-validation">
                                <input type="checkbox" name="active" id="active" class="form-check-input" value="1">
                                <div class="invalid-feedback">Active tidak boleh kosong.</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" style="text-decoration: none;" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a href="#" class="btn btn-primary ms-auto" onclick="simpanData()">
                    <i class="bi bi-save"></i>
                    Simpan
                </a>
            </div>
        </div>
    </div>
</div>
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
            url: "{{ route('admin.manage-admin.load_data') }}",
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
                data: "active",
                name: "active",
                render: function(data, type, row, meta) {
                    if(row.active == 1){
                        return `<span class="badge bg-success rounded-pill">active</span>`
                    }else{
                        return `<span class="badge bg-danger rounded-pill">nonctive</span>`
                    }
                },
                className: "text-center text-nowrap"
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `
                        <button class="btn btn-outline-success btn-sm" style="border-radius: 10px;" onclick="editData(`+row.id+`)"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-outline-danger btn-sm" style="border-radius: 10px;" onclick="deleteData(`+row.id+`)"><i class="bi bi-trash"></i></button>
                        `;
                },
                className: "text-center text-nowrap"
            }
        ]
    });
    $('.dataTables_length label').addClass('small'); 
    $('.dataTables_length select').addClass('form-control'); 
    $('.dataTables_filter input').addClass('form-control'); 
    $('.dataTables_filter label').addClass('small'); 
    $('.dataTables_info').addClass('small'); 
}

function clearModal(){
    $('#id').val('')
    $('#name').val('')
    $('#email').val('')
    $('#password').val('')
    $('#div-password').show()
    $('#active').prop('checked', false)
}

function tambahData(){
    $('#title-modal').text('Tambah Admin')
    clearModal()
}

function simpanData() {
    var id = $('#id').val()

    if(id == ''){
        var url = `{{ route('manage-admin.store') }}`;
        var method = 'POST'
    }else{
        var url = `{{ route('manage-admin.update', ':id') }}`;
        url = url.replace(':id', id);
        var method = 'PUT'
    }

    $.ajax({
        url: url,
        data: $('#form-admin').serialize(),
        method: method,
        beforeSend: function() {
            document.getElementById('overlay').classList.add('d-block')
        },
        success: function(res) {
            console.log(res)

            if(res.status == 'success'){
                if(id != ''){
                    makeToastr('success', 'toast-top-right', 'Data berhasil diedit')
                }else{
                    makeToastr('success', 'toast-top-right', 'Data berhasil disimpan')
                }

                $('#modal-admin').modal('hide');
                $('#tbl-admin').DataTable().ajax.reload(null, false);
                clearModal()
                
            }else if(res.status == 'email_ada'){
                makeToastr('error', 'toast-top-right', 'Email sudah digunakan')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            var data = jqXHR.responseJSON;
            var error = data.message

            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: error,
            })
        },
        complete: function() {
            document.getElementById('overlay').classList.remove('d-block')
        }
    });
}

function editData(id) {
    var url = `{{ route('manage-admin.edit', ':id') }}`;
    url = url.replace(':id', id),

    $.ajax({
        url: url,
        method: "GET",
        beforeSend: function() {
            document.getElementById('overlay').classList.add('d-block')
        },
        success: function(res) {
            console.log(res)

            clearModal()
            if(res.data != null){
                $('#title-modal').text('Edit Admin')

                $('#id').val(res.data.id)
                $('#name').val(res.data.name)
                $('#email').val(res.data.email)
                // $('#password').val(res.data.password)
                $('#div-password').hide()

                if(res.data.active == 1){
                    $('#active').prop('checked', true)                    
                }else{
                    $('#active').prop('checked', false)                    
                }

                $('#modal-admin').modal('show')
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            var data = jqXHR.responseJSON;
            var error = data.message

            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: error,
            })
        },
        complete: function() {
            document.getElementById('overlay').classList.remove('d-block')
        }
    });
}

function deleteData(id){
    Swal.fire({
        icon: 'warning',
        title: 'Apakah anda yakin ingin menghapus?',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
    }).then((result) => {
        if (result.isConfirmed) {

            var url = `{{ route('manage-admin.destroy', ':id') }}`;
            url = url.replace(':id', id);
            
            $.ajax({
                url: url,
                method: "DELETE",
                beforeSend: function() {
                    document.getElementById('overlay').classList.add('d-block')
                },
                success: function(res) {
                    console.log(res)

                    if(res.status == 'success'){
                        makeToastr('success', 'toast-top-right', 'Data berhasil dihapus')
                        $('#tbl-admin').DataTable().ajax.reload(null, false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var data = jqXHR.responseJSON;
                    var error = data.message

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: error,
                    })
                },
                complete: function() {
                    document.getElementById('overlay').classList.remove('d-block')
                }
            });
        } 
    })
}
</script>
@endpush