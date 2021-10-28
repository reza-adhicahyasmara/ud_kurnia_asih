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
    var url_bahan_baku =  "<?php echo base_url('admin/bahan_baku'); ?>";
    var url = url_bahan_baku ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_bahan_baku();
	function load_data_bahan_baku(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/bahan_baku/load_data_bahan_baku'); ?>',
			beforeSend : function(){
				$('#content_bahan_baku').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
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
        var kode_bahan_baku=$(this).attr("kode_bahan_baku");
        var url = "<?php echo base_url('admin/bahan_baku/form_edit_bahan_baku'); ?>";

        $('#modal_bahan_baku').modal('show');
        $('.modal-title').text('Edit Bahan Baku');
        $('.modal-body').load(url,{kode_bahan_baku : kode_bahan_baku});
    });  

    $(document).ready(function() {
        $('#btn_simpan_bahan_baku').on("click",function(){
            $('#form_bahan_baku').validate({
                rules: {
                    kode_bahan_baku_baru: {
                        required: true,
                    },
                    nama_bahan_baku_baru: {
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
                    stok_limit_bahan_baku: {
                        required: true,
                    },
                },
                messages: {
                    kode_bahan_baku_baru: {
                        required: "Kode harus diisi",
                    },
                    nama_bahan_baku_baru: {
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
                    stok_limit_bahan_baku: {
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
                                        $('#modal_bahan_bakus').modal('hide');
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
        var kode_bahan_baku = $(this).attr("kode_bahan_baku");
        var nama_bahan_baku = $(this).attr("nama_bahan_baku");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_bahan_baku + '"!',
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
                        data: {kode_bahan_baku : kode_bahan_baku},                
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

</body>
</html>