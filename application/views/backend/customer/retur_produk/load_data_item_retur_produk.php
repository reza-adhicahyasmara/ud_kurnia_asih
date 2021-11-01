<table style="width:100%;" id="dataTable10" class="dataTable10 table table-bordered table-striped">
<caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; width:30%">Keterangan</th>
            <th id="" style="text-align: center; vertical-align: middle; width:7%">Aksi</th>
        </tr>
    </thead>
    <?php
        $total_item_retur_produk = 0;
        $no = 1;
        foreach($tmp->result() as $tmp){
            if($tmp->status_iretur_produk == 1 && $tmp->id_customer == $this->session->userdata('ses_id_customer')){
    ?>
    <tr>
        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
        <td style="text-align: center; vertical-align: middle;">
            <?php if($tmp->gambar_iretur_produk != "") { ?>
                <img style="margin:-5px;" class="img-thumbnail" alt="Image" src="<?php echo base_url('assets/img/retur_produk/'.$tmp->gambar_iretur_produk);?>" width="100px" height="100px">
            <?php }else{ ?>
                <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" width="100px" height="100px">
            <?php } ?> 
        </td>
        <td style="text-align: left; vertical-align: middle;"><?php echo $tmp->kode_produk;?></td>
        <td style="text-align: left; vertical-align: middle;"><?php echo $tmp->nama_produk;?></td>
        <td style="text-align: center; vertical-align: middle;"><?php echo $tmp->jumlah_iretur_produk." ".$tmp->nama_satuan;?></td>
        <td style="text-align: ledt; vertical-align: middle;"><?php echo $tmp->keterangan_iretur_produk;?></td>
        <td style="text-align: center; vertical-align: middle;">
            <a class='btn btn-danger btn-sm btn-rounded btn_hapus_item_retur_produk' kode_iretur_produk="<?php echo $tmp->kode_iretur_produk; ?>" gambar_iretur_produk="<?php echo $tmp->gambar_iretur_produk; ?>"><i class="bx bx-fw bx-trash"></i></a>
        </td>
    </tr>
    <?php          
                $total_item_retur_produk += $no;
                $no++;
            }
        }
    ?>
    <tr>
</table>

<?php if($total_item_retur_produk != 0){?>
    <div class="panel-footer" alignment="right"><button id="btn_simpan_retur" class="btn btn-primary"><i class="bx bx-fw bx-check"></i> Buat Pengajuan</button></div>
<?php } ?>

<!-- SweetAlert2 -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    $(document).on('click', '#btn_simpan_retur', function(e) {

        Swal.fire({
            title: 'Verifikasi Pengajuan',
            text: 'Apakah  produk sudah sesuai dengan yang diajukuan?',
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
                    url: '<?php echo base_url('customer/retur_produk/insert_retur_produk');?>',
                    method: 'POST',
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