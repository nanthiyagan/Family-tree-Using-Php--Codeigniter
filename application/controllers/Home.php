<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  include APPPATH.'third_party/Wkhtmltopdf.php';
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
	 public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        parent::__construct();
        $this->load->model('familytree_m', 'familytree');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->library("session");
    }
	public function index()
	{
		$data = array();
		$data['title'] = 'Home';
		$config = array();
        $config["base_url"] = base_url().'home/index';
        $config["total_rows"] = $this->familytree->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["data"] = $this->familytree->get_node($config["per_page"], $page);
       // print_r($data);exit;
		$this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        
		
		$this->template->load('default_layout', 'contents' , 'home', $data);
	}

	public function profile($id)
	{
		$data = array();
		$this->template->set('title', 'profile view');
		$data["data"] = $this->familytree->get_node('', '', $id);
		$this->template->load('default_layout', 'contents' , 'profile', $data);
	}
	public function edit($id)
	{
		$data = array();
        $data['sele_val']=$this->familytree->getAll();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'numeric|xss_clean');
        $this->form_validation->set_rules('alt_contact_no', 'Aternate Contact No', 'numeric|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
        if ($this->form_validation->run() === FALSE)
        {
			$data["data"] = $this->familytree->get_node('', '', $id);
			$this->template->set('title', 'Profile edit - '.$data["data"]['name']);
            $this->template->load('default_layout', 'contents' , 'edit', $data);

        }
        else
        {
            $img_path="test";
            $this->familytree->saveNode($id,$img_path);
            redirect( base_url());
        }
		
		
	}
    public function about()
    {
        $this->db->select("*");
        $this->db->from("familytree");
        $query = $this->db->get();
        $data=$query->result();
        $i=0;
        $cleanarray = array();
        foreach ($data as $innerphrase) {
                    $cleanarray[$i] = $innerphrase;
                    $i++;
        }
        $array2 =  array();  // create a new array
        $array2['contents']= $cleanarray; // add $cleanarray to the new array
        $this->load->view('about', $array2);
    }
    public function generateimage()
    {
        /*try {
            $wkhtmltopdf = new Wkhtmltopdf(array('path' =>'./uploads/'));
            $wkhtmltopdf->setTitle("Title");
            $wkhtmltopdf->setHtml("new test");
            $wkhtmltopdf->output(Wkhtmltopdf::MODE_DOWNLOAD, "file.png");
        } catch (Exception $e) {
            echo $e->getMessage();
        }*/
        $img = $_POST['data']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents('./uploads/'.time().'.png', $data);
        echo 1;
    }
	public function create()
	{
		$data = array();
		$data['sele_val']=$this->familytree->getAll();
		//print_r($data);exit;
		$this->template->set('title', 'Add New');
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'numeric|xss_clean');
        $this->form_validation->set_rules('alt_contact_no', 'Aternate Contact No', 'numeric|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
        if ($this->form_validation->run() === FALSE)
        {
			$data["data"] = array();
            $this->template->load('default_layout', 'contents' , 'create', $data);
        }
        else
        {
            if (!empty($_FILES['profile_image_localtion']['name'])) {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('profile_image_localtion'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $this->template->load('default_layout', 'contents' , 'create', $data);
                }
            }

            $this->familytree->saveNode(0,$_FILES['profile_image_localtion']['name']);
            redirect(base_url());
        }
		
		
	}

    public function delete($id)
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
                
        $news_item = $this->familytree->get_node('', '', $id);;
        
        if($this->familytree->delete_node($id)){
			$this->session->set_flashdata('message', 'Deleted Sucessfully');

			redirect( base_url());  
		}		
    }
	
}
