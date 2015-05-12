<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mov extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->library(array('table'));
		$this->load->model(array('movie_model'));
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function update()
	{
		$id = $this->uri->segment(3);
		$update = $this->movie_model->get_by_id($id);
		foreach ($update as $updates) {
			$data['judul'] = $updates->judul;
			$data['genre'] = $updates->genre;
			$data['tahun'] = $updates->tahun;
			$data['sinopsis'] = $updates->sinopsis;
			$data['director'] = $updates->director;
		}
		$this->load->view('update',$data);
	}
}
