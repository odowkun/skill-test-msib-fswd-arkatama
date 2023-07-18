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
		}
   }
		
?>