<aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-----------------------VENDOR JS FILES----------------------->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-4/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/backend/js/adminlte.js"></script>



<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
       
    var url = window.location;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $("#kontak_customer").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#pic_customer").on("input", function(){
        var regexp = /[^a-z A-Z]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_simpan_customer').on("click",function(){
            $('#form_customer').validate({
                rules: {
                    pic_customer: {
                        required: true,
                    },
                    alamat_customer: {
                        required: true,
                    },
                    kontak_customer: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    password_customer: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    pic_customer: {
                        required: "Nama PIC harus diisi",
                    },
                    alamat_customer: {
                        required: "Alamat harus diisi",
                    },
                    kontak_customer: {
                        required: "Mo. Telepon / HP harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    password_customer: {
                        required: "Pasword harus diisi",
                        minlength: "Minimal 5 karakter",
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
                        url : '<?php echo base_url('customer/profil/edit_customer'); ?>',
                        method: 'POST',
                        data : $('#form_customer').serialize(),
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah diedit',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                }).then(function(){
                                    window.location.replace("<?php echo base_url('login/logout'); ?>");
                                });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Response',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                })
                            }
                        } 
                    });   
                }
            });
        });
    });

     $('#btn_simpan_password').on("click",function(){
        $('#form_password').validate({
            rules: {
                password_lama: {
                    required: true,
                    minlength: 5,
                },
                password_baru_1: {
                    required: true,
                    minlength: 5
                },
                password_baru_2: {
                    required: true,
                    minlength: 5,
                    equalTo: password_baru_1,
                },
            },
            messages: {
                password_lama: {
                    required: "Password harus diisi",
                    minlength: "Minimal 5 karakter",
                },
                password_baru_1: {
                    required: "Password harus diisi",
                    minlength: "Minimal 5 karakter"
                },
                password_baru_2: {
                    required: "Password harus diisi",
                    minlength: "Minimal 5 karakter",
                    equalTo: "Password harus sama"
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
                    url : '<?php echo base_url('customer/profil/reset_password'); ?>',
                    method: 'POST',
                    data: $('#form_password').serialize(),
                    success: function(response){
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Password berhasil diganti..!!',
                                showConfirmButton: true,
                                confirmButtonColor: '#6f42c1',
                                timer: 3000
                            }).then(function(){
                                window.location.replace("<?php echo base_url('login/logout'); ?>");
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#6f42c1',
                                timer: 3000
                            })
                        }
                    }
                });    
            }
        });
    });
</script>

<script>
    //Oploadna ditembak
    Dropzone.autoDiscover = false;
    var url_delete = "<?php echo base_url('customer/profil/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('customer/profil/simpan_foto'); ?>";

    var foto_customer1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#foto_customer').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#foto_customer').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#foto_customer').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {foto_customer:foto},
                        cache: false,
                        dataType: 'json',
                        success: function(response){
                            if(response == 1){
                            }
                        }
                    });
                });
            }
        }
    });

    //Teu jadi upload
    foto_customer1.on("removedfile",function(){
        var foto_customer = $('#foto_customer').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_customer:foto_customer},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_customer").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_customer').on("click",function(){
        var foto_customer = $('#foto_customer').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_customer:foto_customer},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_customer").val("");
                    $("img#assets_customer").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_customer").hide(500); 
                }
            }
        });
    });
</script>


</body>
</html>