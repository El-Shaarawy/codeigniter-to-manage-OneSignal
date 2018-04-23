<?php

class Quotes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array( 'form_validation'));
    		$this->load->helper(array('url', 'language','form'));
    }


    // this function will redirect to book service page
    function index()
    {
        $this->subscribe();
    }

    // this function to load service book page
    function subscribe()
    {
      $t=explode("|",$this->input->post('tags'));


      $this->data['user_id']=$t[1];
      $this->data['email']=$t[0];
      $this->load->view('site_subscribe',$this->data);
    }

    function broadcast(){
      $this->load->view('broadcasts/broadcast');
    }
    function sendMessage_broadcast(){
      $message = $this->input->post("message");
      $content = array(
			"en" => $message
			);

		$fields = array(
			'app_id' => APPID,
			'included_segments' => array('All'),
      'data' => array("foo" => "bar"),
			'contents' => $content
		);

		$fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic '.APKEY));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($httpcode == 200)
      $this->session->set_flashdata('message', 'notification sent successfully to everyone');
    else
      $this->session->set_flashdata('message', 'notification not sent');
    redirect('Users/getDevices');
    }



    function sendMessage_playerID($id){

  		$content = array(
  			"en" => 'English Message'
  			);

  		$fields = array(
  			'app_id' => APPID,
  			'include_player_ids' => array("$id"),
  			'data' => array("foo" => "bar"),
  			'contents' => $content
  		);

  		$fields = json_encode($fields);
      	print("\nJSON sent:\n");
      	print($fields);

  		$ch = curl_init();
  		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
  		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
  												   'Authorization: Basic '.APKEY));
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  		curl_setopt($ch, CURLOPT_HEADER, TRUE);
  		curl_setopt($ch, CURLOPT_POST, TRUE);
  		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

  		$response = curl_exec($ch);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  		curl_close($ch);
      if($httpcode == 200)
        $this->session->set_flashdata('message', 'notification sent successfully to a certain id');
      else
        $this->session->set_flashdata('message', 'notification not sent');
      redirect('Users/getDevices');
  		//return $response;
  	}




    /**
     * Create New Notification
     *
     * Creates adjacency list based on item (id or slug) and shows leafs related only to current item
     *
     * @param int $user_id Current user id
     * @param string $title Current title
     *
     * @return string $response
     */
    function sendMessage_tags(){
        $message = $this->input->post("message");
        $email = $this->input->post("email");
        $user_id=$this->input->post("user_id");
		$url = $this->input->post("url");
		$headings = $this->input->post("headings");
		$img = $this->input->post("img");


        $content = array(
            "en" => "$message"
        );
		$headings = array(
            "en" => "$headings"
        );

        $fields = array(
            'app_id' => APPID,
            'filters' => array(array("field" => "tag", "key" => "email", "relation" => "=", "value" => "$email"),array("operator"=>"AND"),
            array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => "$user_id")),
			'url' => $url,
			'contents' => $content,
			'chrome_web_icon' => $img,
			'headings' => $headings
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.APKEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpcode == 200)
          $this->session->set_flashdata('message', 'notification sent successfully to a certain tag');
        else
          $this->session->set_flashdata('message', 'notification not sent');
        redirect('Users/getDevices');
    }

}
/* End of file quotes.php */
/* Location: ./application/controllers/Services.php */
