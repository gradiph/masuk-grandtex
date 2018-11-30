<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Grandtex</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
</head>

<body class="">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-light" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="<?php echo site_url(); ?>">Grandtex</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo site_url('Penerimaan');?>">Penerimaan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo site_url('Pengeluaran');?>">Pengeluaran</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo site_url('Lihatdata');?>">Lihat Data</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo site_url('welcome/logout');?>">
                            (
                            <?php echo $this->session->userdata("loger"); ?>) Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            <h1 class="text-center">Halaman Lihat Data</h1>
            <section id="home">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $aktif != null ? '' : 'active'; ?>" id="stok-tab" data-toggle="tab" href="#tab-stok" role="tab" aria-controls="tab-stok" aria-selected="<?php echo $aktif != null ? 'false' : 'true'; ?>">Stok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $aktif != 'penerimaan' ? '' : 'active'; ?>" id="penerimaan-tab" data-toggle="tab" href="#tab-penerimaan" role="tab" aria-controls="tab-penerimaan" aria-selected="<?php echo $aktif != null ? 'false' : 'true'; ?>">Penerimaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $aktif != 'pengeluaran' ? '' : 'active'; ?>" id="pengeluaran-tab" data-toggle="tab" href="#tab-pengeluaran" role="tab" aria-controls="tab-pengeluaran" aria-selected="<?php echo $aktif != null ? 'false' : 'true'; ?>">Pengeluaran</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?php echo $aktif != null ? '' : 'show active'; ?>" id="tab-stok" role="tabpanel" aria-labelledby="stok-tab">
                        <h3>STOCK:</h3>
                        <ul>
                            <?php
                            foreach ($jenis as $j)
                            {
                                ?>
                                <li>JENIS = <?php echo $j->nama; ?>, UNIT = <?php echo $total['unit'][$j->id_jenis] != null ? $total['unit'][$j->id_jenis] : 0 ; ?>, KILOGRAM = <?php echo $total['kilogram'][$j->id_jenis] != null ? $total['kilogram'][$j->id_jenis] : 0 ; ?></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <p></p>
                        <h3>URAIAN TABEL DATA STOK</h3>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <th>ID</th>
                                <th>JENIS</th>
                                <th>NO. BOX</th>
                                <th>UNIT</th>
                                <th>KILOGRAM</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($stok as $s)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $s->id_stok; ?></td>
                                            <td><?php echo $s->nama_jenis; ?></td>
                                            <td><?php echo $s->no_box; ?></td>
                                            <td><?php echo $s->unit; ?></td>
                                            <td><?php echo $s->kilogram; ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade <?php echo $aktif != 'penerimaan' ? '' : 'show active'; ?>" id="tab-penerimaan" role="tabpanel" aria-labelledby="penerimaan-tab">
                        <h3>STOCK:</h3>
                        <ul>
                            <?php
                            foreach ($jenis as $j)
                            {
                                ?>
                                <li>JENIS = <?php echo $j->nama; ?>, UNIT = <?php echo $total['unit'][$j->id_jenis] != null ? $total['unit'][$j->id_jenis] : 0 ; ?>, KILOGRAM = <?php echo $total['kilogram'][$j->id_jenis] != null ? $total['kilogram'][$j->id_jenis] : 0 ; ?></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <p></p>
                        <h3>URAIAN TABEL DATA PENERIMAAN</h3>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <th>ID</th>
                                <th>TGL. PRODUKSI</th>
                                <th>JENIS</th>
                                <th>NO. BOX</th>
                                <th>UNIT</th>
                                <th>KILOGRAM</th>
                                <th>STATUS</th>
                                <th>USER</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($penerimaan as $p)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $p->id_penerimaan; ?></td>
                                            <td><?php echo date('d F y', strtotime($p->tgl)); ?></td>
                                            <td><?php echo $p->nama_jenis; ?></td>
                                            <td><?php echo $p->no_box; ?></td>
                                            <td><?php echo $p->unit; ?></td>
                                            <td><?php echo $p->kilogram; ?></td>
                                            <td><?php echo $p->status; ?></td>
                                            <td><?php echo $p->nama_user; ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade <?php echo $aktif != 'pengeluaran' ? '' : 'show active'; ?>" id="tab-pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab">
                        <h3>STOCK:</h3>
                        <ul>
                            <?php
                            foreach ($jenis as $j)
                            {
                                ?>
                                <li>JENIS = <?php echo $j->nama; ?>, UNIT = <?php echo $total['unit'][$j->id_jenis] != null ? $total['unit'][$j->id_jenis] : 0 ; ?>, KILOGRAM = <?php echo $total['kilogram'][$j->id_jenis] != null ? $total['kilogram'][$j->id_jenis] : 0 ; ?></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <p></p>
                        <h3>URAIAN TABEL DATA PENGELUARAN</h3>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <th>ID</th>
                                <th>TGL. PENGELUARAN</th>
                                <th>JENIS</th>
                                <th>NO. BOX</th>
                                <th>UNIT</th>
                                <th>KILOGRAM</th>
                                <th>STATUS</th>
                                <th>TUJUAN</th>
                                <th>USER</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($pengeluaran as $p)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $p->id_pengeluaran; ?></td>
                                            <td><?php echo date('d F y', strtotime($p->tgl_pengeluaran)); ?></td>
                                            <td><?php echo $p->nama_jenis; ?></td>
                                            <td><?php echo $p->no_box; ?></td>
                                            <td><?php echo $p->unit; ?></td>
                                            <td><?php echo $p->kilogram; ?></td>
                                            <td><?php echo $p->status; ?></td>
                                            <td><?php echo $p->nama_pt; ?></td>
                                            <td><?php echo $p->nama_user; ?></td>
                                        </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-3 fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Grandtex 2018</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
