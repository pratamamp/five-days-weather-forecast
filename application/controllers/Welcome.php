<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function index()
	{
		/*$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://www.metaweather.com/api/location/search/?query=indo');
		curl_setopt($curl, CURLOPT_HTTPHEADER,array('Except:'));
		curl_setopt($curl,CURLOPT_TIMEOUT,30);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		print_r(json_decode($response));*/

		$weather = $this->get_day_forecast('jakarta');
		// $weather = file_get_contents(asset_uri().'assets/js/demo_data.json');

		$demo_url = asset_uri().'js/demo_data.json';
		$weather = file_get_contents($demo_url);
		$this->load->view('vhome',['weather_data'=>json_decode($weather)],false);
		// $this->load->view('vhome', ['weather_data'=>$weather],false);
	}

	public function get_day_forecast($city) {
		$get_city_api = $this->get_api($this->api_url.$this->location_url.'search/?query='.$city, $this->header);
		
		if(count($get_city_api) >0 ){
			
			$get_day_forecast = $this->get_api($this->api_url.$this->location_url.$get_city_api[0]->woeid.'/', $this->header);
			if(isset($get_day_forecast)) {
				return $get_day_forecast;
			}else {
				echo "Data cuaca tidak ditemukan";
				return;
			}
		}else{
			echo "Data kota tidak ditemukan!";
			return;
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

}
