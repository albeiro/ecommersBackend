<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Product extends REST_Controller {
    
      /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->model(['Product_model'=>'pm', 'Category_model'=>'cm']);
    }
       
    
    public function index_get($id = 0){
    /**
    ********************************************************
    * GET   All/By Id
    ********************************************************
    * @param   {from-data}      {list input to create}
    * @return  {array}          {NewProduct/Error}
    */
        if(!empty($id)){
            $data = $this->db->get_where("Product", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("product")->result();
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function latest_get($limit){
    /**
    ********************************************************
    * GET   All/By Id
    ********************************************************
    * @param   {from-data}      {list input to create}
    * @return  {array}          {NewProduct/Error}
    */
        $data = $this->pm->LatestProducts($limit);
        $this->response($data, REST_Controller::HTTP_OK);
    }
      


    public function index_post(){
    /**
    ********************************************************
    * POST
    ********************************************************
    * @param   {from-data}      {list input to create}
    * @return  {array}          {NewProduct/Error}
    */
        $error =[];
        $input =(object) $this->input->post();

        if(!array_key_exists('Name', $input)){
             $error['Name'] = 'Requerido' ;
        }

        if(array_key_exists('Category_id', $input)){

             $result = $this->cm->getCategoryBycategory_id($input->Category_id);

             if(count($result) >0){
                $error['Category_id'] = 'No es un categoria hija.';
             }
        }else{
            $error['Category_id']="Requerido" ;
        } 

        if(count($error) == 0){
            $data =$this->pm->InsertProduct($input);     
            $this->response($data, REST_Controller::HTTP_OK);    
        }else{
            $this->response($error, REST_Controller::HTTP_NOT_FOUND);    
        }
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        echo in_array("name", $input) ;
        return 0;
        $this->db->update('Product', $input, array('id'=>$id));
        $data = $this->db->get_where("Product", ['id' => $id])->row_array();
            
        $this->response($data, REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('Product', array('id'=>$id));
       $data =['mensaje'=>'eliminado'];
        $this->response($data, REST_Controller::HTTP_OK);
    }
        
}