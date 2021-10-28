<table style="width:100%" id="dataTable" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; width:17%">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Stok Gudang</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Stok Limit</th>
            <th id="" style="text-align: center; vertical-align: middle; width:5%">Status</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($bahan_baku->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bahan_baku;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bahan_baku;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bahan_baku, 0, ".", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_gudang_bahan_baku,2,",",".")." ".$row->nama_satuan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_limit_bahan_baku,2, ",", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php 
                    if($row->stok_gudang_bahan_baku <= $row->stok_limit_bahan_baku){
                        echo "<span class='badge rounded-pill bg-danger text-sm'>Limit</span>";
                    }elseif($row->stok_gudang_bahan_baku > $row->stok_limit_bahan_baku){
                        echo "<span class='badge rounded-pill bg-success text-sm'>Aman</span>";
                    }
                ?>
            </td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-outline-info btn-sm btn-rounded btn_edit' href="<?php echo base_url('admin/bahan_baku/form_edit_bahan_baku/').$row->kode_bahan_baku; ?>" ><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-outline-danger btn-sm btn-rounded btn_hapus_bahan_baku' nama_bahan_baku="<?php echo $row->nama_bahan_baku; ?>" kode_bahan_baku="<?php echo $row->kode_bahan_baku; ?>"><span class="bx bx-fw bx-trash"></span></a>
            </td>
        </tr>
        <?php
            $no++;
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