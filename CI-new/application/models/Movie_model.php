<?php
class movie_model extends CI_Model {
private $primary_key='id_movie';
private $table_name='movie';

function __construct(){
parent:: __construct();
 }

function tambah_movie() {
$data = array(
'id_movie' => $this->input->post('id'),
'judul' => $this->input->post('judul'),
'genre' => $this->input->post('genre'),
'tahun' => $this->input->post('tahun'),
'sinopsis' => $this->input->post('sinopsis'),
'director' => $this->input->post('director')
);
return $this->db->insert('movie', $data);
}

 function get_paged_list()
 {
 return $this->db->get($this->table_name);
 }
 
 function count_all(){
 return $this->db->count_all($this->table_name);
 }

 function get_by_id($id){
 $this->db->where($this->primary_key,$id);
 return $this->db->get($this->table_name)->result();
 }

 function save($person){
 $this->db->insert($this->table_name,$person);
 //return $this->db->insert_id();
 }

 function update($id,$input_data){
 $this->db->where($this->primary_key,$id);
 $this->db->update($this->table_name,$input_data);
 }

 function hapus($id){
 $this->db->where($this->primary_key,$id);
 $this->db->delete($this->table_name);
 }

 function detail($id){
 $this->db->where($this->primary_key,$id);
 return $this->db->get($this->table_name);
 }
 }