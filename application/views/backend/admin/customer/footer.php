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
    var url_customer =  "<?php echo base_url('admin/customer'); ?>";
    var url = url_customer ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_customer();
	function load_data_customer(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/customer/load_data_customer'); ?>',
			beforeSend : function(){
				$('#content_customer').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_customer').html(response);
			}
		});
    };

    $('#btn_tambah_customer').on("click",function(){
        var url = "<?php echo base_url('admin/customer/form_tambah_customer'); ?>";

        $('#modal_customer').modal('show');
        $('.modal-title').text('Tambah Customer');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_customer', function(e) {
        var kode_customer=$(this).attr("kode_customer");
        var url = "<?php echo base_url('admin/customer/form_edit_customer'); ?>";

        $('#modal_customer').modal('show');
        $('.modal-title').text('Edit Customer');
        $('.modal-body').load(url,{kode_customer : kode_customer});
    });  

    $(document).ready(function() {
        $('#btn_simpan_customer').on("click",function(){
            $('#form_customer').validate({
                rules: {
                    nama_customer: {
                        required: true,
                    },
                    pic_customer: {
                        required: true,
                    },
                    kontak_customer: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    alamat_customer: {
                        required: true,
                    },
                    username_customer_baru: {
                        required: true,
                        minlength: 5,
                    },
                    password_customer: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    nama_customer: {
                        required: "Nama harus diisi",
                    },
                    pic_customer: {
                        required: "PIC harus diisi",
                    },
                    kontak_customer: {
                        required: "Mo. Telepon / HP harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    alamat_customer: {
                        required: "Alamat harus diisi",
                    },
                    username_customer_baru: {
                        required: "Username harus diisi",
                        minlength: "Minimal 5 karakter",
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
                    var jenis = $('#jenis').val();
                    if (jenis == "Tambah"){
                        $.ajax({
                            url : '<?php echo base_url('admin/customer/tambah_customer'); ?>',
                            method: 'POST',
                            data : $('#form_customer').serialize(),
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
                                        load_data_customer();
                                        $('#modal_customer').modal('hide');
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
                            url : '<?php echo base_url('admin/customer/edit_customer'); ?>',
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
                                        load_data_customer();
                                        $('#modal_customer').modal('hide');
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

    $(document).on('click', '.btn_hapus_customer', function(e) {
        var id_customer = $(this).attr("id_customer");
        var nama_customer = $(this).attr("nama_customer");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_customer + '"!',
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
                        url: '<?php echo base_url('admin/customer/hapus_customer'); ?>',
                        method: 'POST',
                        data: {id_customer : id_customer},                
                    })
                    .done(function(response) {
                        load_data_customer();
                        $('#modal_customer').modal('hide');
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