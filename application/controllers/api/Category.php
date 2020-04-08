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



    public function all_get()
    {
        $data = [];
        $exit = '';
        $count =0;

        $categories = $this->db->get_where('Category',['category_id'=> null])->result();
        
        foreach ($categories as $key => $value) {
            
            $data[$count] = $key);
            //echo $value->category_id;
            $id = $value->Id;

            while($id != "" ){
                $id 

                $children = $this->CategoryChildren($id);
                foreach ($children as $k => $v) {
                    ///echo $v->Name;
                    //$data[$value->Id][$v->Id] =array($v->Name);
                    $id = $v->category_id;
                }
                //echo $value->Name;
                //echo $value->category_id;
            }
            $count ++;
        }
        echo '<br>----------------------------<br>';     
        echo "<pre>"; print_r ($data);echo "</pre>";
     return 0;
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function CategoryChildren($categoryId){
        return  $this->db->get_where('Category', ["category_id"=>$categoryId])->result();
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