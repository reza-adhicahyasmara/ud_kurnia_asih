<table style="width:100%" id="dataTablePermintaan" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Proposal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berkas</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($permintaan->result() as $row) {
                if($row->id_supplier == ""){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_proposal; ?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->judul_proposal;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->berkas_proposal;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded view_pdf_permintaan' berkas_proposal="<?php echo $row->berkas_proposal; ?>" kode_proposal="<?php echo $row->kode_proposal; ?>"><span class="bx bx-fw bxs-file-pdf"></span></a>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_permintaan' judul_proposal="<?php echo $row->judul_proposal; ?>" kode_proposal="<?php echo $row->kode_proposal; ?>" berkas_proposal="<?php echo $row->berkas_proposal; ?>"><span class="bx bx-fw bx-trash"></span></a>
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
        $("#dataTablePermintaan").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
    
    $('.view_pdf_proposal').on("click",function(){ 
        var berkas_proposal = $(this).attr("berkas_proposal");
        var url = '<?php echo base_url('admin/proposal/view_pdf_proposal'); ?>';

        $('#modal_view_pdf').modal('show');
        $('.modal-title').text('PDF');
        $('.modal-body').load(url, {berkas_proposal:berkas_proposal});
    });

</script>