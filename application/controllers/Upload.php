<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {
	public function index() {
		redirect(SITEURL);
	}
	public function reference() {
		$post		=	$this->input->post();
		if(!isset($_FILES['reference'])) {
			swalert('File error!', 'You did not specify a file to read!', 'error');
			redirect(HTTP_PATH);
		}
		$uploaded	=	$this->upload_file('reference');
		$csv		=	array_map('str_getcsv', file($uploaded['full_path']));
		$data['filedata']	=	$uploaded;
		$multiInsert		=	[];
		$latest_email_schedule	=	$this->db->query("SELECT MAX(send_on) FROM emails");
		$latest_email_schedule	=	(array)$latest_email_schedule->row();
		$latest_email_schedule	=	$latest_email_schedule['MAX(send_on)'];
		if($latest_email_schedule < date('Y-m-d H:i:s')) $latest_email_schedule	=	date('Y-m-d H:i:s');
		$schedule_offset		=	15;
		$schedule_interval		=	1;
		$email_interval			=	1;
		$interval				=	3;
		if($latest_email_schedule=='') $latest_email_schedule	=	date('Y-m-d H:i:s',strtotime('+'.$schedule_offset.' minutes'));
		$data['multiInsert']	=	[];
		if(empty($csv)) {
			swalert('File content error!', 'The file you uploaded did not have any rows!', 'error');
			redirect(HTTP_PATH);
		}
		if(count($csv) < 500 || count($csv) > 2) {
			unset($csv[0]);
			$ctr	=	0;
			$insertstring	=	'';
			foreach($csv as $rowctr=>$row) {
				if($row[3] == "" || $row[4] == "") unset($data['uploaded'][$rowctr]); // removes rows with blank email and filename columns
				if($row[3] != "" && $row[4] != "") {
					$ctr++;
					$interval--;
					if($interval==0) {
						$interval=5;
						$schedule_interval	=	$schedule_interval + 5;
					}
					$multiInsert[$ctr]	=	[
						"full_name"		=>	$row[2],
						"recipient"		=>	$row[3],
						"subject"		=>	$row[4],
						"body"			=>	$row[5],
						"send_on"		=>	date('Y-m-d H:i:s', strtotime($latest_email_schedule.' +'.($schedule_interval+$schedule_offset).' minutes')),
						"created_by"	=>	0,
						"created_on"	=>	date('Y-m-d H:i:s'),
						"source"		=>	$uploaded['file_name'],
					];
					$insertstring	.=	$this->db->insert_string('emails', $multiInsert[$ctr]).'; ';
				}
			}
			$data['csv']		=	$multiInsert;
			$this->db->delete('emails',['1'=>1]);
			$this->db->query("SET NAMES 'utf8'");
			$this->db->query("SET CHARACTER SET 'utf8'");
			$data['uploaded']	=	$this->db->insert_batch('emails',$multiInsert);
			swalert('Payslip Uploaded!', 'You have uploaded '.$uploaded['file_name'].'!', 'success');
		}
		redirect(HTTP_PATH);
	}
	function upload_file($filetype) {
		$config['upload_path'] = FCPATH .'assets'.'/'.$filetype;
		$config['allowed_types'] = '*';
		$config['remove_spaces'] = false;
		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($filetype)) {
			$upload_data = array('error' => $this->upload->display_errors());
		}
		else {
			$upload_data=$this->upload->data();
		}
		return $upload_data;
	}
}
