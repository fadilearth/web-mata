<script>
    function showHidePassword(){
        var password = document.getElementById('password').type;
        
        if(password == 'password'){
            $('#password').prop('type', 'text');
            $('#icon-password').html('<i class="bi bi-unlock"></i>')
        }else{
            $('#password').prop('type', 'password');
            $('#icon-password').html('<i class="bi bi-lock"></i>')
        }
    }

    function showError(res){
        var list_error = ''
        Object.keys(res.error).forEach(function(key) {
            res.error[key].forEach(item => {
                list_error += '<li class="text-start">'+item+'</li>'
            });
        });

        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: '<ul>' + list_error + '</ul>',
        })
    }
</script>