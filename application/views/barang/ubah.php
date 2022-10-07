<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-8">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('barang/proses_ubah/' . $barang->kode_barang) ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
										<div class="form-row">
											<div class="form-group col-md-2">
												<label for="kode_barang"><strong>Kode Barang</strong></label>
												<input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= $barang->kode_barang ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-5">
												<label for="nama_kategori"><strong>Nama Kategori</strong></label>
												<input type="text" name="nama_kategori" placeholder="Masukkan Nama Kategori" autocomplete="off" class="form-control" required value="<?= $barang->nama_kategori ?>">
											</div>
											<div class="form-group col-md-5">
												<label for="nama_barang"><strong>Nama Barang</strong></label>
												<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required value="<?= $barang->nama_barang ?>">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-3">
												<label for="stok"><strong>Stok</strong></label>
												<input type="number" name="stok" placeholder="Masukkan Stok" autocomplete="off" class="form-control" required value="<?= $barang->stok ?>">
											</div>
											<div class="form-group col-md-4">
												<label for="satuan"><strong>Satuan</strong></label>
												<select name="satuan" id="satuan" class="form-control" required>
													<option value="">-- Silahkan Pilih --</option>
													<option value="pcs" <?= $barang->satuan == 'pcs' ? 'selected' : '' ?>>PCS</option>
													<option value="sachet" <?= $barang->satuan == 'sachet' ? 'selected' : '' ?>>SACHET</option>
													<option value="renceng" <?= $barang->satuan == 'renceng' ? 'selected' : '' ?>>RENCENG</option>
													<option value="pak" <?= $barang->satuan == 'pak' ? 'selected' : '' ?>>PAK</option>
													<option value="dus" <?= $barang->satuan == 'dus' ? 'selected' : '' ?>>DUS</option>
													<option value="kg" <?= $barang->satuan == 'kg' ? 'selected' : '' ?>>KILOGRAM</option>
													<option value="ons" <?= $barang->satuan == 'ons' ? 'selected' : '' ?>>ONS</option>
												</select>
											</div>
											<!-- <div class="form-group col-md-5">
												<label for="img_barang"><strong>Ubah Gambar ?</strong></label>
												<input type="file" id="img_barang" name="img_barang" autocomplete="off" class="form-control" value="<?php echo $barang->foto ?>">
											</div> -->
										</div>
										<hr>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</form>

								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card shadow">
								<div class="card-header"><strong>Preview Foto</strong></div>
								<div class="card-body">
									<img src="<?= base_url('sb-admin/img/' . $barang->foto) ?>" width="259px" alt="">
									<FORM action="<?php echo base_url('barang/ubah_foto/' . $barang->kode_barang) ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
										<!-- <div class="form-group col-md-10">
											<label for="img_barang"><strong>Ubah Gambar ?</strong></label>
										</div> -->
										<br>
										<input type="file" id="img_barangubah" name="img_barangubah" autocomplete="off" class="form-control" value="<?php echo $barang->foto ?>" required>
										<input type="hidden" name="nama_brg" class="form-control" value="<?php echo $barang->nama_barang ?>">
										<hr>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</FORM>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>

</html>