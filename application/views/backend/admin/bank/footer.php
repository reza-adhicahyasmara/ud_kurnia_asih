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
    var url_bank =  "<?php echo base_url('admin/bank'); ?>";
    var url = url_bank ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<!-----------------------BANK----------------------->
<script type="text/javascript">

    load_data_bank();
	function load_data_bank(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/bank/load_data_bank'); ?>',
			beforeSend : function(){
				$('#content_bank').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_bank').html(response);
			}
		});
    };

    $('#btn_tambah_bank').on("click",function(){
        var url = "<?php echo base_url('admin/bank/form_tambah_bank'); ?>";

        $('#modal_bank').modal('show');
        $('.modal-title').text('Tambah Bank');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_bank', function(e) {
        var kode_bank=$(this).attr("kode_bank");
        var url = "<?php echo base_url('admin/bank/form_edit_bank'); ?>";

        $('#modal_bank').modal('show');
        $('.modal-title').text('Edit Bank');
        $('.modal-body').load(url,{kode_bank : kode_bank});
    });  

    $(document).ready(function() {
        $('#btn_simpan_bank').on("click",function(){
            $('#form_bank').validate({
                rules: {
                    kode_bank_baru: {
                        required: true,
                        minlength: 3,
                    },
                    nama_bank: {
                        required: true,
                        minlength: 'Minimal 3 digit',
                    },
                },
                messages: {
                    kode_bank_baru: {
                        required: "Bank harus diisi",
                    },
                    nama_bank: {
                        required: "Bank harus diisi",
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
                            url : '<?php echo base_url('admin/bank/tambah_bank'); ?>',
                            method: 'POST',
                            data: $('#form_bank').serialize(),
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
                                        load_data_bank();
                                        $('#modal_bank').modal('hide');
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
                            url : '<?php echo base_url('admin/bank/edit_bank'); ?>',
                            method: 'POST',
                            data: $('#form_bank').serialize(),
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
                                        load_data_bank();
                                        $('#modal_bank').modal('hide');
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

    $(document).on('click', '.btn_hapus_bank', function(e) {
        var kode_bank=$(this).attr("kode_bank");
        var nama_bank=$(this).attr("nama_bank");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_bank + '"!',
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
                        url: '<?php echo base_url('admin/bank/hapus_bank'); ?>',
                        method: 'POST',
                        data: {kode_bank : kode_bank},                
                    })
                    .done(function(response) {
                        load_data_bank();
                        $('#modal_bank').modal('hide');
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


<!-----------------------BANK----------------------->

<script type="text/javascript">

    load_data_rekening();
	function load_data_rekening(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/bank/load_data_rekening'); ?>',
			beforeSend : function(){
				$('#content_rekening').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_rekening').html(response);
			}
		});
    };

    $('#btn_tambah_rekening').on("click",function(){
        var url = "<?php echo base_url('admin/bank/form_tambah_rekening'); ?>";

        $('#modal_rekening').modal('show');
        $('.modal-title').text('Tambah Rekening Bank');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_rekening', function(e) {
        var kode_rekening=$(this).attr("kode_rekening");
        var url = "<?php echo base_url('admin/bank/form_edit_rekening'); ?>";

        $('#modal_rekening').modal('show');
        $('.modal-title').text('Edit Rekening Bank');
        $('.modal-body').load(url,{kode_rekening : kode_rekening});
    });  

    $(document).ready(function() {
        $('#btn_simpan_rekening').on("click",function(){
            $('#form_rekening').validate({
                rules: {
                    kode_bank: {
                        required: true,
                    },
                    an_rekening: {
                        required: true,
                    },
                    no_rekening: {
                        required: true,
                    },
                },
                messages: {
                    kode_bank: {
                        required: "Bank harus diisi",
                    },
                    an_rekening: {
                        required: "Atas nama harus diisi",
                    },
                    no_rekening: {
                        required: "No. rekening harus diisi",
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
                            url : '<?php echo base_url('admin/bank/tambah_rekening'); ?>',
                            method: 'POST',
                            data: $('#form_rekening').serialize(),
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
                                        load_data_rekening();
                                        $('#modal_rekening').modal('hide');
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
                            url : '<?php echo base_url('admin/bank/edit_rekening'); ?>',
                            method: 'POST',
                            data: $('#form_rekening').serialize(),
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
                                        load_data_rekening();
                                        $('#modal_rekening').modal('hide');
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

    $(document).on('click', '.btn_hapus_rekening', function(e) {
        var kode_rekening=$(this).attr("kode_rekening");
        var no_rekening=$(this).attr("no_rekening");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data "' + no_rekening + '"!',
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
                        url: '<?php echo base_url('admin/bank/hapus_rekening'); ?>',
                        method: 'POST',
                        data: {kode_rekening : kode_rekening},                
                    })
                    .done(function(response) {
                        load_data_rekening();
                        $('#modal_rekening').modal('hide');
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

</body>
</html>