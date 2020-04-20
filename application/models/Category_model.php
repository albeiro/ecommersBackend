<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	function getCategoryByfather_id($category_id){
		return $this->db->get_where('Category',['Father_id'=> $category_id])->row_array();
	}

	function getAllCategory($category_id){
		return $this->db->get('Category')->row_array();
	}

	function getCategoryById($category_id){
		return $this->db->get_where('Category',['id'=> $category_id])->row_array();
	}

	function  getCategoryfather(){
		return $this->db->query("SELECT distinct category.*
															from category
															left join product on category.Id = product.Category_Id
															where product.Category_Id is NULL")->result();
		
	}
	

}

/* End of file Categoty_model.php */
/* Location: ./application/models/Categoty_model.php */