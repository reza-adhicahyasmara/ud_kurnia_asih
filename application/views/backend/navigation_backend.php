<?php 
    //NOTIF KARYAWAN
    $bb_limit = 0; 
    foreach($this->Mod_bahan_baku->get_all_bahan_baku()->result() as $row) {
        if($row->stok_gudang_pab_bb <= $row->stok_limit_pab_bb){
            $bb_limit += 1;
        }
    }

    $produk_limit = 0; 
    foreach($this->Mod_produk->get_all_produk()->result() as $row) {
        if($row->stok_gudang_produk <= $row->stok_limit_produk){
            $produk_limit += 1;
        }
    }

    $menuggu_pembayaran = 0;
    $menunggu_verifikasi = 0;
    $proses = 0;
    $dikirim = 0;
    $retur = 0;
    $total_pemesanan_bb = 0;
    foreach($this->Mod_bahan_baku->get_all_pemesanan_bb()->result() as $row) {
        if($row->status_pemesanan_bb == 1){
            $menuggu_pembayaran += 1;
        }
        elseif($row->status_pemesanan_bb == 2){
            $menunggu_verifikasi += 1;
        }
        elseif($row->status_pemesanan_bb == 3){
            $proses += 1;
        }
        elseif($row->status_pemesanan_bb == 4){
            $dikirim += 1;
        }
        elseif($row->status_pemesanan_bb == 7){
            $retur += 1;
        }
    }
    $total_pemesanan_bb = $menuggu_pembayaran + $menunggu_verifikasi + $proses + $dikirim + $retur;

    $menuggu_pembayaran_pro = 0;
    $menunggu_verifikasi_pro = 0;
    $proses_pro = 0;
    $dikirim_pro = 0;
    $retur_pro = 0;
    $total_pemesanan_pro = 0;
    foreach($this->Mod_produk->get_all_pemesanan_produk()->result() as $row) {
        if($row->status_pemesanan_produk == 1){
            $menuggu_pembayaran_pro += 1;
        }
        elseif($row->status_pemesanan_produk == 2){
            $menunggu_verifikasi_pro += 1;
        }
        elseif($row->status_pemesanan_produk == 3){
            $proses_pro += 1;
        }
        elseif($row->status_pemesanan_produk == 4){
            $dikirim_pro += 1;
        }
        elseif($row->status_pemesanan_produk == 7){
            $retur_pro += 1;
        }
    }
    $total_pemesanan_pro = $menuggu_pembayaran_pro + $menunggu_verifikasi_pro + $proses_pro + $dikirim_pro + $retur_pro;

    $menunggu_konfirmasi_retur_bb = 0;
    $retur_dikrim_bb = 0;
    $total_retur_bb;
    foreach($this->Mod_bahan_baku->get_all_retur_bb()->result() as $row) {
        if($row->status_retur_bb == 1){
            $menunggu_konfirmasi_retur_bb += 1;
        }
        elseif($row->status_retur_bb == 2){
            $retur_dikrim_bb += 1;
        }
    }
    $total_retur_bb = $menunggu_konfirmasi_retur_bb + $retur_dikrim_bb;

    $menunggu_konfirmasi_pro = 0;
    $retur_dikrim_pro = 0;
    $total_retur_pro = 0;
    foreach($this->Mod_produk->get_all_retur_produk()->result() as $row) {
        if($row->status_retur_produk == 1){
            $menunggu_konfirmasi_pro += 1;
        }
        elseif($row->status_retur_produk == 2){
            $retur_dikrim_pro += 1;
        }
    }
    $total_retur_pro = $menunggu_konfirmasi_pro + $retur_dikrim_pro;
    
    $proposal = 0;
    foreach($this->Mod_proposal->get_all_proposal_supplier()->result() as $row) {
        if($row->status_proposal == 1){
            $proposal += 1;
        }
    }


    $transaksi_bb_admin = 0;
    $transaksi_bb_admin = $total_pemesanan_bb + $total_retur_bb;

    $transaksi_pro_admin = 0;
    $transaksi_pro_admin = $total_pemesanan_pro + $total_retur_pro;

    $transaksi_bb_gudang = 0;
    $transaksi_bb_gudang = $total_pemesanan_bb + $total_retur_bb;

    $transaksi_pro_gudang = 0;
    $transaksi_pro_gudang = $total_pemesanan_pro + $total_retur_pro;

    $master_data = 0;
    $master_data = $bb_limit + $produk_limit;

    $total_notif_adm = 0;
    $total_notif_adm = $transaksi_bb_admin + $transaksi_pro_admin + $master_data + $proposal;

    $total_notif_gdg = 0;
    $total_notif_gdg = $transaksi_bb_gudang + $transaksi_pro_gudang + $bb_limit + $produk_limit;



    if($this->session->userdata('ses_akses') =='Supplier'){ 

        $id_supplier = $this->session->userdata('ses_id_supplier');
                
        $bb_limit_sup = 0; 
        foreach($this->Mod_bahan_baku->get_all_bahan_baku()->result() as $row) {
            if($row->id_supplier == $id_supplier){
                if($row->stok_gudang_sup_bb <= $row->stok_limit_sup_bb){
                    $bb_limit_sup += 1;
                }
            }
        }

        $menuggu_pembayaran_sup = 0;
        $menunggu_verifikasi_sup = 0;
        $proses_sup = 0;
        $dikirim_sup = 0;
        $retur_sup = 0;
        $total_pemesanan_sup = 0;
        foreach($this->Mod_bahan_baku->get_pemesanan_bb_supplier($id_supplier)->result() as $row) {
            if($row->status_pemesanan_bb == 1){
                $menuggu_pembayaran_sup += 1;
            }
            elseif($row->status_pemesanan_bb == 2){
                $menunggu_verifikasi_sup += 1;
            }
            elseif($row->status_pemesanan_bb == 3){
                $proses_sup += 1;
            }
            elseif($row->status_pemesanan_bb == 4){
                $dikirim_sup += 1;
            }
            elseif($row->status_pemesanan_bb == 7){
                $retur_sup += 1;
            }
        }
        $total_pemesanan_sup = $menuggu_pembayaran_sup + $menunggu_verifikasi_sup + $proses_sup + $dikirim_sup + $retur_sup; 

        $menunggu_konfirmasi_sup = 0;
        $retur_dikrim_sup = 0;
        $total_retur_sup = 0;
        foreach($this->Mod_bahan_baku->get_all_retur_bb()->result() as $row) {
            if($row->id_supplier == $id_supplier){
                if($row->status_retur_bb == 1){
                    $menunggu_konfirmasi_sup += 1;
                }
                elseif($row->status_retur_bb == 2){
                    $retur_dikrim_sup += 1;
                }
            }
        }
        $total_retur_sup = $menunggu_konfirmasi_sup + $retur_dikrim_sup;


        $proposal_sup = 0;
        foreach($this->Mod_proposal->get_all_proposal_supplier()->result() as $row) {
            if($row->tanggal_proposal <= date('Y-m-d', strtotime('+7 days', strtotime($row->tanggal_proposal)))  && $row->id == ""){
                $proposal_sup += 1;
            }
        }

        $total_notif_supp = 0;
        $total_notif_supp = $bb_limit_sup + $total_pemesanan_sup + $total_retur_sup + $proposal_sup;
    }elseif($this->session->userdata('ses_akses') =='Customer'){ 
        $id_customer = $this->session->userdata('ses_id_customer');

        $menuggu_pembayaran_cus = 0;
        $menunggu_verifikasi_cus = 0;
        $proses_cus = 0;
        $dikirim_cus = 0;
        $retur_cus = 0;
        $total_pemesanan_cus = 0;
        foreach($this->Mod_produk->get_pemesanan_produk_customer($id_customer)->result() as $row) {
            if($row->status_pemesanan_produk == 1){
                $menuggu_pembayaran_cus += 1;
            }
            elseif($row->status_pemesanan_produk == 2){
                $menunggu_verifikasi_cus += 1;
            }
            elseif($row->status_pemesanan_produk == 3){
                $proses_cus += 1;
            }
            elseif($row->status_pemesanan_produk == 4){
                $dikirim_cus += 1;
            }
            elseif($row->status_pemesanan_produk == 7){
                $retur_cus += 1;
            }
        }
        $total_pemesanan_cus = $menuggu_pembayaran_cus + $menunggu_verifikasi_cus + $proses_cus + $dikirim_cus + $retur_cus; 

        $menunggu_konfirmasi_cus = 0;
        $retur_dikrim_cus = 0;
        $total_retur_cus = 0;
        // foreach($this->Mod_produk->get_all_retur_produk()->result() as $row) {
        //     if($row->id_customer == $id_customer){
        //         if($row->status_retur_produk == 1){
        //             $menunggu_konfirmasi_cus += 1;
        //         }
        //         elseif($row->status_retur_produk == 2){
        //             $retur_dikrim_cus += 1;
        //         }
        //     }
        // }
        // $total_retur_cus = $menunggu_konfirmasi_cus + $retur_dikrim_cus;
    }

    $url_foto_karyawan = base_url('assets/img/karyawan/'.$this->session->userdata('ses_foto_karyawan'));
    $url_foto_supplier = base_url('assets/img/supplier/'.$this->session->userdata('ses_foto_supplier'));
    $url_foto_customer = base_url('assets/img/customer/'.$this->session->userdata('ses_foto_customer'));
    $url_gambar_profil = base_url('assets/img/banner/user.svg');
