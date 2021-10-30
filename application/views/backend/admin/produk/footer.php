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
    var url_produk =  "<?php echo base_url('admin/produk'); ?>";
    var url = url_produk ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_produk();
	function load_data_produk(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/produk/load_data_produk'); ?>',
			beforeSend : function(){
				$('#content_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_produk').html(response);
			}
		});
    };

    $('#btn_tambah_produk').on("click",function(){
        var url = "<?php echo base_url('admin/produk/form_tambah_produk'); ?>";

        $('#modal_produk').modal('show');
        $('.modal-title').text('Tambah Produk');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_produk', function(e) {
        var kode_produk=$(this).attr("kode_produk");
        var url = "<?php echo base_url('admin/produk/form_edit_produk'); ?>";

        $('#modal_produk').modal('show');
        $('.modal-title').text('Edit Produk');
        $('.modal-body').load(url,{kode_produk : kode_produk});
    });  

    $(document).ready(function() {
        $('#btn_simpan_produk').on("click",function(){
            $('#form_produk').validate({
                rules: {
                    kode_produk_baru: {
                        required: true,
                    },
                    nama_produk_baru: {
                        required: true,
                    },
                    kode_kategori: {
                        required: true,
                    },
                    kode_satuan: {
                        required: true,
                    },
                    harga_produk: {
                        required: true,
                        minlength: 4,
                    },
                    stok_limit_produk: {
                        required: true,
                    },
                },
                messages: {
                    kode_produk_baru: {
                        required: "Kode harus diisi",
                    },
                    nama_produk_baru: {
                        required: "Produk harus diisi",
                    },
                    kode_kategori: {
                        required: "Kategori harus diisi",
                    },
                    kode_satuan: {
                        required: "Satuan harus diisi",
                    },
                    harga_produk: {
                        required: "Harga harus diisi",
                        minlength: "Minimal 4 digit",
                    },
                    stok_limit_produk: {
                        required: "Stok limit harus diisi",
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
                            url : '<?php echo base_url('admin/produk/tambah_produk'); ?>',
                            method: 'POST',
                            data : $('#form_produk').serialize(),
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
                                        load_data_produk();
                                        $('#modal_produk').modal('hide');
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
                    else if(jenis == "Edit"){
                        $.ajax({
                            url : '<?php echo base_url('admin/produk/edit_produk'); ?>',
                            method: 'POST',
                            data : $('#form_produk').serialize(),
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
                                        load_data_produk();
                                        $('#modal_produk').modal('hide');
                                    });
                                }else{
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

    $(document).on('click', '.btn_hapus_produk', function(e) {
        var kode_produk = $(this).attr("kode_produk");
        var nama_produk = $(this).attr("nama_produk");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_produk + '"!',
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
                        url: '<?php echo base_url('admin/produk/hapus_produk'); ?>',
                        method: 'POST',
                        data: {kode_produk : kode_produk},                
                    })
                    .done(function(response) {
                        load_data_produk();
                        $('#modal_produk').modal('hide');
                        Swal.fire({
                            title: 'Data Berhasil Dihapus',
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
    var url_delete = "<?php echo base_url('admin/produk/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('admin/produk/simpan_foto'); ?>";

    var foto_produk1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#gambar_produk').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#gambar_produk').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#gambar_produk').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {gambar_produk:foto},
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
    foto_produk1.on("removedfile",function(){
        var gambar_produk = $('#gambar_produk').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {gambar_produk:gambar_produk},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#gambar_produk").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_produk').on("click",function(){
        var gambar_produk = $('#gambar_produk').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {gambar_produk:gambar_produk},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#gambar_produk").val("");
                    $("img#assets_produk").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_produk").hide(500); 
                }
            }
        });
    });
</script>

</body>
</html>