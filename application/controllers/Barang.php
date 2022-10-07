<?php

use DOMPDF as GlobalDOMPDF;
use Dompdf\Dompdf;

class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'barang';
		$this->load->model('M_barang', 'm_barang');
	}

	public function index()
	{
		$this->data['title'] = 'Data Barang';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['no'] = 1;

		$this->load->view('barang/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Barang';

		$this->load->view('barang/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$kode_barang = $this->input->post('kode_barang');
		$nama_kategori = $this->input->post('nama_kategori');
		$nama_barang = $this->input->post('nama_barang');
		$stok = $this->input->post('stok');
		$satuan = $this->input->post('satuan');

		$config['file_name']	= $nama_barang . time();
		$config['upload_path']  = './sb-admin/img';
		$config['allowed_types'] = 'jpg|png|gif';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('img_barang')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$upload                 = $this->upload->do_upload('img_barang');
			$data                    = $this->upload->data();
			$baru = array(
				'kode_barang' => $kode_barang,
				'nama_kategori' => $nama_kategori,
				'nama_barang' => $nama_barang,
				'satuan' => $satuan,
				'stok' => $stok,
				'foto' => $data['file_name']
			);

			if ($this->m_barang->tambah($baru)) {
				$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
				redirect('barang');
			} else {
				$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
				redirect('barang');
			}
		}
	}

	public function ubah($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		$this->load->view('barang/ubah', $this->data);
	}

	public function foto($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		$this->load->view('barang/foto', $this->data);
	}

	public function proses_ubah($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'nama_kategori' => $this->input->post('nama_kategori'),
			'nama_barang' => $this->input->post('nama_barang'),
			'stok' => $this->input->post('stok'),
			'satuan' => $this->input->post('satuan')
		];


		if ($this->m_barang->ubah($data, $kode_barang)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('barang');
		}
	}


	public function ubah_foto($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$nama_brg = $this->input->post('nama_brg');
		// $foto = $this->input->post('img_barangubah');

		$config['file_name']	= $nama_brg . '_' . time();
		$config['upload_path']  = './sb-admin/img';
		$config['allowed_types'] = 'jpg|png|gif|jpeg';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('img_barangubah')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$upload                 = $this->upload->do_upload('img_barangubah');
			$data                    = $this->upload->file_name;
			// $data['file_name'] = $foto;

			if ($this->m_barang->ubah_foto($data, $kode_barang)) {
				$this->session->set_flashdata('success', 'Foto Barang <strong>Berhasil</strong> Diubah!');
				redirect('barang');
			} else {
				$this->session->set_flashdata('error', 'Foto Barang <strong>Gagal</strong> Diubah!');
				redirect('barang');
			}
		}
	}


	public function hapus($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}

		if ($this->m_barang->hapus($kode_barang)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('barang');
		}
	}


	// public function export()
	// {
	// 	$this->load->library('dompdf_gen');
	// 	$data['all_barang'] = $this->m_barang->lihat()->result;
	// 	$data['title'] = 'Laporan Data Barang';
	// 	$data['no'] = 1;

	// 	$paper_size = 'A4';
	// 	$orientation = 'landscape';
	// 	$html = $this->output->get_output();
	// 	$this->load->view('barang/report', $data, true);
	// 	$this->dompdf->set_paper($paper_size, $orientation);
	// 	$this->dompdf->load_html($html);
	// 	$this->dompdf->render($html);
	// 	$this->dompdf->stream('Laporan Data Barang Tanggal ' . date('d F Y'), array("Attachment" => false));
	// }

	public function export()
	{

		$dompdf = new DOMPDF();
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['title'] = 'Laporan Data Barang';
		$this->data['no'] = 1;

		$this->load->library('dompdf_gen');

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('barang/report', $this->data, true);
		$dompdf->loadHtml($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Barang Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
