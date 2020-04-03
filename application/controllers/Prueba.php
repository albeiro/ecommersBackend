<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

public function __construct()
{
parent::__construct();
//Do your magic here
$this->load->model(['Producto_model' => 'pm']);
}
public function index()
{
echo "<pre>";
print_r ( json_encode($this->pm->getProducto()));
echo "</pre>";	
}

}

/* End of file Prueba.php */
/* Location: ./application/controllers/Prueba.php */
