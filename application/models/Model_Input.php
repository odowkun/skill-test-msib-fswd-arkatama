<?php
	class Model_Input extends CI_Model
	{

	
		function input(){
			$input=$this->input->post('input');
			$create_at=$this->input->post('create_at');
			$input = strtoupper($input);

			//mencari name
			$name = strtok($input, ' ');

			//mencari age
			$age ="";
			$pattern1 = '/\d+ TAHUN/';
			$pattern2 = '/\d+ THN/';
			$pattern3 = '/\d+ TH/';
			$pattern4 = '/\d+TAHUN/';
			$pattern5 = '/\d+THN/';
			$pattern6 = '/\d+TH/';
			if(preg_match($pattern1, $input, $matches)){
				$age = $matches[0];
				// echo "Nilai: " . $nilai;s
			}else if(preg_match($pattern2, $input, $matches)){
				$age = $matches[0];
				// echo "Nilai: " . $nilai;
			}else if(preg_match($pattern3, $input, $matches)){
				$age = $matches[0];
				// echo "Nilai: " . $nilai;
			}else if(preg_match($pattern4, $input, $matches)){
				$age = $matches[0];
				// echo "Nilai: " . $nilai;
			}else if(preg_match($pattern5, $input, $matches)){
				$age = $matches[0];
				// echo "Nilai: " . $nilai;
			}else if(preg_match($pattern6, $input, $matches)){
				$age = $matches[0];
				// echo "Nilai: " . $nilai;
			}

			//mencari city
			$city = explode(" ", $input);
			$city = $city[count($city) - 1];

			// mencari create_at
			date_default_timezone_set('Asia/Jakarta');
			$date = date('Y-m-d H:i:s');

			
			$this->db->set('name',$name)->set('age',$age)->set('city',$city)->set('create_at',$date)->insert('dataDiri');
			// $this->db->set('',$username)->insert('tbadmin',$data);
			// return $this->db
			// ->select("*")
			// ->from("tbadmin")
			// ->where('nik',$username)
			// ->get()
			// ->result();
		}

	function dataAdmin($username){
		return $this->db
		->select("*")
		->from("tbadmin")
		->where('nik',$username)
		->get()
		->result();
	}

	function updateData($username){
		$data=$_POST;
		$nik = $this->db->select("*")->from("tbadmin")->where('nik',$username)->get()->result();
		if (empty($nik[0]->nik)) {
			$this->db->set('nik',$username)->insert('tbadmin',$data);
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan!');
			// $this->session->set_flashdata('pesan','Data Berhasil Ditambahkan! Password : '.$pass);
		} else {
			$this->db->where('nik',$username)
			->update('tbadmin', $data);
			$this->session->set_flashdata('pesan','Data Berhasil Diedit!');
		}
	}

	function insertDataPegawai($username){
		$nik=$this->input->post('nik');
		$validasi = $this->db->select("*")->from("tbpegawai")->where('nik',$nik)->get()->result();
		if (empty($validasi[0]->nik)) {
			// $data=$_POST;
			$nik=$this->input->post('nik');
			$nama=$this->input->post('nama');
			$noTelp=$this->input->post('noTelp');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$this->db->set('email',$email)->set('username',$nik)->set('password',$password)->set('level',1)->insert('tblogin');
			$this->db->set('nik',$nik)->set('nama',$nama)->set('noTelp',$noTelp)->set('email',$email)->insert('tbpegawai');
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan!');
			// $this->session->set_flashdata('pesan','Data Berhasil Ditambahkan! Password : '.$pass);
		} else {
			// $this->db->where('nik',$username)
			// ->update('tbadmin', $data);
			$this->session->set_flashdata('pesanWarning','Maaf NIK sudah terdaftar!');
		}
	}

	function dataPegawai(){
		return $this->db->get('tbpegawai')->result();
	}

	function passwordPegawai(){
		return $this->db->where('level', 1)->get('tblogin')->result();
	}

	function editPegawai($nik) {
		$query=$this->db->get_where('tbpegawai', array('nik'=>$nik));
		if ($query->num_rows()>0){
			$data=$query->row();
			echo "<script>$('#nik').val('".$data->nik."')</script>";
			echo "<script>$('#nama').val('".$data->nama."')</script>";	
			echo "<script>$('#noTelp').val('".$data->noTelp."')</script>";
			echo "<script>$('#email').val('".$data->email."')</script>";
			echo "<script>$('#password').val('".$data->password."')</script>";
		}
	}

	function hapusPegawai($nik) {
		$this->db->where('nik', $nik)->delete('tbpegawai');
		$this->db->delete('tbpegawai', array('nik'=>$nik));
		$this->db->delete('tblogin', array('username'=>$nik));
		$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
	}

	public function saveDataExcel($data) {
        // Ganti 'nama_tabel' dengan nama tabel yang sesuai di database Anda
        $this->db->insert_batch('nama_tabel', $data);
    }

    public function getDataExcel() {
        // Ganti 'nama_tabel' dengan nama tabel yang sesuai di database Anda
        $query = $this->db->get('nama_tabel');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

	
   	function table($namaTabel)	{
			return $this->db->get($namaTabel)->result();
		}
		function tableWhere($namaTabel, $where) {
			return $this->db->get_where($namaTabel, $where)->result();
		}
   	function tableSkema()	{
			return $this->db
			->select("count(tbskema.idJurusan) as jumlah, namaJurusan")
			->from("tbSkema")
			->join("tbjurusan", "tbskema.idJurusan = tbJurusan.idJurusan")
			->group_by("tbskema.idJurusan")
			->get()
			->result();
		}
		function grafik() {
			return $this->db
			->select();
		}

		function lgrafik() {
			$query = $this->tableSkema();
			$string = "";
			foreach ($query as $data) {
				$string .= "'".$data->namaJurusan."', ";
			}
			return $string;
		}
		function dgrafik() {
			$query = $this->tableSkema();
			$string = "";
			foreach ($query as $data) {
				$string .= "'".$data->jumlah."', ";
			}
			return $string;
		}

		// ============================ SKEMA ============================

		function updateSkema($kodeSkema, $pilih) {
			//data yang diedit
			$data['nipAdmin'] = $this->session->userdata('Username');
			$data['verifikasiSkema']= $pilih;

			//update tbskema set $data where 
			$this->db->where('kodeSkema', $kodeSkema);
			$this->db->update('tbskema', $data);

			$this->session->set_flashdata('pesan','Data Berhasil Disimpan!');
			redirect(base_url('controller_admin/skema'));
		}

		// ============================ PEGAWAI ============================
		function submitPegawai($pass) {
			$data=$_POST;
			$nip = $this->db->get_where('tbPegawai', array('nipPegawai'=>$data['nipPegawai']));
			if (!empty($nip)) {
				$data['password']=$pass;
				$this->db->insert('tbpegawai',$data);
	
				$dataLogin = array(
					'username' => $data['nipPegawai'],
					'password' => $data['password'],
					'level' => '1'
				);
				$this->db->insert('tblogin',$dataLogin);
				$this->session->set_flashdata('pesan','Data Berhasil Ditambahkan! Password : '.$pass);
			} else {
				$this->db->where('nipPegawai', array('nipPegawai'=>$data['nipPegawai']))
				->update('tbPegawai', $data);
				$this->session->set_flashdata('pesan','Data Berhasil Diedit!');
			}
		}

		// function editPegawai($nipPegawai) {
		// 	$query=$this->db->get_where('tbpegawai', array('nipPegawai'=>$nipPegawai));
		// 	if ($query->num_rows()>0){
		// 		$data=$query->row();
		// 		echo "<script>$('#nipPegawai').val('".$data->nipPegawai."')</script>";
		// 		echo "<script>$('#namaPegawai').val('".$data->namaPegawai."')</script>";	
		// 		echo "<script>$('#jenisKelamin').val('".$data->jenisKelamin."')</script>";
		// 		echo "<script>$('#noHP').val('".$data->noHP."')</script>";
		// 		echo "<script>$('#tempatLahir').val('".$data->tempatLahir."')</script>";
		// 		echo "<script>$('#tanggalLahir').val('".$data->tanggalLahir."')</script>";
		// 	}
		// }


		
		// ============================ ASESI =============================
		function submitAsesi($pass) {
			$data=$_POST;
			$master = $this->db->get_where('masterdata', array('nim'=>$data['nim']));
			if ($master->num_rows() > 0) {
				$login = $this->db->get_where('tblogin', array('nim'=>$data['nim']));
				if (!$login->num_rows()>0) {
					if($master[0]->smester > 7) {
						$data['password']=$pass;
						$this->db->insert('tbasesi',$data);
			
						$dataLogin = array(
							'username' => $data['nim'],
							'password' => $data['password'],
							'level' => '2'
						);
						// $this->db->insert('tblogin',$dataLogin);
						$this->session->set_flashdata('pesan','Data Berhasil Ditambahkan! Password : '.$pass);
					} else {
						$this->session->set_flashdata('pesan', 'Mahasiswa harus semester 7 keatas!');
					}
				} else {
					$this->session->set_flashdata('pesan', 'NIM Sudah mendaftar');
				}
			} else {
				$this->session->set_flashdata('pesan', 'NIM Tidak Terdaftar!');
			}
		}

		function detailAsesi($nim) {
			return  $this->db
			->select('tbskema.kodeSkema, namaSkema, periodeMulai, periodeSelesai, tempat, verifikasiDaftar')
			->from("tbdatakelengkapan")
			->join('tbujian', 'tbujian.idujian = tbdatakelengkapan.idujian')
			->join('tbjadwal', 'tbjadwal.idjadwal = tbujian.idjadwal')
			->join('tbskema', 'tbskema.kodeSkema = tbjadwal.kodeSkema')
			->where('tbujian.nim', $nim)
			->get()
			->result();
			var_dump($query);
		}


		// ============================ JURUSAN ============================
		function submitJurusan() {
			$data=$_POST;
			if (empty($data['nipAdmin'])) {
				$this->session->set_flashdata('pesan', 'Anda Tidak Memiliki Akses!');
			} else if (empty($data['idJurusan'])) {
				$this->db->insert('tbJurusan', $data);
				$this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan!');
			} else {
				$this->db
				->where('idJurusan', $data['idJurusan'])
				->update('tbJurusan', $data);
				$this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
			}
		}


		function editJurusan($idJurusan) {
			$query=$this->db->get_where('tbjurusan', array('idJurusan'=>$idJurusan));
			if ($query->num_rows()>0){
				$data=$query->row();
				echo "<script>$('#idJurusan').val('".$data->idJurusan."');</script>";
				echo "<script>$('#namaJurusan').val('".$data->namaJurusan."');</script>";	
				echo "<script>$('#nipAdmin').val('".$this->session->userdata("Username")."');</script>";
			}
		}
		function hapusJurusan($idJurusan) {
			$this->db->delete('tbJurusan', array('idJurusan'=>$idJurusan));
			$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
		}
		
		// ============================ PRODI =============================
		function submitProdi() {
			$data = $_POST;
			$idProdi = $data['idProdi'];
			$query = $this->db
			->get_where('tbProdi', array('idProdi'=>$idProdi))
			->row();
			if (!empty($query)) {
				$this->db
				->where('idProdi', $data['idProdi'])
				->update('tbProdi', $data);
				$this->session->set_flashdata('pesan', "Data Berhasil Diedit");
			} else {
				$this->db->insert('tbProdi', $data);
				$this->session->set_flashdata('pesan', "Data Berhasil Ditambahkan!");
			}
		}

		function editProdi($idProdi) {
			$query=$this->db->get_where('tbProdi', array('idProdi'=>$idProdi));
			if ($query->num_rows()>0){
				$data=$query->row();
				echo "<script>$('#idProdi').val('".$data->idProdi."');</script>";
				echo "<script>$('#tingkatProdi').val('".$data->tingkatProdi."');</script>";	
				echo "<script>$('#namaProdi').val('".$data->namaProdi."');</script>";
				echo "<script>$('#idJurusan').val('".$data->idJurusan."');</script>";
			}
		}

		function hapusProdi($idProdi) {
			$this->db->delete('tbProdi', array('idProdi' => $idProdi));
			$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus!');
		}
		
		function tes($idProdi) {
			$query=$this->db
         ->select('*')
         ->from('tbProdi')
         ->join('tbJurusan', 'tbJurusan.idJurusan = tbProdi.idJurusan')
         ->get();
			var_dump($query->result());
		}
   }
		
?>