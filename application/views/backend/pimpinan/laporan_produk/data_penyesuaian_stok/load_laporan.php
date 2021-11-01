<div style="text-align: center">
    <h3><strong> CV Mustika Flamboyan</strong></h3>
    <span>JL. Raya Siliwangi, No. 193, Ciawigebang, Cigintung, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45517</span>
    </br>
    <span>(0232) 878333</span>
    <hr>
    <strong>Laporan Data Penyesuaian Stok Produk</strong>     
    </br>
    <span><?php echo $tanggal_awal." - ".$tanggal_akhir; ?></span>
</div>
</br>
<table style="width:100%" id="tableMasuk" class="table table-bordered">
<caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle;">No.</th>
            <th id="" style="text-align: center; vertical-align: middle;">Tanggal Keluar </th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode Keluar </th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode Produk </th>
            <th id="" style="text-align: center; vertical-align: middle;">Nama Produk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle;">Harga Per Item (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle;">Jumlah Item</th>
            <th id="" style="text-align: center; vertical-align: middle;">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($data->result() as $row) {
        ?>
        <tr>
            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo date('d-m-Y h:m', strtotime($row->tanggal_penyesuaian_stok_produk));?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->kode_penyesuaian_stok_produk;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_produk, 2, ',', '.');?></td>
            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row->jumlah_penyesuaian_stok_produk, 0, '.', '.');?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_penyesuaian_stok_produk;?></td>
        </tr>
        <?php 
            $no++; 
            } 
        ?>
    </tbody>
</table>
