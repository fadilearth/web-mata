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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small" style="font-size: 13px;">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate id="form-register">
                    @csrf

                    <div class="col-12">
                      <input type="text" name="name" class="form-control" id="name" placeholder="Name" onkeyup="enterRegister(this)" required>
                      <div class="invalid-feedback">Please enter your name.</div>
                    </div>

                    <div class="col-12">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" onkeyup="enterRegister(this)" required>
                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                        <div class="input-group has-validation">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" onkeyup="enterRegister(this)" required>
                            <a href="javascript:void(0)" onclick="showHidePassword()" class="input-group-text" id="icon-password"><i class="bi bi-lock"></i></a>
                          <div class="invalid-feedback">Please enter your password.</div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div> --}}
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="button" onclick="register()">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
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
  </main><!-- End #main -->
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
    function enterRegister(evt) {
        if(event.key === 'Enter') {
            register()       
        }
    }

    function register() {
        var name = $('#name').val()
        var email = $('#email').val()
        var password = $('#password').val()

        document.getElementById('name').classList.remove('is-invalid')
        document.getElementById('email').classList.remove('is-invalid')
        document.getElementById('password').classList.remove('is-invalid')

        if (name != '' && email != '' && password != '') {
            registerAct()
        } else {
            if (name == '') {
                document.getElementById('name').classList.add('is-invalid')
            }
            if (email == '') {
                document.getElementById('email').classList.add('is-invalid')
            }
            if (password == '') {
                document.getElementById('password').classList.add('is-invalid')
            }
        }
    }

    function registerAct() {
        var url = `{{ route('registerAct') }}`;

        $.ajax({
            url: url,
            data: $('#form-register').serialize(),
            method: "POST",
            beforeSend: function() {
                document.getElementById('overlay').classList.add('d-block')
            },
            success: function(res) {
                console.log(res)

                if(res.status == 'success'){
                    makeToastr('success', 'toast-top-right', 'Akun anda berhasil dibuat. Silahkan login untuk melanjutkan')
                    setTimeout(() => {
                        window.location.href = `{{ route('login') }}`
                    }, 1500);
                    clearForm()
                }else if(res.status == 'email_ada'){
                    makeToastr('error', 'toast-top-right', 'Email sudah terdaftar')
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

    function clearForm() {
        $('#name').val('')
        $('#email').val('')
        $('#password').val('')
    }
</script>
@endpush