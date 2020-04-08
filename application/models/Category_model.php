<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	function getCategoryBycategory_id($category_id){
		return $this->db->get_where('Category',['category_id'=> $category_id])->row_array();
	}

	function getAllCategory($category_id){
		return $this->db->get('Category')->row_array();
	}
	

}

/* End of file Categoty_model.php */
/* Location: ./application/models/Categoty_model.php */