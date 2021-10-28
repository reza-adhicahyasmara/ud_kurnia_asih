<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-bank"></span>Data Bank</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Data Bank</span>
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
                            <a class="nav-link active" id="custom-tabs-four-pabrik-tab" data-toggle="pill" href="#custom-tabs-four-pabrik" role="tab" aria-controls="custom-tabs-four-pabrik" aria-selected="true">Rekening Pabrik<a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-bank-tab" data-toggle="pill" href="#custom-tabs-four-bank" role="tab" aria-controls="custom-tabs-four-bank" aria-selected="false">Daftar Bank</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-pabrik" role="tabpanel" aria-labelledby="custom-tabs-four-pabrik-tab">    
                            <div class="float-right">
                                <button type="button" class="btn bg-purple" id="btn_tambah_rekening"><span class="bx bx-fw bx-plus"></span> Tambah Data </a>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div id="content_rekening">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-bank" role="tabpanel" aria-labelledby="custom-tabs-four-bank-tab">
                            <div class="mb-3 float-right">
                                <button type="button" class="btn bg-purple" id="btn_tambah_bank"><span class="bx bx-fw bx-plus"></span> Tambah Data </a>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div id="content_bank">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_rekening" method="post">
    <div id="modal_rekening" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                    <button type="submit" id="btn_simpan_rekening" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form role="form" id="form_bank" method="post">
    <div id="modal_bank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                    <button type="submit" id="btn_simpan_bank" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>


