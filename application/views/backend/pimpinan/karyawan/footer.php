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
    var url_karyawan =  "<?php echo base_url('pimpinan/karyawan'); ?>";
    var url = url_karyawan ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    
    $("#kontak_karyawan").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#nama_karyawan").on("input", function(){
        var regexp = /[^a-z A-Z]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
</script>


<script type="text/javascript">
    load_data_admin();
	function load_data_admin(){
		$.ajax({
			method : "GET",
			url : "<?php echo base_url('pimpinan/karyawan/load_data_admin'); ?>",
			beforeSend : function(){
				$('#content_admin').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_admin').html(response);
			}
		});
    };

    load_data_gudang();
    function load_data_gudang(){
        $.ajax({
            method : "GET",
            url : "<?php echo base_url('pimpinan/karyawan/load_data_gudang'); ?>",
            beforeSend : function(){
                $('#content_gudang').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_gudang').html(response);
            }
        });
    };

    load_data_pimpinan();
	function load_data_pimpinan(){
		$.ajax({
			method : "GET",
			url : "<?php echo base_url('pimpinan/karyawan/load_data_pimpinan'); ?>",
			beforeSend : function(){
				$('#content_pimpinan').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_pimpinan').html(response);
			}
		});
    };

    $('#btn_tambah_karyawan').on("click",function(){
        var url = "<?php echo base_url('pimpinan/karyawan/form_tambah_karyawan'); ?>";

        $('#modal_karyawan').modal('show');
        $('.modal-title').text('Tambah Karyawan');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_karyawan', function(e) {
        var nik_karyawan=$(this).attr("nik_karyawan");
        var url = "<?php echo base_url('pimpinan/karyawan/form_edit_karyawan'); ?>";

        $('#modal_karyawan').modal('show');
        $('.modal-title').text('Edit Karyawan');
        $('.modal-body').load(url,{nik_karyawan : nik_karyawan});
    });  
    
    $(document).ready(function() {
        $('#btn_simpan_karyawan').on("click",function(){
            $('#form_karyawan').validate({
                rules: {
                    nik_karyawan: {
                        required: true,
                    },
                    level_karyawan: {
                        required: true,
                    },
                    nama_karyawan: {
                        required: true,
                    },
                    alamat_karyawan: {
                        required: true,
                    },
                    kontak_karyawan: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    password_karyawan: {
                        required: true,
                        minlength: 5,
                    },
                    username_karyawan_baru: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    nik_karyawan: {
                        required: "NIK harus diisi",
                    },
                    level_karyawan: {
                        required: "Level harus diisi",
                    },
                    nama_karyawan: {
                        required: "Nama harus diisi",
                    },
                    alamat_karyawan: {
                        required: "Alamat harus diisi",
                    },
                    kontak_karyawan: {
                        required: "Mo. Telepon / HP harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    password_karyawan: {
                        required: "Pasword harus diisi",
                        minlength: "Minimal 5 karakter",
                    },
                    username_karyawan_baru: {
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
                    var jenis = $('#jenis').val();
                    if (jenis == "Tambah"){
                        $.ajax({
                            url : '<?php echo base_url('pimpinan/karyawan/tambah_karyawan'); ?>',
                            method: 'POST',
                            data : $('#form_karyawan').serialize(),
                            success: function(response){
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data telah ditambahkan',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#6f42c1',
                                        timer: 3000
                                    }).then(function(){
                                        load_data_admin();
                                        load_data_gudang();
                                        load_data_pimpinan();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#6f42c1',
                                        timer: 3000
                                    })
                                }
                            }
                        }); 
                    }else if(jenis == "Edit"){
                        $.ajax({
                            url : '<?php echo base_url('pimpinan/karyawan/edit_karyawan'); ?>',
                            method: 'POST',
                            data : $('#form_karyawan').serialize(),
                            success: function(response){
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data telah ditambahkan',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#6f42c1',
                                        timer: 3000
                                    }).then(function(){
                                        load_data_admin();
                                        load_data_gudang();
                                        load_data_pimpinan();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#6f42c1',
                                        timer: 3000
                                    })
                                }
                            }
                        });
                    }
                }
            });  
        });
    });
    
    $(document).on('click', '.btn_hapus_karyawan', function() {
        var nik_karyawan=$(this).attr("nik_karyawan");
        var nama_karyawan=$(this).attr("nama_karyawan");
        var foto_karyawan=$(this).attr("foto_karyawan");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_karyawan + '"!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: "<?php echo base_url('pimpinan/karyawan/hapus_karyawan');?>",
                        method: 'POST',
                        data: {
                            nik_karyawan:nik_karyawan,
                            foto_karyawan:foto_karyawan
                        },                
                    })
                    .done(function(response) {
                        load_data_admin();
                        load_data_gudang();
                        load_data_pimpinan();
                        Swal.fire({
                            title: 'Data Barhasil Dihapus',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#6f42c1',
                        })
                    })
                    .fail(function() {
                        Swal.fire({
                            title: 'Terjadi Kesalahan',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#6f42c1',
                        })
                    });
                });
            },
        });
    });  
</script>

<!-----------------------DROPZONE----------------------->
<script>
    //Oploadna ditembak
    Dropzone.autoDiscover = false;
    var url_delete = "<?php echo base_url('pimpinan/karyawan/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('pimpinan/karyawan/simpan_foto'); ?>";

    var foto_karyawan1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#foto_karyawan').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#foto_karyawan').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#foto_karyawan').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {foto_karyawan:foto},
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
    foto_karyawan1.on("removedfile",function(){
        var foto_karyawan = $('#foto_karyawan').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_karyawan:foto_karyawan},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_karyawan").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_karyawan').on("click",function(){
        var foto_karyawan = $('#foto_karyawan').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_karyawan:foto_karyawan},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_karyawan").val("");
                    $("img#assets_karyawan").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_karyawan").hide(500); 
                }
            }
        });
    });
</script>

</body>
</html>