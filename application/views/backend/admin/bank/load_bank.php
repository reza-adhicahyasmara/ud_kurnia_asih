<table style="width:100%" id="dataTableBank" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:37%">Kode Bank</th>
            <th id="" style="text-align: center; vertical-align: middle; width:50%">Nama Bank</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($bank->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bank;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bank;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-outline-info btn-sm btn-rounded btn_edit_bank' kode_bank="<?php echo $row->kode_bank; ?>"><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-outline-danger btn-sm btn-rounded btn_hapus_bank' nama_bank="<?php echo $row->nama_bank; ?>" kode_bank="<?php echo $row->kode_bank; ?>"><span class="bx bx-fw bx-trash"></span></a>
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
        $("#dataTableBank").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>