<table style="width:100%" id="dataTablePenyesuaianStokBB" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Tanggal</th>
            <th id="" style="text-align: center; vertical-align: middle; width:20%">Nama Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; width:50%">Keterangan</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($penyesuaian_produk->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->gambar_penyesuaian_produk != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/produk/'.$row->gambar_penyesuaian_produk);?>" alt="Image" class="img-circle elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                        </div>
                    </div>
                <?php } ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_penyesuaian_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->jumlah_penyesuaian_produk,2,",",".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_penyesuaian_produk;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_penyesuaian_produk'
                kode_penyesuaian_produk="<?php echo $row->kode_penyesuaian_produk; ?>" 
                nama_produk="<?php echo $row->nama_produk; ?>" 
                jumlah_penyesuaian_produk="<?php echo $row->jumlah_penyesuaian_produk; ?>"
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