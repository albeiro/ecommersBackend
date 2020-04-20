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
       
    
    public function index_get($id = ""){
    /**
    ********************************************************
    * GET   All/By Id
    ********************************************************
    * @param   {from-data}      {list input to create}
    * @return  {array}          {NewProduct/Error}
    */
        $trm = $this->trm_get();
        if(!empty($id)){
            $data = $this->db->get_where("Product", ['id' => $id])->row_array();
            $data['PriceUsd'] =$data['Price'] * $trm;
        }else{
            $data = $this->db->get("product")->result();
            foreach ($data as $row ) {
                $row->PriceUsd = $row->Price * $trm;
            }
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

    public function byCategory_get($id){
    /**
    ********************************************************
    * GET   All product in categori Id
    ********************************************************
    * @param   {from-data}      {list input to create}
    * @return  {array}          {NewProduct/Error}
    */
        $data = $this->pm->byCategory_get($id);
        
        return $this->response($data, REST_Controller::HTTP_OK);
    }

    function trm_get(){
       $res = (object)json_decode( file_get_contents("http://apilayer.net/api/live?access_key=764c466b080e6137dd9b216e3dbe4189&currencies=COP&source=USD&format=1"), true);

               if(isset($res->quotes['USDCOP'])){
                    return $res->quotes['USDCOP'];
               }else{
                return 0;
               }
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

        if(array_key_exists('category_id', $input)){

             $isChildren = $this->cm->getCategoryByfather_id($input->category_id);

             if(!empty($result) && count($result) >0){
                $error['category_id'] = 'No es un categoria hija.';
             }else{
                $exist = $this->cm->getCategoryById($input->category_id);
                if(empty($exist)){
                    $error['category_id'] = 'No existe.';
                }
             }
        }else{
            $error['category_id']="Requerido" ;
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