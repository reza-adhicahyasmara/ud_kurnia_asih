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
    var url_outlet =  "<?php echo base_url('gudang/pemesanan_produk'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $("#jumlah_item_pemesanan_produk").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
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

<script type="text/javascript">
    load_data_item_pemesanan_produk();
    function load_data_item_pemesanan_produk(){
        var kode_pemesanan_produk = "<?php echo $this->uri->segment(4); ?>";
        var total_pby_pemesanan_produk = $('#total_pby_pemesanan_produk').val();
        var status_pemesanan_produk = $('#status_pemesanan_produk').val();

        $.ajax({
            method : "POST",
            url : '<?php echo base_url('gudang/pemesanan_produk/load_data_item_pemesanan_produk');?>',
            data : {
                kode_pemesanan_produk:kode_pemesanan_produk,
                total_pby_pemesanan_produk:total_pby_pemesanan_produk,
                status_pemesanan_produk:status_pemesanan_produk
            },
            beforeSend : function(){
                $('#content_item_pemesanan_produk').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_item_pemesanan_produk').html(response);
            }
        });
    };
</script>

<!-----------------------KONFIRMASI PEMBAYARAN----------------------->
<script>
    $('#btn_bukti_pembayaran').on("click",function(){
        $('#modal_bukti_pembayaran').modal('show');
        $('.modal-title').text('Bukti Pembayaran');
    });

    var url_global = '<?php echo base_url('gudang/pemesanan_produk/update_pemesanan_produk'); ?>';
    
    $('#btn_verifikasi_pembayaran').on("click",function(){
        var kode_pemesanan_produk = $('#kode_pemesanan_produk').val();
        var status_pemesanan_produk = "3";
        var status_pby_pemesanan_produk = "3";

        Swal.fire({
            title: 'Verifikasi Pembayaran',
            text: 'Apakah anda yakin memverifikasi pembayaran ini',
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
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pemesanan_produk:kode_pemesanan_produk,
                        status_pemesanan_produk:status_pemesanan_produk,
                        status_pby_pemesanan_produk:status_pby_pemesanan_produk
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
                        }     
                    }
                })
            },
        });
    });

    $('#btn_pembatalan_pembayaran').on("click",function(){
        var kode_pemesanan_produk = $('#kode_pemesanan_produk').val();
        var status_pemesanan_produk = "6";
        var status_pby_pemesanan_produk = "4";

        Swal.fire({
            title: 'Verifikasi Pembayaran',
            text: 'Apakah anda yakin memverifikasi pembayaran ini',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            html: `<textarea type="text" id="keterangan_batal_pemesanan_produk" class="swal2-input" placeholder="Keterangan" style="height:100px"></textarea>`,

            preConfirm: (response) => {                 
                const keterangan_batal_pemesanan_produk = Swal.getPopup().querySelector('#keterangan_batal_pemesanan_produk').value
                if(response==1){
                    if (!keterangan_batal_pemesanan_produk) {
                        Swal.showValidationMessage('Keterangan tidak boleh kosong')
                    }else{
                        $.ajax({
                            url: url_global,
                            method: 'POST',
                            data: {
                                kode_pemesanan_produk:kode_pemesanan_produk,
                                keterangan_batal_pemesanan_produk:keterangan_batal_pemesanan_produk,
                                status_pemesanan_produk:status_pemesanan_produk,
                                status_pby_pemesanan_produk:status_pby_pemesanan_produk
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
                                }     
                            }
                        })
                    }
                }
            }
        })
    });
</script>


<!-----------------------KONFIRMASI PENGIRIMAN----------------------->
<script>
    $('#btn_pengiriman').on("click",function(){
        var kode_pemesanan_produk = $('#kode_pemesanan_produk').val();
        var status_pemesanan_produk = "4";
        var status_pby_pemesanan_produk = "3";

        Swal.fire({
            title: 'Verifikasi Pengiriman',
            text: 'Pastikan pengiriman sesuai dengan pemesanan',
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
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pemesanan_produk:kode_pemesanan_produk,
                        status_pemesanan_produk:status_pemesanan_produk,
                        status_pby_pemesanan_produk:status_pby_pemesanan_produk
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
                                icon: 'warning',
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


<!-----------------------KONFIRMASI PENGIRIMAN----------------------->
<script>
    $('#btn_pengiriman_retur').on("click",function(){
        var kode_pemesanan_produk = $('#kode_pemesanan_produk').val();
        var status_pemesanan_produk = "7";

        Swal.fire({
            title: 'Verifikasi Pengiriman',
            text: 'Pastikan pengiriman sesuai dengan item yang telah diretur',
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
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pemesanan_produk:kode_pemesanan_produk,
                        status_pemesanan_produk:status_pemesanan_produk
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
                                icon: 'warning',
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
    

<!-----------------------KONFIRMASI PEMBATALAN PEMESANAN----------------------->
<script>
    $('#btn_pembatalan_pemesanan').on("click",function(){
        var kode_pemesanan_produk = $('#kode_pemesanan_produk').val();
        var status_pemesanan_produk = "6";
        var status_pby_pemesanan_produk = "1";

        Swal.fire({
            title: 'Verifikasi Pembayaran',
            text: 'Apakah anda yakin memverifikasi pembayaran ini',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            html: `<textarea type="text" id="keterangan_batal_pemesanan_produk" class="swal2-input" placeholder="Keterangan" style="height:100px"></textarea>`,

            preConfirm: (response) => {                 
                const keterangan_batal_pemesanan_produk = Swal.getPopup().querySelector('#keterangan_batal_pemesanan_produk').value
                if(response==1){
                    if (!keterangan_batal_pemesanan_produk) {
                        Swal.showValidationMessage('Keterangan tidak boleh kosong')
                    }else{
                        $.ajax({
                            url: url_global,
                            method: 'POST',
                            data: {
                                kode_pemesanan_produk:kode_pemesanan_produk,
                                keterangan_batal_pemesanan_produk:keterangan_batal_pemesanan_produk,
                                status_pemesanan_produk:status_pemesanan_produk,
                                status_pby_pemesanan_produk:status_pby_pemesanan_produk
                            },   
                            success: function(response){ 
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data telah diupdate!',
                                        showConfirmButton: true,
                                        timer: 3000
                                    }).then(function(){
                                        window.location.reload();
                                    })
                                }     
                            }
                        })
                    }
                }
            }
        })
    });

</script>

</body>
</html>