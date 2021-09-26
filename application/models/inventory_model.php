<?php
class Inventory_model extends CI_Model
{

	public function admin_id()
	{
		$this->db->select('RIGHT(admin.id_admin,2) as id', false);
		$this->db->order_by('id_admin', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get('admin');

		if ($query->num_rows() != 0) {
			$data = $query->row();
			$id = intval($data->id) + 1;
		} else {
			$id = 1;
		}
		$idMax = str_pad($id, 2, "0", STR_PAD_LEFT);
		$adminId = "A" . $idMax;
		return $adminId;
	}

	public function supplier_id()
	{
		$this->db->select('RIGHT(supplier.id_supplier,2) as id', false);
		$this->db->order_by('id_supplier', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get('supplier');

		if ($query->num_rows() != 0) {
			$data = $query->row();
			$id = intval($data->id) + 1;
		} else {
			$id = 1;
		}
		$idMax = str_pad($id, 2, "0", STR_PAD_LEFT);
		$supplierId = "S" . $idMax;
		return $supplierId;
	}

	public function barang_id()
	{
		$this->db->select('RIGHT(barang.id_barang,6) as id', false);
		$this->db->order_by('id_barang', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get('barang');

		if ($query->num_rows() != 0) {
			$data = $query->row();
			$id = intval($data->id) + 1;
		} else {
			$id = 1;
		}
		$idMax = str_pad($id, 6, "0", STR_PAD_LEFT);
		$barangId = "B" . $idMax;
		return $barangId;
	}

	public function barangMasuk_id()
	{
		$this->db->select('RIGHT(stok.id_stok,6) as id', false);
		$this->db->order_by('id_stok', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get('stok');

		if ($query->num_rows() != 0) {
			$data = $query->row();
			$id = intval($data->id) + 1;
		} else {
			$id = 1;
		}
		$idMax = str_pad($id, 6, "0", STR_PAD_LEFT);
		$barangMasukId = "St" . $idMax;
		return $barangMasukId;
	}

	public function add_admin()
	{
		$data = [
			'id_admin' => $this->input->post('id_admin'),
			'email' => $this->input->post('email', true),
			'nama_admin' => $this->input->post('name', true),
			'alamat_admin' => '-',
			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
		];
		$this->db->insert('admin', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your Account Has Been Created </div>');

		redirect('auth/index');
	}

	public function edit_admin()
	{
		$data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$address = $this->input->post('address');


		$this->db->set('alamat_admin', $address);
		$this->db->set('nama_admin', $name);
		$this->db->where('email', $email);
		$this->db->update('admin');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah </div>');

		redirect('admin/editProfile');
	}

	public function add_supplier()
	{
		$data = [
			'id_supplier' => $this->input->post('id_supplier'),
			'nama_supplier' => $this->input->post('name', true),
			'no_hp' => $this->input->post('noHp', true),
			'alamat_supplier' => $this->input->post('address', true)
		];
		$this->db->insert('supplier', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Supplier Berhasil Ditambahkan </div>');

		redirect('admin/supplier');
	}

	public function delete_supplier($id_supplier)
	{
		$this->db->where('id_supplier', $id_supplier);
		$this->db->delete('supplier');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Supplier Berhasil Dihapus </div>');
		redirect('admin/supplier');
	}

	public function add_barang()
	{
		$data = [
			'id_barang' => $this->input->post('id_barang'),
			'merek' => $this->input->post('nama', true),
			'kategori' => $this->input->post('kategori', true),
			'satuan' => $this->input->post('satuan', true),
			'stok' => $this->input->post('stok', true),
			'harga_beli' => $this->input->post('harga_beli', true),
			'harga_jual' => $this->input->post('harga_jual', true),
		];
		$this->db->insert('barang', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Supplier Berhasil Ditambahkan </div>');

		redirect('admin/barang');
	}

	public function delete_barang($id_barang)
	{
		$this->db->where('id_barang', $id_barang);
		$this->db->delete('barang');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Barang Berhasil Dihapus </div>');
		redirect('admin/barang');
	}


	public function distinctMerek()
	{

		$this->db->select('merek');
		$this->db->distinct();
		return $this->db->get('barang')->result_array();
	}

	public function distinctKategori()
	{
		$this->db->select('kategori');
		$this->db->distinct();
		return $this->db->get('barang')->result_array();
	}

	public function distinctSatuan()
	{
		$this->db->select('satuan');
		$this->db->distinct();
		return $this->db->get('barang')->result_array();
	}

	public function add_barangMasuk()
	{

		$data = [
			'id_stok' => $this->input->post('id'),
			'id_barang' => $this->input->post('id_barang'),
			'type' => 'in',
			'tanggal' => date('Y-m-d H:i:s'),
			'nama_supplier' => $this->input->post('namaSupplier', true),
			'kategori' => $this->input->post('kategori', true),
			'qty' => $this->input->post('qty', true),
			'satuan' => $this->input->post('satuan', true),
			'keterangan' => $this->input->post('keterangan', true),

		];
		$this->db->insert('stok', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang Berhasil Ditambahkan </div>');
		redirect('admin/barangMasuk');
	}

	public function update_barang($id, $qty)
	{
		$sql = "UPDATE barang SET stok = stok + $qty WHERE id_barang = '$id'";
		$this->db->query($sql);
	}

	public function delete_barangMasuk($id_stok)
	{
		$this->db->where('id_stok', $id_stok);
		$this->db->delete('stok');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Barang Berhasil Dihapus </div>');
		redirect('admin/barangMasuk');
	}

	public function getallBarang()
	{
		return $this->db->get('barang')->num_rows();
	}
	public function getallSupplier()
	{
		return $this->db->get('supplier')->num_rows();
	}

	// mentotalkan seluruh stok yang ada
	public function totalStokBarang()
	{
		$this->db->select_sum('stok');
		$query = $this->db->get('barang');
		if ($query->num_rows() > 0) {
			return $query->row()->stok;
		} else {
			return 0;
		}
	}
}
