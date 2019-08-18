<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Blog extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('timeModel');
			$this->load->model('blogModel');
		}


		public function index(){
			$data['blogList']=$this->blogModel->getPostList()->result_array();

			$this->load->view('appinfo');
			$this->load->view('blogList_s');
			$this->load->view('header');
			$this->load->view('blogList_v',$data);
			$this->load->view('template/subscribe_panel');
			$this->load->view('footer');
			$this->load->view('blogList_x');
		}

		public function getPostListAppend(){
    $id=$_POST['id'];
    $totalRowCount = $this->db->query("SELECT *,p.id as idpost FROM blog_post as p  inner join user_admin as u on p.author=u.id WHERE p.id < $id ORDER BY p.id DESC")->num_rows();
    $showLimit=3;
    // Get records from the database
    $query = $this->db->query("SELECT *,p.id as idpost FROM blog_post as p  inner join user_admin as u on p.author=u.id WHERE p.id < $id ORDER BY p.id DESC LIMIT $showLimit");
		$ttlDt=$query->num_rows();
    if($ttlDt > 0){
				$i=0;
        foreach($query->result_array() as $blogPost){
					$i++;
          $data['lastPostID'] = $blogPost['idpost'];
					$data['blogPost']=$blogPost;
					$data['totalRowCount']=$totalRowCount;
					$data['showLimit']=$showLimit;
					$data['ttlDt']=$ttlDt;
					$data['nowDt']=$i;
					$data['append']='TRUE';
					$this->load->view('template_blogList',$data);

    }


    }


  	}


		public function post($slug){
			$data['blogPost']=$this->blogModel->getPost($slug);
			$data['blogPost']=$data['blogPost'][0];
			$data['similarPost']=$this->blogModel->getSimilarPost($data['blogPost']['idpost'],$data['blogPost']['category'])->result_array();

			$this->load->view('appinfo');
			$this->load->view('blogPost_s');
			$this->load->view('header');
			$this->load->view('blogPost_v',$data);
			$this->load->view('template/subscribe_panel');
			$this->load->view('footer');
			$this->load->view('blogPost_x');
		}

	}
