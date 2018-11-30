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
								(<?php echo $this->session->userdata("loger"); ?>) Logout
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<main class="py-5">
			<div class="container">
				<h1 class="text-center">Halaman Pengeluaran: <?php echo $id_jenis == null ? 'Seluruhnya' : 'Sebagian'; ?></h1>
				<section id="home">
                    <div class="float-right">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" readonly class="form-control-plaintext text-right" value="Search">
                            </div>
                            <div class="col-auto">
                                <input type="text" id="input-search" class="form-control" autofocus>
                            </div>
                        </div>
                    </div>

                    <table id="table-data" class="table table-bordered table-striped table-hover">
                    <?php
                    if ($id_jenis == null)
                    {
                        ?>
                            <thead>
                                <th>TANGGAL PRODUKSI</th>
                                <th>JENIS</th>
                                <th>JUMLAH UNIT</th>
                                <th>JUMLAH KILOGRAM</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($total_penerimaan as $tp)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo date('d F y', strtotime($tp->tgl)); ?></td>
                                        <td><a href="<?php echo site_url('Pengeluaran/seluruhnya?tgl='.$tgl.'&id_namapt='.$id_namapt.'&id_jenis='.$tp->id_jenis); ?>"><?php echo $tp->nama_jenis; ?></a></td>
                                        <td><?php echo $tp->total_unit; ?></td>
                                        <td><?php echo $tp->total_kilogram; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        <?php
                    }
                    else
                    {
                        ?>
                            <thead>
                                <th>TANGGAL PRODUKSI</th>
                                <th>NO. BOX</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($total_penerimaan as $tp)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo date('d F y', strtotime($tp->tgl)); ?></td>
                                        <td><a href="<?php echo site_url('Pengeluaran/sebagian?tgl='.$tgl.'&id_namapt='.$id_namapt.'&id_jenis='.$id_jenis.'&no_box='.$tp->no_box); ?>"><?php echo $tp->no_box; ?></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        <?php
                    }
                    ?>
                    </table>
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

        <script>
            $("#input-search").keyup(function() {
                filter_table();
            });

            function filter_table() {
                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("input-search");
                filter = input.value.toUpperCase();
                table = document.getElementById("table-data");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        if (td.textContent.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
	</body>

</html>
