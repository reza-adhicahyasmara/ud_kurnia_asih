<table style="width:100%" id="dataTable" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($bahan_baku->result() as $row) {
                if($row->id_supplier == $this->session->userdata('ses_id_supplier') && $row->status_penawaran_bb == "Diterima" && $row->kode_proposal == ""){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bb,2, ",", ".");?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_gudang_sup_bb,2, ",", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_limit_sup_bb,2, ",", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php 
                    if($row->stok_gudang_sup_bb <= $row->stok_limit_sup_bb){
                        echo "<span class='badge rounded-pill bg-danger text-sm'>Limit</span>";
                    }elseif($row->stok_gudang_sup_bb > $row->stok_limit_sup_bb){
                        echo "<span class='badge rounded-pill bg-success text-sm'>Aman</span>";
                    }
                ?>
            </td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_bahan_baku' kode_bb="<?php echo $row->kode_bb; ?>"><span class="bx bx-fw bx-pencil"></span></a>
            </td>
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