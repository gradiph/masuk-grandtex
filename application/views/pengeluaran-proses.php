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
				<h1 class="text-center">Halaman Penerimaan: Proses</h1>
				<section id="home">
					<h3>DESKRIPSI -> <?php echo $tgl; ?> || <?php echo $jenis; ?></h3>

					<form method="post" action="<?php echo site_url('Penerimaan/simpan'); ?>">
						<!-- input untuk tgl dan jenis -->
						<input type="hidden" name="tgl" value="<?php echo $tgl; ?>">
						<input type="hidden" name="id_jenis" value="<?php echo $id_jenis; ?>">

						<table class="table table-bordered table-striped table-hover">
							<thead>
								<th>NO. BOX</th>
								<th>UNIT</th>
								<th>KILOGRAM</th>
							</thead>
							<tbody>
								<?php
									for ($i = 0; $i < $jumlah; $i++)
									{
										?>
											<tr>
												<td><input type="text" name="nomor[]"></td>
												<td><input type="text" name="unit[]"></td>
												<td><input type="text" name="kilogram[]"></td>
											</tr>
										<?php
									}
								?>
							</tbody>
						</table>

						<button type="submit" id="btn-submit" class="btn btn-primary">SAVE</button>
					</form>
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
