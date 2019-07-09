<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->output->enable_profiler(FALSE);

	}
	public function index() {$data=array();
		$data['csv']		=	$this->db->get('emails')->result_array();
		$data['uploaded']	=	count($this->db->get('emails')->result_array());
		$data['viewfile']	=	"home.php";
		$this->load->view("container.php",$data);
	}
	public function crontroller() {
		$this->send();
	}
	public function send($id='') {
		$send_to['is_sent']					=	0;
		$send_to['send_on>']				=	date('Y-m-d H:i:s', strtotime('-1 minutes'));
		$send_to['send_on<']				=	date('Y-m-d H:i:s', strtotime('+1 minutes'));
		if(is_numeric($id)) {
			unset($send_to);
			$send_to['id']	=	$id;
		}
		$emails				=	$this->db->get_where("emails", $send_to)->result_array();
		$sendctr			=	0;
		$update_emails		=	[];
		$update_payslips	=	[];
		if(count($emails)) {
			foreach($emails as $email) {
				if(ENVIRONMENT == 'development') {
					$email['recipient']	=	'';
				}
				$message	=	EMAIL_BODY;
				sendEmail($email['recipient'], $email['subject'], $email['body']);
				$sendctr++;
				$update_emails[]	=	[
					'id' => $email['id'],
					'modified_on' => date('Y-m-d H:i:s'),
					'is_sent' => 1
				];
			}
			if(!empty($update_emails)) $this->db->update_batch('emails', $update_emails, 'id');
		}
		if(isset($_GET['redirect'])) {
			swalert('Emails sent', 'We have sent '.$sendctr.' emails.', 'info');
			redirect(HTTP_PATH);
		}
		echo "<h1>Emails sent: ".$sendctr."</h1>";
	}
} ?>
