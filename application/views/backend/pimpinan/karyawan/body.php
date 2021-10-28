
 <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-user"></span> Karyawan</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('pimpinan/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Karyawan</span>
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
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Admin<a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-gudang-tab" data-toggle="pill" href="#custom-tabs-four-gudang" role="tab" aria-controls="custom-tabs-four-gudang" aria-selected="false">Gudang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-pimpinan-tab" data-toggle="pill" href="#custom-tabs-four-pimpinan" role="tab" aria-controls="custom-tabs-four-pimpinan" aria-selected="false">Pimpinan</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="float-right">
                        <a type="button" class="btn bg-purple"  id="btn_tambah_karyawan"><span class="bx bx-fw bx-plus"></span> Tambah Data</a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <div id="content_admin">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-gudang" role="tabpanel" aria-labelledby="custom-tabs-four-gudang-tab">
                            <div id="content_gudang">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-pimpinan" role="tabpanel" aria-labelledby="custom-tabs-four-pimpinan-tab">
                            <div id="content_pimpinan">
                                <!--LOAD DATA-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_karyawan" method="post">
    <div id="modal_karyawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                    <button type="submit" id="btn_simpan_karyawan" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
