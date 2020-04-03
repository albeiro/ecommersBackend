<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	function InsertProduct($input){
		/**
		********************************************************
		* Validate minimum required for create new product
		********************************************************
		* @param   {array}		{list input to create}
		* @return  {boolean} 	{true/false}
		*/

				    
    $this->db->insert('Product',$input);
    $id = $this->db->insert_id();
    return $this->db->get_where("Product", ['id' => $id])->row_array();
	}


	function LatestProducts($limit){
		/**
		********************************************************
		* Select 10 latest products
		********************************************************
		* @return   {array}		{10 latest products}
		*/
				    
    $this->db->order_by('Id', 'asd');//chande des, 
    return  $this->db->get('Product', $limit)->result();
	}

	

}

/* End of file Producto_model.php */
/* Location: ./application/models/Producto_model.php */