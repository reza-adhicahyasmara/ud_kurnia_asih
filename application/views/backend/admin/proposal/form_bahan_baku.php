<input type="hidden" id="kode_proposal" value="<?php echo $kode_proposal;?>">

<table style="width:100%" id="dataTable" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Satuan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            $haha = 0;
            foreach($bahan_baku->result() as $row) {
                if($row->kode_proposal == $kode_proposal){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $haha += $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_satuan;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bb, 0, ".", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_limit_pab_bb,2, ",", ".");?></td>
            <?php if($row->status_proposal == "1" && $row->kode_proposal == $kode_proposal){?>
                <td style="text-align: center; vertical-align: middle;" >
                    <select class="form-control status_penawaran_bb" name="status_penawaran_bb" id="status_penawaran_bb">
                        <option value="<?php echo $row->kode_bb.'|Penawaran';?>" <?php if($row->status_penawaran_bb == "Penawaran"){echo "selected";} ?>>Penawaran</option>
                        <option value="<?php echo $row->kode_bb.'|Diterima';?>" <?php if($row->status_penawaran_bb == "Diterima"){echo "selected";} ?>>Diterima</option>
                        <option value="<?php echo $row->kode_bb.'|Ditolak';?>" <?php if($row->status_penawaran_bb == "Ditolak"){echo "selected";} ?>>Ditolak</option>
                    </select>
                </td>
            <?php } ?>
        </tr>
        <?php
                    $no++;
                }
            } 
        ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>

<!-----------------------PROPOSAL----------------------->
<Script type="text/javascript">
    $(".status_penawaran_bb").change(function(e) {
        var status_penawaran_bb = this.value;;
        console.log(status_penawaran_bb);
        $.ajax({
            url : '<?php echo base_url('admin/proposal/update_bahan_baku'); ?>',
            method: 'POST',
            data : {status_penawaran_bb:status_penawaran_bb},
        }); 
    });
</Script>




<!-----------------------UPDATE PROPOSAL----------------------->
<Script type="text/javascript">
    $(document).on('click', '#btn_update_penawaran', function(e) {
        var kode_proposal = $('#kode_proposal').val();
        Swal.fire({
            title: 'Pastikan penawaran bahan baku telah dikonfirmasi!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(response) {
                    $.ajax({
                        url: '<?php echo base_url('admin/proposal/update_penawaran'); ?>',
                        method: 'POST',
                        data: {
                            kode_proposal:kode_proposal
                        },   
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah update',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                }).then(function(){
                                    load_data_penawaran();
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
                    })
                   
                });
            },
        });
    }); 
</Script>