?>
    
<!DOCTYPE html>
<html lang="en">
<!--   
                                                                           
                                                                            
            ////////////   //   ////        //   ////////////        //          888   888              /////////           //        //             /////////     //          //
           //             //   // //       //        //            ////        888888 8    8           //       //        ////       //           //              //          //
          //             //   //  //      //        //           //  //       8888888*      8         //        //      //  //      //          //               //          //     
         //             //   //   //     //        //          //    //       88888888*     8        //       //      //    //     //           //              //          //
        //             //   //    //    //        //         //      //        88888*      8        /////////       //      //    //             ///////       //          // 
       //             //   //     //   //        //        ////////////         8888*     8        //             ////////////   //                    //     //          //
      //             //   //      //  //        //        //        //            888*  8         //             //        //   //                      //   //          //
     //             //   //       // //        //        //        //              88*8          //             //        //   //                     //    //          //
    ////////////   //   //        ////        //        //        //                 *          //             //        //   ////////////   /////////     //////////////

by exius-dev
-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/banner/onion.svg'); ?>"></link>
    <title>
        <?php 
        if($this->session->userdata('ses_akses') =='Supplier'){
            if($total_notif_supp != 0){
                echo "(".$total_notif_supp.") ";
            }
        }elseif($this->session->userdata('ses_akses') =='Admin'){
            if($total_notif_adm != 0){
                echo "(".$total_notif_adm.") ";
            }
        }elseif($this->session->userdata('ses_akses') =='Gudang'){
            if($total_notif_gdg != 0){
                echo "(".$total_notif_gdg.") ";
            }
        }
                echo $pageTitle;
        ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datetimepicker/jquery.datetimepicker.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/floating-labels/floating-labels.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/lightbox/src/css/lightbox.css"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/backend/css/adminlte.min.css">
    <style>
        /* COLOR CUSTOM */
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #6f42c1;
            border-color: #6f42c1;
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #6f42c1;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        a {
            color: #6f42c1;
            text-decoration: none;
            background-color: transparent;
        }

        /* INPUT NUMBER CUSTOM */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="preloader flex-column justify-content-center align-items-center bg-purple">
        <img class="animation__shake" src="<?php echo base_url('assets/img/banner/onion.svg'); ?>" alt="AdminLTELogo" height="60" width="60">
    </div>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-purple navbar-dark text-sm" aria-label="">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><span class="bx bx-fw bx-sm bx-menu"></span></a>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-light-purple elevation-4 text-sm">
            <a href="" class="brand-link bg-purple">
                <img src="<?php echo base_url('assets/img/banner/onion.svg'); ?>" class="brand-image" style="opacity: .8" alt="Image">
                <span class="brand-text font-weight"><strong class="text-md">UD Kurnia Asih</strong></span>
            </a>
            <div class="sidebar">
                <nav class="mt-2" aria-label="">
                    <ul class="nav nav-pills nav-sidebar nav-legacy nav-flat flex-column nav-child-indent" data-widget="treeview" role="menu">                
                        <?php if($this->session->userdata('ses_akses') =='Admin'){ ?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($this->session->userdata('ses_foto_karyawan') != "") { ?>
                                        <img src="<?php echo $url_foto_karyawan; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $this->session->userdata('ses_nama_karyawan'); ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-header" style="padding-top: 0px; padding-bottom: 0px; margin-top: -10px"><hr></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx bx-fw bx-grid-alt"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/proposal'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book-open"></i><p> Proposal<?php if($proposal != 0){ ?><span class="badge badge-danger right"> <?php echo $proposal; ?></span><?php } ?></p></a></li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bx-sort"></i><p>Transaksi Bahan Baku <i class="fas fa-angle-left right"></i><?php if($transaksi_bb_admin != 0){ ?><span class="badge badge-danger right"> <?php echo $transaksi_bb_admin; ?></span><?php } ?></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('admin/pemesanan_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Pemesanan Supplier<?php if($total_pemesanan_bb != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_bb; ?></span><?php } ?></p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/bahan_baku_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-down-arrow-alt"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/bahan_baku_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-up-arrow-alt"></i><p>Keluar</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/penyesuaian_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-refresh"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/retur_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-recycle"></i><p>Retur<?php if($total_retur_bb != 0){ ?><span class="badge badge-danger right"> <?php echo $total_retur_bb; ?></span><?php } ?></p></a></li>
                                </ul>
                            </li>                     
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bx-sort"></i><p>Transaksi Produk <i class="fas fa-angle-left right"></i><?php if($transaksi_pro_admin != 0){ ?><span class="badge badge-danger right"> <?php echo $transaksi_pro_admin; ?></span><?php } ?></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('admin/pemesanan_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Pemesanan Customer<?php if($total_pemesanan_pro != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_pro; ?></span><?php } ?></p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/produk_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-down-arrow-alt"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/penyesuaian_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-refresh"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/retur_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-recycle"></i><p>Retur<?php if($total_retur_pro != 0){ ?><span class="badge badge-danger right"> <?php echo $total_retur_pro; ?></span><?php } ?></p></a></li>
                                </ul>
                            </li>         
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bx-data"></i><p>Master Data <i class="fas fa-angle-left right"></i> <?php if($master_data != 0){ ?><span class="badge badge-danger right"> <?php echo $master_data; ?></span><?php } ?></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('admin/kategori'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-category"></i><p>Kategori</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/satuan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-unite"></i><p>Satuan</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/bank'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-bank"></i><p>Bank</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-box"></i><p>Bahan Baku <?php if($bb_limit != 0){ ?><span class="badge badge-danger right"> <?php echo $bb_limit; ?></span><?php } ?></p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxl-dropbox"></i><p>Produk <?php if($produk_limit != 0){ ?><span class="badge badge-danger right"> <?php echo $produk_limit; ?></span><?php } ?></p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/supplier'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-truck"></i><p>Supplier</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/customer'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-factory"></i><p>Customer</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bxs-report"></i><p>Laporan Bahan Baku<i class="fas fa-angle-left right"></i></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_bahan_baku/data_pemesanan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Pemesanan</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_bahan_baku/data_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_bahan_baku/data_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Keluar</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_bahan_baku/data_penyesuaian_stok'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_bahan_baku/data_retur'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Retur</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bxs-report"></i><p>Laporan Produk<i class="fas fa-angle-left right"></i></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_produk/data_pemesanan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Pemesanan</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_produk/data_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_produk/data_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Keluar</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_produk/data_penyesuaian_stok'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan_produk/data_retur'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Penyesuaian Retur</p></a></li>
                                </ul>
                            </li>
                        <?php }elseif($this->session->userdata('ses_akses') =='Gudang'){ ?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($this->session->userdata('ses_foto_karyawan') != "") { ?>
                                        <img src="<?php echo $url_foto_karyawan; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $this->session->userdata('ses_nama_karyawan'); ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-header" style="padding-top: 0px; padding-bottom: 0px; margin-top: -10px"><hr></li>
                            <li class="nav-item"><a href="<?php echo base_url('gudang/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx bx-fw bx-grid-alt"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('gudang/bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-box"></i><p>Bahan Baku <?php if($bb_limit != 0){ ?><span class="badge badge-danger right"> <?php echo $bb_limit; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('gudang/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxl-dropbox"></i><p>Produk <?php if($produk_limit != 0){ ?><span class="badge badge-danger right"> <?php echo $produk_limit; ?></span><?php } ?></p></a></li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bx-sort"></i><p>Transaksi Bahan Baku <i class="fas fa-angle-left right"></i><?php if($transaksi_bb_gudang != 0){ ?><span class="badge badge-danger right"> <?php echo $transaksi_bb_gudang; ?></span><?php } ?></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/pemesanan_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Pemesanan Supplier<?php if($dikirim + $retur != 0){ ?><span class="badge badge-danger right"> <?php echo $dikirim + $retur; ?></span><?php } ?></p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/bahan_baku_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-down-arrow-alt"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/bahan_baku_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-up-arrow-alt"></i><p>Keluar</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/penyesuaian_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-refresh"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/retur_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-recycle"></i><p>Retur<?php if($total_retur_bb != 0){ ?><span class="badge badge-danger right"> <?php echo $total_retur_bb; ?></span><?php } ?></p></a></li>
                                </ul>
                            </li>                     
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bx-sort"></i><p>Transaksi Produk <i class="fas fa-angle-left right"></i><?php if($transaksi_pro_gudang != 0){ ?><span class="badge badge-danger right"> <?php echo $transaksi_pro_gudang; ?></span><?php } ?></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/pemesanan_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Pemesanan Customer<?php if($total_pemesanan_pro != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_pro; ?></span><?php } ?></p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/produk_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-down-arrow-alt"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/penyesuaian_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-refresh"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('gudang/retur_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-recycle"></i><p>Retur<?php if($total_retur_pro != 0){ ?><span class="badge badge-danger right"> <?php echo $total_retur_pro; ?></span><?php } ?></p></a></li>
                                </ul>
                            </li>      
                        <?php }elseif($this->session->userdata('ses_akses') =='Pimpinan'){?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($this->session->userdata('ses_foto_karyawan') != "") { ?>
                                        <img src="<?php echo $url_foto_karyawan; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $this->session->userdata('ses_nama_karyawan'); ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-header" style="padding-top: 0px; padding-bottom: 0px; margin-top: -10px"><hr></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx bx-fw bx-grid-alt"></i><p>Dashboard</p></a></li>      
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-box"></i><p>Bahan Baku <?php if($bb_limit != 0){ ?><span class="badge badge-danger right"> <?php echo $bb_limit; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxl-dropbox"></i><p>Produk <?php if($produk_limit != 0){ ?><span class="badge badge-danger right"> <?php echo $produk_limit; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/customer'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-factory"></i><p>Customer</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/supplier'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-truck"></i><p>Supplier</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user bx-fw"></i><p>Karyawan</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/proposal'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book-open"></i><p> Proposal<?php if($proposal != 0){ ?><span class="badge badge-danger right"> <?php echo $proposal; ?></span><?php } ?></p></a></li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bxs-report"></i><p>Laporan Bahan Baku<i class="fas fa-angle-left right"></i></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_bahan_baku/data_pemesanan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Pemesanan</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_bahan_baku/data_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_bahan_baku/data_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Keluar</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_bahan_baku/data_penyesuaian_stok'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_bahan_baku/data_retur'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Retur</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bxs-report"></i><p>Laporan Produk<i class="fas fa-angle-left right"></i></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_produk/data_pemesanan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Pemesanan</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_produk/data_masuk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Masuk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_produk/data_keluar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Keluar</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_produk/data_penyesuaian_stok'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Penyesuaian Stok</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('pimpinan/laporan_produk/data_retur'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Penyesuaian Retur</p></a></li>
                                </ul>
                            </li>
                        <?php }elseif($this->session->userdata('ses_akses') =='Supplier'){ ?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($this->session->userdata('ses_foto_supplier') != "") { ?>
                                        <img src="<?php echo $url_foto_supplier; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $this->session->userdata('ses_nama_supplier'); ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('supplier/profil'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('supplier/profil/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-header" style="padding-top: 0px; padding-bottom: 0px; margin-top: -10px"><hr></li>
                            <li class="nav-item"><a href="<?php echo base_url('supplier/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx bx-fw bx-grid-alt"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('supplier/proposal'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-book-open"></i><p> Proposal<?php if($proposal_sup != 0){ ?><span class="badge badge-danger right"> <?php echo $proposal_sup; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('supplier/pemesanan_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Pemesanan<?php if($total_pemesanan_sup != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_sup; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('supplier/bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-box"></i><p>Bahan Baku <?php if($bb_limit_sup != 0){ ?><span class="badge badge-danger right"> <?php echo $bb_limit_sup; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('supplier/retur_bahan_baku'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-recycle"></i><p>Retur<?php if($total_retur_sup != 0){ ?><span class="badge badge-danger right"> <?php echo $total_retur_sup; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('supplier/ongkos_kirim'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-truck"></i><p>Ongkos Kirim</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('supplier/rekening'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-bank"></i><p>Rekening Bank</p></a></li>
                        <?php }elseif($this->session->userdata('ses_akses') =='Customer'){
                            $id_customer = $this->session->userdata('ses_id_customer'); ?>
                            
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($this->session->userdata('ses_foto_customer') != "") { ?>
                                        <img src="<?php echo $url_foto_customer; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="width:47px; height:47px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $this->session->userdata('ses_nama_customer'); ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('customer/profil'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('customer/profil/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-header" style="padding-top: 0px; padding-bottom: 0px; margin-top: -10px"><hr></li>
                            <li class="nav-item"><a href="<?php echo base_url('customer/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx bx-fw bx-grid-alt"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('customer/pemesanan_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-calendar-check"></i><p>Pemesanan Produk<?php if($total_pemesanan_cus != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_cus; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('customer/retur_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bx-recycle"></i><p>Retur Produk<?php if($total_retur_cus != 0){ ?><span class="badge badge-danger right"> <?php echo $total_retur_cus; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('customer/rekening'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-bank"></i><p>Rekening Bank</p></a></li>
                        <?php } ?> 
                    </ul>
                    <ul class="nav nav-pills nav-sidebar nav-compact flex-column nav-child-indent" style="position: absolute; bottom: 10px;">
                        <li class="nav-item"><a href="<?php echo base_url('login/logout'); ?>" class="nav-link bg-danger"><i class="nav-icon bx bx-fw bx-log-out"></i><p>Logout</p></a></li>
                    </ul>
                </nav>
            </div>
        </aside>