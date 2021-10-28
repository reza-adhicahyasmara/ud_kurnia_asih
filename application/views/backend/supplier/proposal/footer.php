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
    var url_proposal =  "<?php echo base_url('supplier/proposal'); ?>";
    var url = url_proposal ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">

    load_data_penawaran();
	function load_data_penawaran(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('supplier/proposal/load_data_penawaran'); ?>',
			beforeSend : function(){
				$('#content_penawaran').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_penawaran').html(response);
			}
		});
    };

    load_data_permintaan();
	function load_data_permintaan(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('supplier/proposal/load_data_permintaan'); ?>',
			beforeSend : function(){
				$('#content_permintaan').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_permintaan').html(response);
			}
		});
    };

    $('#btn_tambah_proposal').on("click",function(){
        var url = "<?php echo base_url('supplier/proposal/form_tambah_proposal'); ?>";

        $('#modal_proposal').modal('show');
        $('.modal-title').text('Tambah Penawaran');
        $('.modal-body').load(url);
    });

    $(document).ready(function() {
        $('#btn_simpan_proposal').on("click",function(){
            $('#form_proposal').validate({
                rules: {
                    judul_proposal: {
                        required: true,
                    },
                    berkas_proposal: {
                        required: true,
                    },
                },
                messages: {
                    judul_proposal: {
                        required: "Nama harus diisi",
                    },
                    berkas_proposal: {
                        required: "Berkas harus diisi",
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
                            url : '<?php echo base_url('supplier/proposal/tambah_proposal'); ?>',
                            method: 'POST',
                            data : $('#form_proposal').serialize(),
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
                                        load_data_penawaran();
                                        $('#modal_proposal').modal('hide');
                                    });
                                } else {
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
                }
            });
        });
    });

    $(document).on('click', '.btn_hapus_proposal', function(e) {
        var kode_proposal=$(this).attr("kode_proposal");
        var judul_proposal=$(this).attr("judul_proposal");
        var berkas_proposal=$(this).attr("berkas_proposal");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + judul_proposal + '"!',
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
                        url: '<?php echo base_url('supplier/proposal/hapus_proposal'); ?>',
                        method: 'POST',
                        data: {
                            kode_proposal:kode_proposal,
                            berkas_proposal:berkas_proposal
                        },                
                    })
                    .done(function(response) {
                        load_data_penawaran();
                        Swal.fire('Berhasil!', 'Data telah dihapus.', 'success')
                    })
                    .fail(function() {
                        Swal.fire('Oops...', 'Terjadi kesahan!', 'error')
                    });
                });
            },
        });
    });  
</script>

</body>
</html>