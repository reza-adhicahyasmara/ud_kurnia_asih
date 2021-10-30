<table style="width:100%" id="dataTablePenyesuaianStokBB" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Keluar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Keterangan</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($produk_masuk->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_produk_masuk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk_masuk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->jumlah_produk_masuk,0,",",".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_produk_masuk;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_produk_masuk'
                kode_produk_masuk="<?php echo $row->kode_produk_masuk; ?>" 
                nama_produk="<?php echo $row->nama_produk; ?>" 
                jumlah_produk_masuk="<?php echo $row->jumlah_produk_masuk; ?>"
                kode_produk="<?php echo $row->kode_produk; ?>"
                stok_gudang_produk="<?php echo $row->stok_gudang_produk; ?>"
                ><span class="bx bx-fw bx-trash"></span></a>
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
        $("#dataTablePenyesuaianStokBB").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>