<table style="width:100%" id="dataTableBahanBaku" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Pemesanan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal Masuk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal Kadaluwarsa</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Bahan Baku</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Stok Masuk</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($bahan_baku_masuk->result() as $row) {
                if($row->status_ipemesanan_bb == 6){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><a href="<?php echo base_url("admin/pemesanan_bahan_baku/detail/").$row->kode_pemesanan_bb;?>"><?php echo $row->kode_pemesanan_bb; ?></a></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_masuk_ipemesanan_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_kadaluwarsa_ipemesanan_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->jumlah_ipemesanan_bb, 2, ".", ".")." ".$row->nama_satuan;?></td>
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
        $("#dataTableBahanBaku").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>