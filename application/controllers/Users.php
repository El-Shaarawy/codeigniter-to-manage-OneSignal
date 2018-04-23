<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

   function __construct()
   {
       parent::__construct();
       $this->load->library(array( 'form_validation'));
      $this->load->helper(array('url', 'language','form'));
   }

	public function index()
	{
		$this->getDevices();
	}


  // NOTE: Only fetches the first 300 devices.
  //       Will need to add looping with offset to get all devices.
  function getDevices(){
    $app_id = APPID;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players?app_id=" . $app_id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                                               'Authorization: Basic '.APKEY));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $response = curl_exec($ch);
    curl_close($ch);
    $return = json_decode( $response);
    $this->data['players']=$return->players;
    //print("\n\nJSON received:\n");
  //  print_r(($return));
    //print_r(($return->players));      //get a tag of a device in a certain row
    //print_r(($return->players[0])->tags);      get a tag of a device in a certain row
    //print("\n");
    $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
    $this->load->view("devices/index",$this->data);
  }
}
