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
    var url_outlet =  "<?php echo base_url('admin/pemesanan_bahan_baku'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

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

<script type="text/javascript">
    load_data_item_pemesanan_bb();
    function load_data_item_pemesanan_bb(){
        var kode_pemesanan_bb = "<?php echo $this->uri->segment(4); ?>";
        var total_pby_pemesanan_bb = $('#total_pby_pemesanan_bb').val();

        $.ajax({
            method : "POST",
            url : '<?php echo base_url('admin/pemesanan_bahan_baku/load_data_item_pemesanan_bb');?>',
            data : {
                kode_pemesanan_bb:kode_pemesanan_bb,
                total_pby_pemesanan_bb:total_pby_pemesanan_bb
            },
            beforeSend : function(){
                $('#content_item_pemesanan_bb').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_item_pemesanan_bb').html(response);
            }
        });
    };
</script>

<!-----------------------TRANSAKSI PEMBAYARAN----------------------->
<script type="text/javascript">
    $('#btn_upload').on("click",function(){
        $('#modal_upload').modal('show');
        $('.modal-title').text('Upload Bukti Pembayaran');
    });

    $('#btn_bukti_pembayaran').on("click",function(){
        $('#modal_bukti_pembayaran').modal('show');
        $('.modal-title').text('Bukti Pembayaran');
    });

    $(document).ready(function() {
        $('#simpan_upload').on("click",function(){
            $.ajax({
                url : '<?php echo base_url('admin/pemesanan_bahan_baku/update_pemesanan_bb'); ?>',
                method: 'POST',
                data : $('#form_upload').serialize(),
                success: function(response){
                    if(response==1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data telah diupdate',
                            showConfirmButton: true,
                            confirmButtonColor: '#6f42c1',
                            timer: 3000
                        }).then(function(){
                            window.location.reload();
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
        });
    });

</script>

<script>
    //Oploadna ditembak
    Dropzone.autoDiscover = false;
    var url_save = "<?php echo base_url('admin/pemesanan_bahan_baku/save_image'); ?>";
    var url_delete = "<?php echo base_url('admin/pemesanan_bahan_baku/delete_image'); ?>";
    var bukti_pembayaran1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#bukti_pby_pemesanan_bb').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#bukti_pby_pemesanan_bb').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#bukti_pby_pemesanan_bb').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {bukti_pby_pemesanan_bb:foto},
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
    bukti_pembayaran1.on("removedfile",function(){
        var bukti_pby_pemesanan_bb = $('#bukti_pby_pemesanan_bb').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {bukti_pby_pemesanan_bb:bukti_pby_pemesanan_bb},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#bukti_pby_pemesanan_bb").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar').on("click",function(){
        var bukti_pby_pemesanan_bb = $('#bukti_pby_pemesanan_bb').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {bukti_pby_pemesanan_bb:bukti_pby_pemesanan_bb},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#bukti_pby_pemesanan_bb").val("");
                    $("img#assets").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks").hide(500); 
                }
            }
        });
    });
</script>

</body>
</html>