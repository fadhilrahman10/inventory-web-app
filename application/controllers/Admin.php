<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('function_helper');
		$this->load->model('inventory_model');
		$this->load->library('Ciqrcode');
		$this->load->library('Zend');
		date_default_timezone_set('Asia/Jakarta');

		// block akses dari url
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{

		$data['title'] = 'Dashboard';
		$data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
		$data['totalBarang'] = $this->inventory_model->getallBarang();
		$data['totalSupplier'] = $this->inventory_model->getallSupplier();
		$data['totalStok'] = $this->inventory_model->totalStokBarang();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function profile()
	{
		$data['title'] = 'Profil Admin';
		$data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/profile', $data);
		$this->load->view('templates/footer');
	}

	public function editProfile()
	{
		$data['title'] = 'Edit Profile';
		$data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/editProfile', $data);
			$this->load->view('templates/footer');
		} else {
			$this->inventory_model->edit_admin();
		}
	}

	public function supplier()
	{
		$data['title'] = 'Data Supplier';
		$data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
		$data['supplier'] = $this->db->get('supplier')->result_array();

		$this->form_validation->set_rules('name', 'Name of Supplier', 'required');
		$this->form_validation->set_rules('noHp', 'Phone Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		$data['id'] = $this->inventory_model->supplier_id();

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/supplier', $data);
			$this->load->view('templates/footer');
		} else {
			$this->inventory_model->add_supplier();
		}
	}

	public function supplierDelete($id_supplier)
	{
		$this->inventory_model->delete_supplier($id_supplier);
		redirect('admin/supplier');
	}

	public function barang()
	{
		$data['title'] = 'Data Barang';
		$data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang'] = $this->db->get('barang')->result_array();

		$distinctMerek = $this->inventory_model->distinctMerek();
		$data['distinctMerek'] = $distinctMerek;

		$distinctKategori = $this->inventory_model->distinctKategori();
		$data['distinctKategori'] = $distinctKategori;

		$distinctSatuan = $this->inventory_model->distinctSatuan();
		$data['distinctSatuan'] = $distinctSatuan;

		$data['id'] = $this->inventory_model->barang_id();

		$this->form_validation->set_rules('nama', 'Nama Barang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barang', $data);
			$this->load->view('templates/footer');
		} else {
			$this->inventory_model->add_barang();
		}
	}

	public function barangDelete($id_barang)
	{
		$this->inventory_model->delete_barang($id_barang);
		redirect('admin/barang');
	}

	public function barangMasuk()
	{
		$data['title'] = 'Barang Masuk';
		$data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

		$data['supplier'] = $this->db->get('supplier')->result_array();
		$data['barang'] = $this->db->get('barang')->result_array();

		$data['id'] = $this->inventory_model->barangMasuk_id();

		$this->form_validation->set_rules('qty', 'Qty', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/barangMasuk', $data);
			$this->load->view('templates/footer');
		} else {
			$this->inventory_model->update_barang($this->input->post('id_barang'), (int)$this->input->post('qty'));
			$this->inventory_model->add_barangMasuk();
		}
	}
	public function barangMasukDelete($id_stok)
	{
		$this->inventory_model->delete_barangMasuk($id_stok);
		redirect('admin/barangMasuk');
	}

	public function printBarangMasuk()
	{
		$data['title'] = 'Barang Masuk';
		$data['barangMasuk'] = $this->db->get('barang_masuk')->result_array();
		$this->load->view('admin/print', $data);
	}

	public function printBarang()
	{
		$data['title'] = 'Barang';
		$data['barang'] = $this->db->get('barang')->result_array();
		$this->load->view('admin/printBarang', $data);
	}

	public function printSupplier()
	{
		$data['title'] = 'Supplier';
		$data['supplier'] = $this->db->get('supplier')->result_array();
		$this->load->view('admin/printSupplier', $data);
	}

	public function qrcode($id)
	{
		// render qr code dengan format gambar PNG
		QRcode::png(
			$id,
			$outfile = false,
			$level = QR_ECLEVEL_H,
			$size = 5,
			$margin = 2
		);
	}

	public function barcode($id)
	{
		$data['barang'] = $this->db->get('barang')->result();
		$this->zend->load('Zend/Barcode', $data);

		Zend_Barcode::render('code128', 'image', array('text' => $id));
	}
}
