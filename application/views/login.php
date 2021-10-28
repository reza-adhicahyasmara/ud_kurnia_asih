<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/banner/onion.svg'); ?>"></link>
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/backend/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        body, html {   
            width: 100%;
            height: 100%;
            padding: 0;
            display: table;
            background-image: url('<?php echo base_url('assets/img/banner/san-francisco.png'); ?>'); 
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: bottom;  
        }

        .tengah{
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            height: 80vh;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
    </style>
</head>
<body class="hold-transition">
    <span class="text-xl mt-2 ml-2"><b>UD KURNIA ASIH</b></span>
    <div class="card-body tengah"> 
        <div class="container">
            <div class="row justify-content-center">  
                <div class="col-12 col-xl-5 col-sm-9">
                    <form role="form" id="form_login" action="<?php echo base_url('login');?>" method="post">
                        <div class="form-group mb-3">
                            <span class="text-lg text-center"><b>Login</b></span>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username');?>" placeholder="Username" >
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="password" value="<?php echo set_value('password');?>" placeholder="Password" autofocus >
                        </div>
                        <div class="form-group mb-5">
                            <button type="submit" name="proses" id="btn_login" class="btn bg-purple btn-block">Masuk <i class="float-right fa fa-arrow-right" style="margin-top: 5px;"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-4/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!--VALIDATION-->
    <script>

        $(document).ready(function() {
            $('#btn_login').on("click",function(){
                $('#form_login').validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 5
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                    },
                    messages: {
                        username: {
                            required: "Username harus diisi",
                            minlength: "Minimal 5 karakter"
                        },
                        password: {
                            required: "Password harus diisi",
                            minlength: "Minimal 5 karakter"
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                    submitHandler: function() {
                        $.ajax({
                            url : '<?php echo base_url('login/proses'); ?>',
                            method: 'POST',
                            data : $('#form_login').serialize(),
                            success: function(response){
                                if(response == 1){
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Username atau Password salah!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#6f42c1',
                                        timer: 3000
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login Berhasil!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#6f42c1',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.replace(response);
                                    });
                                }
                            }
                        }); 
                    }
                });
            });
        });
    </script>
</body>
</html>
