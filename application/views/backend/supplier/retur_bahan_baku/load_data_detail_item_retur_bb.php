<table style="width:100%" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Bahan Baku</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; width:25%">Keterangan Retur</th>
            <th id="" style="text-align: center; vertical-align: middle; width:25%">Status</th>
            <?php if($status_retur_bb == 1){ ?>
                <th id="" style="text-align: center; vertical-align: middle; width:7%">Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($list_bahan_baku->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->gambar_iretur_bb != "") { ?>
                    <img style="margin:-5px;" class="img-thumbnail" alt="Image" src="<?php echo base_url('assets/img/retur_bb/'.$row->gambar_iretur_bb);?>" width="100px" height="100px">
                <?php }else{ ?>
                    <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" width="100px" height="100px">
                <?php } ?> 
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->jumlah_iretur_bb, 0, ".", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_iretur_bb;?></td>
            <td style="text-align: left; vertical-align: middle;">  
                <?php 
                    $status = $row->status_iretur_bb;
                    if($status == 2){
                        echo "Proses";
                    }else if($status == 3){
                        echo "Diterima";
                    }else if($status == 4){
                        echo "Ditolak<br>"."Keterangan : ".$row->keterangan_batal_iretur_bb;
                    }
                ?>                     
            </td>
            <?php if($status_retur_bb == 1){ ?>
            <td style="text-align: center; vertical-align: middle;">  
                    <a class='btn btn-success btn-sm btn-rounded btn_edit_item_bb_terima' kode_iretur_bb="<?php echo $row->kode_iretur_bb; ?>"><span class="bx bx-fw bx-check"></span></a>
                    <a class='btn btn-danger btn-sm btn-rounded btn_edit_item_bb_retur' kode_iretur_bb="<?php echo $row->kode_iretur_bb; ?>"><span class="bx bx-fw bx-x"></span></a>
            </td>
            <?php } ?>
        </tr>
            <?php $no++; } ?>
    </tbody>
</table>


<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script>
    $('.btn_edit_item_bb_terima').on("click",function(){
        var kode_iretur_bb = $(this).attr("kode_iretur_bb");
        var keterangan_batal_iretur_bb = "";
        var status_iretur_bb = "3";

        Swal.fire({
            title: 'Verifikasi Retur Diterima',
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
                    url: '<?php echo base_url('supplier/retur_bahan_baku/update_item_retur'); ?>',
                    method: 'POST',
                    data: {
                        kode_iretur_bb:kode_iretur_bb,
                        keterangan_batal_iretur_bb:keterangan_batal_iretur_bb,
                        status_iretur_bb:status_iretur_bb
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
                                load_data_detail_item_retur_bb();
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

    $('.btn_edit_item_bb_retur').on("click",function(){
        var kode_iretur_bb = $(this).attr("kode_iretur_bb");
        var status_iretur_bb = "4";

        Swal.fire({
            title: 'Verifikasi Retur Ditolak',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            onOpen: function() {

            },
            html:
                '<textarea id="keterangan_batal_iretur_bb" class="swal2-input" placeholder="Keterangan Retur" style="height: 200px"></textarea>',

            preConfirm: (response) => {                 
                const keterangan_batal_iretur_bb = Swal.getPopup().querySelector('#keterangan_batal_iretur_bb').value;
                
                if (!keterangan_batal_iretur_bb) {
                    Swal.showValidationMessage('Keterangan harus diisi');
                }else{
                    $.ajax({
                        url: '<?php echo base_url('supplier/retur_bahan_baku/update_item_retur'); ?>',
                        method: 'POST',
                        data: {
                            kode_iretur_bb:kode_iretur_bb,
                            keterangan_batal_iretur_bb:keterangan_batal_iretur_bb,
                            status_iretur_bb:status_iretur_bb
                        },   
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah diupdate',
                                    confirmButtonColor: '#6f42c1',
                                    showConfirmButton: true,
                                    timer: 3000
                                }).then(function(){
                                    load_data_detail_item_retur_bb();
                                });
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Peringatan',
                                    text: response,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                });
                            }
                        }
                    }) 
                }
            }
        });
    });
