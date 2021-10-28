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

    $("#kontak_supplier").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#pic_supplier").on("input", function(){
        var regexp = /[^a-z A-Z]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_simpan_supplier').on("click",function(){
            $('#form_supplier').validate({
                rules: {
                    pic_supplier: {
                        required: true,
                    },
                    alamat_supplier: {
                        required: true,
                    },
                    kontak_supplier: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    password_supplier: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    pic_supplier: {
                        required: "Nama PIC harus diisi",
                    },
                    alamat_supplier: {
                        required: "Alamat harus diisi",
                    },
                    kontak_supplier: {
                        required: "Mo. Telepon / HP harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    password_supplier: {
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
                        url : '<?php echo base_url('supplier/profil/edit_supplier'); ?>',
                        method: 'POST',
                        data : $('#form_supplier').serialize(),
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
                    url : '<?php echo base_url('supplier/profil/reset_password'); ?>',
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
    var url_delete = "<?php echo base_url('supplier/profil/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('supplier/profil/simpan_foto'); ?>";

    var foto_supplier1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#foto_supplier').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#foto_supplier').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#foto_supplier').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {foto_supplier:foto},
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
    foto_supplier1.on("removedfile",function(){
        var foto_supplier = $('#foto_supplier').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_supplier:foto_supplier},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_supplier").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_supplier').on("click",function(){
        var foto_supplier = $('#foto_supplier').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_supplier:foto_supplier},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_supplier").val("");
                    $("img#assets_supplier").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_supplier").hide(500); 
                }
            }
        });
    });
</script>


</body>
</html>