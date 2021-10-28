<table style="width:100%" id="dataTableSatuan" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:87%">Nama Satuan</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($satuan->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_satuan;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-outline-info btn-sm btn-rounded btn_edit_satuan' kode_satuan="<?php echo $row->kode_satuan; ?>"><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-outline-danger btn-sm btn-rounded btn_hapus_satuan' nama_satuan="<?php echo $row->nama_satuan; ?>" kode_satuan="<?php echo $row->kode_satuan; ?>"><span class="bx bx-fw bx-trash"></span></a>
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
        $("#dataTableSatuan").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>