@extends('admin.layouts.master-auth')

@section('content')
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/template/admin') }}/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small" style="font-size: 13px;">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate id="form-login">
                    @csrf
                    <div class="col-12">
                      {{-- <label for="email" class="form-label">Email</label> --}}
                      <input type="email" name="email" class="form-control" id="email" placeholder="Email" onkeyup="enterLogin(this)" required>
                      <div class="invalid-feedback">Please enter your email.</div>
                    </div>

                    <div class="col-12">
                      {{-- <label for="yourPassword" class="form-label">Password</label> --}}
                      
                      <div class="input-group has-validation">
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password" onkeyup="enterLogin(this)" required>
                          <a href="javascript:void(0)" onclick="showHidePassword()" class="input-group-text" id="icon-password"><i class="bi bi-lock"></i></a>
                        <div class="invalid-feedback">Please enter your password.</div>
                      </div>
                    </div>

                    {{-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> --}}
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="button" onclick="login()">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="{{ route('register') }}">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});
    function enterLogin(evt) {
        if(event.key === 'Enter') {
            login()       
        }
    }

    function login() {
        var email = $('#email').val()
        var password = $('#password').val()

        document.getElementById('email').classList.remove('is-invalid')
        document.getElementById('password').classList.remove('is-invalid')

        if (email != '' && password != '') {
            loginAct()
        } else {
            if (email == '') {
                document.getElementById('email').classList.add('is-invalid')
            }
            if (password == '') {
                document.getElementById('password').classList.add('is-invalid')
            }
        }
    }

    function loginAct() {
        var url = `{{ route('loginAct') }}`;

        $.ajax({
            url: url,
            data: $('#form-login').serialize(),
            method: "POST",
            beforeSend: function() {
                document.getElementById('overlay').classList.add('d-block')
            },
            success: function(res) {
                console.log(res)

                if(res.status == 'success'){
                    makeToastr('success', 'toast-top-right', 'Berhasil login')
                    setTimeout(() => {
                        if(res.is_admin){
                            window.location.href = `{{ route('admin.dashboard') }}`
                        }else{
                            window.location.href = `{{ route('dashboard') }}`
                        }
                    }, 1500);
                    clearForm()
                }else if(res.status == 'belum_aktif'){
                    makeToastr('error', 'toast-top-right', 'Akun anda belum aktif')
                }else{
                    makeToastr('error', 'toast-top-right', 'Email dan password salah')
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

    function clearForm(){
      $('#email').val('')
      $('#password').val('')
    }
</script>
@endpush