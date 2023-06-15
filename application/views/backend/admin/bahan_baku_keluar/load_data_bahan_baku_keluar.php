<table style="width:100%" id="dataTablePenyesuaianStokBB" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Keluar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Bahan Baku</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Bahan Baku</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($bahan_baku_keluar->result() as $row) {
                if($row->status_penawaran_bb == "Diterima"){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_bb_keluar;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb_keluar;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->jumlah_bb_keluar,2,",",".")." ".$row->nama_satuan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_bb_keluar;?></td>
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
        $("#dataTablePenyesuaianStokBB").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>