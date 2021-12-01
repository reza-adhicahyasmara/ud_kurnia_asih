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
<!-- page script -->

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_outlet =  "<?php echo base_url('gudang/retur_bahan_baku'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $("#jumlah_iretur_bb").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $(document).ready(function() {
        $('.id_supplier').select2({
            theme: 'bootstrap4',
        })
    });

    $(document).ready(function() {
        $('.kode_bb').select2({
            theme: 'bootstrap4',
        })
    });

    $(function () {
        $("#dataTable1").DataTable({
        "responsive": true,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable2").DataTable({
        "responsive": true,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable3").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable4").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable5").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable6").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable7").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable8").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable9").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });
</script>


<!-----------------------PENGAJUAN RETUR----------------------->
<script type="text/javascript">
    $(document).ready(function(){
        $("#id_supplier").change(function() {
            var id_supplier = $(this).val();
            $.ajax({
                url : '<?php echo base_url('gudang/retur_bahan_baku/select_bahan_baku_supplier'); ?>',
                method: 'POST',
                data: {id_supplier:id_supplier},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        if(data[i].status_penawaran_bb == 'Diterima'){ 
                            html += '<option value='+data[i].kode_bb+'>'+data[i].kode_bb+' - '+data[i].nama_bb+' ('+data[i].nama_satuan+')'+'</option>';
                        }
                    }
                    $('#kode_bb').html(html);
                }
            });     
        });    
    });

    load_data_item_retur_bb();
	function load_data_item_retur_bb(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('gudang/retur_bahan_baku/load_data_item_retur_bb'); ?>',
			beforeSend : function(){
				$('#content_item_retur_bb').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_item_retur_bb').html(response);
			}
		});
    };

    function empty_data_form(){  
        $("#kode_bb").val("");
        $("#jumlah_iretur_bb").val("");
        $("#keterangan_iretur_bb").val("");
        $("#gambar_iretur_bb").val("");
        $("label#label_gambar").text("");
    }

    $("#btn_tambah_item_retur_bb").click(function(){
       
        $.ajax({
            url : '<?php echo base_url('gudang/retur_bahan_baku/insert_item_retur_bb'); ?>',
            method : 'POST',
            data: $('#form_item_retur_bb').serialize(),
            success: function(response){
                if(response==1){            
                    load_data_item_retur_bb();
                    empty_data_form();
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
        })
    })

    $('body').on('click', '.btn_hapus_item_retur_bb', function(){
        var kode_iretur_bb = $(this).attr('kode_iretur_bb');
        var gambar_iretur_bb = $(this).attr('gambar_iretur_bb');
        var kode_bb = $(this).attr('kode_bb');
        var stok_gudang_pab_bb = $(this).attr('stok_gudang_pab_bb');
        var jumlah_iretur_bb = $(this).attr('jumlah_iretur_bb');

        $.ajax({
            url : '<?php echo base_url('gudang/retur_bahan_baku/delete_item_retur_bb'); ?>', 
            method : 'POST',
            data: {
                kode_iretur_bb:kode_iretur_bb,
                gambar_iretur_bb:gambar_iretur_bb,
                kode_bb:kode_bb,
                stok_gudang_pab_bb:stok_gudang_pab_bb,
                jumlah_iretur_bb:jumlah_iretur_bb
            },
            cache:false,
            success:function(hasil){
                load_data_item_retur_bb();
                empty_data_form();
            }
        })   
    }); 

</script>


<!-----------------------RETUR DITERIMA----------------------->
<script>
    $(document).on('click', '#btn_retur_diterima', function(e) {
        var kode_retur_bb = $(this).attr("kode_retur_bb");
        var status_retur_bb = 3;

        Swal.fire({
            title: 'Verifikasi Pengajuan Retur',
            text: 'Pastikan bahan baku diperiksa dengan benar',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: '<?php echo base_url('gudang/retur_bahan_baku/update_retur_bb');?>',
                    method: 'POST',
                    data: {
                        kode_retur_bb:kode_retur_bb,
                        status_retur_bb:status_retur_bb,
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#6f42c1',
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#6f42c1',
                                timer: 3000
                            })
                        }    
                    }
                })
            },
        });
    });
</script>

<script>
    //Oploadna ditembak
    var url_save = "<?php echo base_url('gudang/retur_bahan_baku/save_image'); ?>";
    var url_delete = "<?php echo base_url('gudang/retur_bahan_baku/delete_image'); ?>";
    var gambar_iretur_bb1 = new Dropzone(".drop_retur",{ 
        url: url_save,
        autoDiscover : false,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#gambar_iretur_bb').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#gambar_iretur_bb').val(response);
                    $('label#label_gambar').text(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#gambar_iretur_bb').val(response);
                    $('label#label_gambar').text(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {gambar_iretur_bb:foto},
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
    gambar_iretur_bb1.on("removedfile",function(){
        var gambar_iretur_bb = $('#gambar_iretur_bb').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {gambar_iretur_bb:gambar_iretur_bb},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#gambar_iretur_bb").val("");
                    $("label#label_gambar").text("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_karyawan').on("click",function(){
        var gambar_iretur_bb = $('#gambar_iretur_bb').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {gambar_iretur_bb:gambar_iretur_bb},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#gambar_iretur_bb").val("");
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