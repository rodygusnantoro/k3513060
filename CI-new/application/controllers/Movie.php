<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->library(array('table'));
		$this->load->model('movie_model');
		$this->load->helper(array('url','form'));
		$this->load->model('movie_model','',TRUE);
	}
public function index()
	{
		$data['judul'] = 'TOP Movie';
		$this->load->view('movie', $data);
	}
public function proses_tampil(){
 	$films=$this->movie_model->get_paged_list()->result();
 	$tmpl= array ('table_open' => '<table border="3" align="center" width="70%"/>' );
 	$this->table->set_template($tmpl);
 	$this->table->set_empty("&nbsp;");
 	$this->table->set_heading('ID','Judul','Genre','Tahun','Director');
 	$i =0;
 	foreach ($films as $film){
	 	$this->table->add_row(
	 	++$i,
	 	$film->judul,
	 	$film->genre,
	 	$film->tahun,
	 	$film->director,
	 	anchor('movie/detail3/'.$film->id_movie.'','Detail'),
	 	anchor('movie/update/'.$film->id_movie.'','Edit'),
	 	anchor('movie/hapus/'.$film->id_movie.'','Hapus')
	 	);
 	}
 	$data['table']=$this->table->generate();
 	$this->load->view('tampil',$data);
 	}
 public function detail3($id){
 	$films=$this->movie_model->detail($id)->result();
 	$tmpl= array ('table_open' => '<table border="3" align="center" width="70%"/>' );
 	$this->table->set_template($tmpl);
 	$this->table->set_empty("&nbsp;");
 	$this->table->set_heading('ID','Judul','Genre','Tahun','Sinopsis','Director');
 	$i =0;
 	foreach ($films as $film){
	 	$this->table->add_row(
	 	++$i,
	 	$film->judul,
	 	$film->genre,
	 	$film->tahun,
	 	$film->sinopsis,
	 	$film->director
	 	);
 	}
 	$data['table']=$this->table->generate();
 	$this->load->view('movie_detail',$data);
 	}

 public function proses_cetak(){
 	$films=$this->movie_model->get_paged_list()->result();
 	$tmpl= array ('table_open' => '<table border="3" align="center" width="70%"/>' );
 	$this->table->set_template($tmpl);
 	$this->table->set_empty("&nbsp;");
 	$this->table->set_heading('ID','Judul','Genre','Tahun','Director');
 	$i =0;
 	foreach ($films as $film){
 	$this->table->add_row(
 	++$i,
 	$film->judul,
 	$film->genre,
 	$film->tahun,
 	$film->director
 	);
 	}
 	$data['table']=$this->table->generate();
 	$this->load->view('cetak',$data);
 	}

public function tambah()
	{
		$data['id_movie'] =$this->input->post ('id_movie',true);
		$data['judul'] =$this->input->post ('judul',true);
		$data['genre'] =$this->input->post ('genre',true);
		$data['tahun'] =$this->input->post ('tahun',true);
		$data['director'] =$this->input->post ('director',true);
		$data['tombol'] =$this->input->post ('tombol',true);
		if(!$data['tombol']){}else
 {
	$film=array(
		'id_movie'=>$data['id_movie'],
		'judul'=>$data['judul'],
		'genre'=>$data['genre'],
		'tahun'=>$data['tahun'],
		'director'=>$data['director'],);
	$this->movie_model->save($film);
 }
		$this->load->view('tambah', $data);
	}
public function proses_tambah()
	{
		$this->load->model('movie_model','',TRUE);
		$this->movie_model->tambah_movie();
		redirect('movie/proses_tampil','refresh');
	}
public function cetak_detail($id_movie){
  $data['id_movie']=$id_movie;
  $data_movie=$this->movie_model->detail($id_movie);
 	$tmpl= array ('table_open' => '<table border="3" align="center" width="70%"/>' );
 	$this->table->set_template($tmpl);
 	$this->table->set_empty("&nbsp;");
 	$this->table->set_heading('ID','Judul','Genre','Tahun','Director');
 	$i =0;
 	foreach ($films as $film){
 	$this->table->add_row(
 	++$i,
 	$film->judul,
 	$film->genre,
 	$film->tahun,
 	$film->director,
 	anchor('movie/cetak_detail/'.$film->id_movie.'','Detail'),
 	anchor('movie/update/'.$film->id_movie.'','Edit'),
 	anchor('movie/hapus/'.$film->id_movie.'','Hapus')
 	);
 	}
 	$data['table']=$this->table->generate();

  $this->load->view('movie_detail', $data);
}


 function hapus(){
 	$id=$this->uri->segment(3);
 	$detail=$this->movie_model->hapus($id);
 	$this->movie_model->hapus($id);
 	redirect('movie/proses_tampil','refresh');
 }
 public function update()
	{
		$id = $this->uri->segment(3);
		$update = $this->movie_model->get_by_id($id);
		foreach ($update as $updates) {
			$data['id'] = $updates->id_movie;
			$data['judul'] = $updates->judul;
			$data['genre'] = $updates->genre;
			$data['tahun'] = $updates->tahun;
			$data['sinopsis'] = $updates->sinopsis;
			$data['director'] = $updates->director;
		}
		$this->load->view('update',$data);
	}
public function proses_update()
	{
		$id = $this->uri->segment(3);
		$input_data['judul'] = $_POST['judul'];
		$input_data['genre'] = $_POST['genre'];
		$input_data['tahun'] = $_POST['tahun'];
		$input_data['sinopsis'] = $_POST['sinopsis'];
		$input_data['director'] = $_POST['director'];
		$update = $this->movie_model->update($id,$input_data);
		redirect('movie/proses_tampil','refresh');

	}
}