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
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($bahan_baku->result() as $row) {
                if($row->status_penawaran_bb == "Diterima"){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bb, 0, ".", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_gudang_pab_bb,2,",",".")." ".$row->nama_satuan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_limit_pab_bb,2, ",", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php 
                    if($row->stok_gudang_pab_bb <= $row->stok_limit_pab_bb){
                        echo "<span class='badge rounded-pill bg-danger text-sm'>Limit</span>";
                    }elseif($row->stok_gudang_pab_bb > $row->stok_limit_pab_bb){
                        echo "<span class='badge rounded-pill bg-success text-sm'>Aman</span>";
                    }
                ?>
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