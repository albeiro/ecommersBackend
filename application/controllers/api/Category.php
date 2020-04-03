<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Category extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->db->get_where("Category", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("Category")->result();
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('Category',$input);
        $id = $this->db->insert_id();
        $data = $this->db->get_where("Category", ['id' => $id])->row_array();
     
        $this->response($data, REST_Controller::HTTP_OK);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('Category', $input, array('id'=>$id));
        $data = $this->db->get_where("Category", ['id' => $id])->row_array();
            
        $this->response($data, REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('Category', array('id'=>$id));
       $data =['mensaje'=>'eliminado'];
        $this->response($data, REST_Controller::HTTP_OK);
    }
    	
}