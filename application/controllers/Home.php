<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

	private $api_url = 'https://www.metaweather.com';
	private $location_url = '/api/location/';
	private $header = array('Except:');
	private $live = 0;

	function index() {
		$post = $this->input->post(null,true);
		$get_city = 'jakarta';
		if(isset($post['search'])) {
			$get_city = $post['search'];
		}
		$weather = $this->get_day_forecast($get_city);
	}

	public function get_day_forecast($city) {
		$get_city_api = $this->get_api($this->api_url.$this->location_url.'search/?query='.$city, $this->header);
		
		if(count($get_city_api) >0 ){
			
			$get_day_forecast = $this->get_api($this->api_url.$this->location_url.$get_city_api[0]->woeid.'/', $this->header);
			if(isset($get_day_forecast)) {
				$data['city_name'] = $city;
				$current_sess = $this->session->userdata('cities');
				$cityexists = false;
				if($this->session->has_userdata('cities')){
					for ($i=0; $i < count($current_sess['cities']); $i++) { 
						if(strtolower($current_sess['cities'][$i]) == strtolower($city)) $cityexists = true; 
					}
				}
				if(!$cityexists){
					$current_sess['cities'][] = $city;
					$this->session->set_userdata('cities', $current_sess);
				}
				$this->load->view('vhome', ['weather_data'=>$get_day_forecast],false);
			}else {
				echo "Data cuaca tidak ditemukan";
				return false;
			}
		}else{
			echo "Data kota tidak ditemukan!";
			return false;
		}
		
	}


	private function get_api($url, $headers) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		
		$result=curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	function clearlist() {
		$this->session->sess_destroy();
		redirect(base_url());
	}

}