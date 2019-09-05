<?php
class API extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('locationModel');
	}

	public function getLocation($STATE,$TYPE){
		switch($TYPE){
			case 'PROVINCE':
				$data1=$this->locationModel->getProvince($STATE);
				break;
			case 'CITY':
				$data1=$this->locationModel->getCity($STATE);
				break;
			case 'ALLCITYANDBELOW':
				$data1=$this->locationModel->getCityIDInAll($STATE);
				$data2=$this->locationModel->getCityBelowIDInAll($STATE);
				$tempArray=array();
				$fixedArray=array();
				foreach($data1 as $data){
					if(!in_array($data['id_nya'],$tempArray)){
								array_push($tempArray,$data['id_nya']);
					}
				}
				foreach($data2 as $data){
					if(!in_array($data['id_nya'],$tempArray)){
								array_push($tempArray,$data['id_nya']);
					}
				}
				foreach($tempArray as $idParent){
					$name=$this->locationModel->getName($idParent);
					$name['children']=$this->locationModel->getCityToChild($idParent);
					array_push($fixedArray,$name);

					$data1=$fixedArray;

				}

				//print_r($fixedArray);

				break;
		}
		header("Content-Type: application/json; charset=UTF-8");




		echo json_encode($data1);

	}





}
