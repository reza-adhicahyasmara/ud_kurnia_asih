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
                if($row->id_supplier == $this->session->userdata('ses_id_supplier') && $row->status_penawaran_bb == "Penawaran" && $row->kode_proposal == ""){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $haha += $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_satuan;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bb, 0, ".", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_limit_pab_bb,2, ",", ".");?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_bahan_baku' nama_bb="<?php echo $row->nama_bb; ?>" kode_bb="<?php echo $row->kode_bb; ?>" style="margin:3px"><span class="bx bx-fw bx-trash"></span></a>
            </td>
        </tr>
        <?php
                    $no++;
                }
            } 
        ?>
    </tbody>
</table>

<?php if($haha != 0){?>
    <div class="panel-footer" alignment="right">
        <button type="button" id="btn_simpan_proposal" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
    </div>
<?php } ?>

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
    $(document).ready(function() {  
        $('#btn_simpan_proposal').on("click",function(){
         var judul_proposal = $('#judul_proposal').val();
         var berkas_proposal = $('#berkas_proposal').val();
            
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
                            title: response,
                            showConfirmButton: true,
                            confirmButtonColor: '#6f42c1',
                            timer: 3000
                        })
                    }
                }
            }); 
        });
    });
</Script>