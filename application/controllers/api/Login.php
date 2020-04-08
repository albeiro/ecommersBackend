<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Login extends REST_Controller {
    
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
	public function index_get($user,$pass )
	{
        
        $data = $this->db->get_where("Login", ['User' => $user,'Pass' => $pass])->row_array();
     if(empty($data)){

        $this->response($data, REST_Controller::HTTP_UNAUTHORIZED);
    }else{
        $this->db->update('Login', ['Code' => rand(100000,999999)],['Id' => $data['Id'] ]);
        $data = $this->db->get_where("Login", ['User' => $user,'Pass' => $pass])->row_array();
        $this->response($data, REST_Controller::HTTP_OK);
    }
        
     
	}

    public function validate_get($user,$code)
    {
        

        $data = $this->db->get_where("Login", ['User' => $user,'Code' => $code])->row_array();
     if(empty($data)){

        $this->response($data, REST_Controller::HTTP_UNAUTHORIZED);
    }else{
        $this->db->update('Login', ['Code' => null],['Id' => $data['Id'] ]);
        $this->response($data, REST_Controller::HTTP_OK);
    }
        
     
    }
      
        
       	
}