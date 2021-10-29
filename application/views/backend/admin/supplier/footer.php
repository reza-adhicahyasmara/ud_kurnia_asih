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
    var url_supplier =  "<?php echo base_url('admin/supplier'); ?>";
    var url = url_supplier ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<!-----------------------DATA SUPPLIER----------------------->
<script type="text/javascript">
    load_data_supplier();
	function load_data_supplier(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/supplier/load_data_supplier'); ?>',
			beforeSend : function(){
				$('#content_supplier').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_supplier').html(response);
			}
		});
    };

    $('#btn_tambah_supplier').on("click",function(){
        var url = "<?php echo base_url('admin/supplier/form_tambah_supplier'); ?>";

        $('#modal_supplier').modal('show');
        $('.modal-title').text('Tambah Supplier');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_supplier', function(e) {
        var id_supplier=$(this).attr("id_supplier");
        var url = "<?php echo base_url('admin/supplier/form_edit_supplier'); ?>";

        $('#modal_supplier').modal('show');
        $('.modal-title').text('Edit Supplier');
        $('.modal-body').load(url,{id_supplier : id_supplier});
    });  

    $(document).ready(function() {
        $('#btn_simpan_supplier').on("click",function(){
            $('#form_supplier').validate({
                rules: {
                    nama_supplier: {
                        required: true,
                    },
                    pic_supplier: {
                        required: true,
                    },
                    kontak_supplier: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    alamat_supplier: {
                        required: true,
                    },
                    username_supplier_baru: {
                        required: true,
                        minlength: 5,
                    },
                    password_supplier: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    nama_supplier: {
                        required: "Nama harus diisi",
                    },
                    pic_supplier: {
                        required: "PIC harus diisi",
                    },
                    kontak_supplier: {
                        required: "Mo. Telepon / HP harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    alamat_supplier: {
                        required: "Alamat harus diisi",
                    },
                    username_supplier_baru: {
                        required: "Username harus diisi",
                        minlength: "Minimal 5 karakter",
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
                    var jenis = $('#jenis').val();
                    if (jenis == "Tambah"){
                        $.ajax({
                            url : '<?php echo base_url('admin/supplier/tambah_supplier'); ?>',
                            method: 'POST',
                            data : $('#form_supplier').serialize(),
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
                                        load_data_supplier();
                                        $('#modal_supplier').modal('hide');
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
                            url : '<?php echo base_url('admin/supplier/edit_supplier'); ?>',
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
                                        load_data_supplier();
                                        $('#modal_supplier').modal('hide');
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

    $(document).on('click', '.btn_hapus_supplier', function(e) {
        var id_supplier = $(this).attr("id_supplier");
        var nama_supplier = $(this).attr("nama_supplier");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_supplier + '"!',
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
                        url: '<?php echo base_url('admin/supplier/hapus_supplier'); ?>',
                        method: 'POST',
                        data: {id_supplier : id_supplier},                
                    })
                    .done(function(response) {
                        load_data_satuan();
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



<!-----------------------DATA BAHAN BAKU----------------------->
<script type="text/javascript">
    load_data_bahan_baku();
    function load_data_bahan_baku(){
        var id_supplier = "<?php echo $this->uri->segment(4); ?>";
		$.ajax({
			method : "POST",
			url : '<?php echo base_url('admin/supplier/load_data_bahan_baku');?>',
            data : {id_supplier : id_supplier},
			beforeSend : function(){
				$('#content_bahan_baku').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_bahan_baku').html(response);
			}
		});
    };
    
    $('#btn_tambah_bahan_baku').on("click",function(){
        var url = "<?php echo base_url('admin/bahan_baku/form_tambah_bahan_baku'); ?>";

        $('#modal_bahan_baku').modal('show');
        $('.modal-title').text('Tambah Bahan Baku');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_bahan_baku', function(e) {
        var kode_bb=$(this).attr("kode_bb");
        var url = "<?php echo base_url('admin/bahan_baku/form_edit_bahan_baku'); ?>";

        $('#modal_bahan_baku').modal('show');
        $('.modal-title').text('Edit Bahan Baku');
        $('.modal-body').load(url,{kode_bb : kode_bb});
    });  

    $(document).ready(function() {
        $('#btn_simpan_bahan_baku').on("click",function(){
            $('#form_bahan_baku').validate({
                rules: {
                    kode_bb_baru: {
                        required: true,
                    },
                    nama_bb_baru: {
                        required: true,
                    },
                    id_supplier: {
                        required: true,
                    },
                    kode_kategori: {
                        required: true,
                    },
                    kode_satuan: {
                        required: true,
                    },
                    stok_limit_pab_bb: {
                        required: true,
                    },
                },
                messages: {
                    kode_bb_baru: {
                        required: "Kode harus diisi",
                    },
                    nama_bb_baru: {
                        required: "Bahan baku harus diisi",
                    },
                    id_supplier: {
                        required: "Supplier harus diisi",
                    },
                    kode_kategori: {
                        required: "Kategori harus diisi",
                    },
                    kode_satuan: {
                        required: "Satuan harus diisi",
                    },
                    stok_limit_pab_bb: {
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
                            url : '<?php echo base_url('admin/bahan_baku/tambah_bahan_baku'); ?>',
                            method: 'POST',
                            data : $('#form_bahan_baku').serialize(),
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
                                        load_data_bahan_baku();
                                        $('#modal_bahan_baku').modal('hide');
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
                            url : '<?php echo base_url('admin/bahan_baku/edit_bahan_baku'); ?>',
                            method: 'POST',
                            data : $('#form_bahan_baku').serialize(),
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
                                        load_data_bahan_baku();
                                        $('#modal_bahan_baku').modal('hide');
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

    $(document).on('click', '.btn_hapus_bahan_baku', function(e) {
        var kode_bb = $(this).attr("kode_bb");
        var nama_bb = $(this).attr("nama_bb");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_bb + '"!',
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
                        url: '<?php echo base_url('admin/bahan_baku/hapus_bahan_baku'); ?>',
                        method: 'POST',
                        data: {kode_bb : kode_bb},                
                    })
                    .done(function(response) {
                        load_data_bahan_baku();
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
</body>
</html>