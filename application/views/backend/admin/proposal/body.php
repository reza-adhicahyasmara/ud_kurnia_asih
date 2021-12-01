<?php 
    $proposal = 0;
    foreach($this->Mod_proposal->get_all_proposal_supplier()->result() as $row) {
        if($row->status_proposal == 1){
            $proposal += 1;
        }
    }
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-book-open"></span>Data Proposal</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Data Proposal</span>
                    </ol>
                </div>  
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-purple card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-proposal-tab" data-toggle="pill" href="#custom-tabs-four-proposal" role="tab" aria-controls="custom-tabs-four-proposal" aria-selected="true">Penawaran Supplier <?php if($proposal != 0){ ?><span class="badge badge-danger right"> <?php echo $proposal; ?></span><?php } ?><a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-permintaan-tab" data-toggle="pill" href="#custom-tabs-four-permintaan" role="tab" aria-controls="custom-tabs-four-permintaan" aria-selected="false">Permintaan Pabrik</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-proposal" role="tabpanel" aria-labelledby="custom-tabs-four-proposal-tab">
                            <div id="content_penawaran">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-permintaan" role="tabpanel" aria-labelledby="custom-tabs-four-permintaan-tab">
                            <div class="mb-3 float-right">
                                <button type="button" class="btn bg-purple" id="btn_tambah_permintaan"><span class="bx bx-fw bx-plus"></span> Tambah Data </a>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div id="content_permintaan">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_permintaan" method="post">
    <div id="modal_permintaan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_simpan_permintaan" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div id="modal_bahan_baku" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                <button type="button" id="btn_update_penawaran" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_view_pdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <!-- FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Tutup</button>
            </div>
        </div>
    </div>
</div>


