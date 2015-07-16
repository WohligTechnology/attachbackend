<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		$this->form_validation->set_rules('dob','dob','trim');
		$this->form_validation->set_rules("creationdate","Creation Date","trim");
        $this->form_validation->set_rules("modificationdate","Modification Date","trim");
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            $dob=$this->input->post('dob');
			$creationdate=$this->input->get_post("creationdate");
            $modificationdate=$this->input->get_post("modificationdate");
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$dob,$creationdate,$modificationdate)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`dob`";
        $elements[5]->sort="1";
        $elements[5]->header="DOB";
        $elements[5]->alias="dob";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`user`.`creationdate`";
        $elements[6]->sort="1";
        $elements[6]->header="Creation Date";
        $elements[6]->alias="creationdate";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`user`.`modificationdate`";
        $elements[7]->sort="1";
        $elements[7]->header="Modification Date";
        $elements[7]->alias="modificationdate";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		$this->form_validation->set_rules('dob','dob','trim');
		$this->form_validation->set_rules("creationdate","Creation Date","trim");
        $this->form_validation->set_rules("modificationdate","Modification Date","trim");
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
			$dob=$this->input->post('dob');
			$creationdate=$this->input->get_post("creationdate");
            $modificationdate=$this->input->get_post("modificationdate");
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$dob,$creationdate,$modificationdate)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    public function viewuserpoll()
{
	$access=array("1");
	$this->checkaccess($access);
	$data["page"]="viewuserpoll";
	$data["base_url"]=site_url("site/viewuserpolljson");
	$data["title"]="View userpoll";
	$this->load->view("template",$data);
}
function viewuserpolljson()
{
	$elements=array();
	$elements[0]=new stdClass();
	$elements[0]->field="`attach_userpoll`.`id`";
	$elements[0]->sort="1";
	$elements[0]->header="ID";
	$elements[0]->alias="id";
	
	$elements[1]=new stdClass();
	$elements[1]->field="`attach_userpoll`.`image`";
	$elements[1]->sort="1";
	$elements[1]->header="Image";
	$elements[1]->alias="image";
	
	$elements[2]=new stdClass();
	$elements[2]->field="`attach_userpoll`.`title`";
	$elements[2]->sort="1";
	$elements[2]->header="Title";
	$elements[2]->alias="title";
	
	$elements[3]=new stdClass();
	$elements[3]->field="`attach_userpoll`.`video`";
	$elements[3]->sort="1";
	$elements[3]->header="Video";
	$elements[3]->alias="video";
	
	$elements[4]=new stdClass();
	$elements[4]->field="`user`.`name`";
	$elements[4]->sort="1";
	$elements[4]->header="User";
	$elements[4]->alias="user";
	
	$elements[5]=new stdClass();
	$elements[5]->field="`attach_userpoll`.`status`";
	$elements[5]->sort="1";
	$elements[5]->header="Status";
	$elements[5]->alias="status";
	
	$elements[6]=new stdClass();
	$elements[6]->field="`attach_userpoll`.`shouldhavecomment`";
	$elements[6]->sort="1";
	$elements[6]->header="Should Have Comment";
	$elements[6]->alias="shouldhavecomment";
	
	$elements[7]=new stdClass();
	$elements[7]->field="`attach_userpoll`.`timestamp`";
	$elements[7]->sort="1";
	$elements[7]->header="Time stamp";
	$elements[7]->alias="timestamp";
	
	$elements[8]=new stdClass();
	$elements[8]->field="`attach_userpoll`.`content`";
	$elements[8]->sort="1";
	$elements[8]->header="Content";
	$elements[8]->alias="content";
	
	$elements[9]=new stdClass();
	$elements[9]->field="`attach_userpoll`.`creationdate`";
	$elements[9]->sort="1";
	$elements[9]->header="Creation Date";
	$elements[9]->alias="creationdate";
	
	$elements[10]=new stdClass();
	$elements[10]->field="`attach_userpoll`.`modificationdate`";
	$elements[10]->sort="1";
	$elements[10]->header="Modification Date";
	$elements[10]->alias="modificationdate";
	
	$search=$this->input->get_post("search");
	$pageno=$this->input->get_post("pageno");
	$orderby=$this->input->get_post("orderby");
	$orderorder=$this->input->get_post("orderorder");
	$maxrow=$this->input->get_post("maxrow");
	if($maxrow=="")
	{
		$maxrow=20;
	}
	if($orderby=="")
	{
		$orderby="id";
		$orderorder="ASC";
	}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpoll` LEFT OUTER JOIN `user` ON `user`.`id`=`attach_userpoll`.`user`");
	$this->load->view("json",$data);
}

public function createuserpoll()
{
	$access=array("1");
	$this->checkaccess($access);
	$data["page"]="createuserpoll";
	$data[ 'user' ] =$this->user_model->getuserdropdown();	
	$data[ 'shouldhavecomment' ] =$this->user_model->getshouldhavecommentdropdown();	
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data["title"]="Create userpoll";
	$this->load->view("template",$data);
}
public function createuserpollsubmit() 
{
	$access=array("1");
	$this->checkaccess($access);
	$this->form_validation->set_rules("image","Image","trim");
	$this->form_validation->set_rules("title","Title","trim");
	$this->form_validation->set_rules("video","Video","trim");
	$this->form_validation->set_rules("user","User","trim");
	$this->form_validation->set_rules("status","Status","trim");
	$this->form_validation->set_rules("shouldhavecomment","Should Have Comment","trim");
	$this->form_validation->set_rules("timestamp","Time stamp","trim");
	$this->form_validation->set_rules("content","Content","trim");
	$this->form_validation->set_rules("creationdate","Creation Date","trim");
	$this->form_validation->set_rules("modificationdate","Modification Date","trim");
	if($this->form_validation->run()==FALSE)
	{
		$data["alerterror"]=validation_errors();
		$data["page"]="createuserpoll";
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'shouldhavecomment' ] =$this->user_model->getshouldhavecommentdropdown();	
		$data[ 'user' ] =$this->user_model->getuserdropdown();
		$data["title"]="Create userpoll";
		$this->load->view("template",$data);
	}
	else
	{
//		$image=$this->input->get_post("image");
		$title=$this->input->get_post("title");
		//$video=$this->input->get_post("video");
		$user=$this->input->get_post("user");
		$status=$this->input->get_post("status");
		$shouldhavecomment=$this->input->get_post("shouldhavecomment");
		$timestamp=$this->input->get_post("timestamp");
		$content=$this->input->get_post("content");
		$creationdate=$this->input->get_post("creationdate");
		$modificationdate=$this->input->get_post("modificationdate");
		       
			 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
		
		
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'mp4|3gp|flv|mp3';
				$this->load->library('upload', $config);
				$filename="video";
				$video="";
				if (  $this->upload->do_upload($filename))
				{
					$uploaddata = $this->upload->data();
					$video=$uploaddata['file_name'];
				}
	if($this->userpoll_model->create($image,$title,$video,$user,$status,$shouldhavecomment,$timestamp,$content,$creationdate,$modificationdate)==0)
		$data["alerterror"]="New userpoll could not be created.";
	else
	$data["alertsuccess"]="userpoll created Successfully.";
	$data["redirect"]="site/viewuserpoll";
	$this->load->view("redirect",$data);
	
}
}
public function edituserpoll()
{
	$access=array("1");
	$this->checkaccess($access);
	$data["page"]="edituserpoll";
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'shouldhavecomment' ] =$this->user_model->getshouldhavecommentdropdown();	
	$data["title"]="Edit userpoll";
	$data[ 'user' ] =$this->user_model->getuserdropdown();
	$data["before"]=$this->userpoll_model->beforeedit($this->input->get("id"));
	$this->load->view("template",$data);
}
public function edituserpollsubmit()
{
	$access=array("1");
	$this->checkaccess($access);
	$this->form_validation->set_rules("id","ID","trim");
	$this->form_validation->set_rules("image","Image","trim");
	$this->form_validation->set_rules("title","Title","trim");
	$this->form_validation->set_rules("video","Video","trim");
	$this->form_validation->set_rules("user","User","trim");
	$this->form_validation->set_rules("status","Status","trim");
	$this->form_validation->set_rules("shouldhavecomment","Should Have Comment","trim");
	$this->form_validation->set_rules("timestamp","Time stamp","trim");
	$this->form_validation->set_rules("content","Content","trim");
	$this->form_validation->set_rules("creationdate","Creation Date","trim");
	$this->form_validation->set_rules("modificationdate","Modification Date","trim");
		if($this->form_validation->run()==FALSE)
		{
			$data["alerterror"]=validation_errors();
			$data["page"]="edituserpoll";
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data[ 'shouldhavecomment' ] =$this->user_model->getshouldhavecommentdropdown();	
			$data[ 'user' ] =$this->user_model->getuserdropdown();
			$data["title"]="Edit userpoll";
			$data["before"]=$this->userpoll_model->beforeedit($this->input->get("id"));
			$this->load->view("template",$data);
		}
		else
		{
	$id=$this->input->get_post("id");
	$image=$this->input->get_post("image");
	$title=$this->input->get_post("title");
	$video=$this->input->get_post("video");
	$user=$this->input->get_post("user");
	$status=$this->input->get_post("status");
	$shouldhavecomment=$this->input->get_post("shouldhavecomment");
	$timestamp=$this->input->get_post("timestamp");
	$content=$this->input->get_post("content");
	$creationdate=$this->input->get_post("creationdate");
	$modificationdate=$this->input->get_post("modificationdate");
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
			
			
			
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'mp4|3gp|flv|mp3';
				$this->load->library('upload', $config);
				$filename="video";
				$video="";
				if (  $this->upload->do_upload($filename))
				{
					$uploaddata = $this->upload->data();
					$video=$uploaddata['file_name'];
				}

				if($video=="")
				{
				$video=$this->movie_model->gettrailerbyid($id);
				   // print_r($image);
					$video=$video->video;
				}
	if($this->userpoll_model->edit($id,$image,$title,$video,$user,$status,$shouldhavecomment,$timestamp,$content,$creationdate,$modificationdate)==0)
		$data["alerterror"]="New userpoll could not be Updated.";
		else
		$data["alertsuccess"]="userpoll Updated Successfully.";
		$data["redirect"]="site/viewuserpoll";
		$this->load->view("redirect",$data);
		}
}
public function deleteuserpoll()
{
	$access=array("1");
	$this->checkaccess($access);
	$this->userpoll_model->delete($this->input->get("id"));
	$data["redirect"]="site/viewuserpoll";
	$this->load->view("redirect",$data);
}
public function viewuserpolloption()
{
	$access=array("1");
	$this->checkaccess($access);
	$data["page"]="viewuserpolloption";
	$data[ 'user' ] =$this->user_model->getuserdropdown();
	$data["base_url"]=site_url("site/viewuserpolloptionjson");
	$data["title"]="View userpolloption";
	$this->load->view("template",$data);
}
function viewuserpolloptionjson()
{
	$elements=array();
	$elements[0]=new stdClass();
	$elements[0]->field="`attach_userpolloption`.`id`";
	$elements[0]->sort="1";
	$elements[0]->header="ID";
	$elements[0]->alias="id";
	
	$elements[1]=new stdClass();
	$elements[1]->field="`attach_userpolloption`.`image`";
	$elements[1]->sort="1";
	$elements[1]->header="Image";
	$elements[1]->alias="image";
	
	$elements[2]=new stdClass();
	$elements[2]->field="`attach_userpolloption`.`order`";
	$elements[2]->sort="1";
	$elements[2]->header="Order";
	$elements[2]->alias="order";
	
	$elements[3]=new stdClass();
	$elements[3]->field="`attach_userpoll`.`title`";
	$elements[3]->sort="1";
	$elements[3]->header="User Poll";
	$elements[3]->alias="userpoll";
	
	$elements[4]=new stdClass();
	$elements[4]->field="`attach_userpolloption`.`timestamp`";
	$elements[4]->sort="1";
	$elements[4]->header="Time stamp";
	$elements[4]->alias="timestamp";
	
	$elements[5]=new stdClass();
	$elements[5]->field="`attach_userpolloption`.`text`";
	$elements[5]->sort="1";
	$elements[5]->header="Text";
	$elements[5]->alias="text";
	
	$elements[6]=new stdClass();
	$elements[6]->field="`attach_userpolloption`.`creationdate`";
	$elements[6]->sort="1";
	$elements[6]->header="Creation Date";
	$elements[6]->alias="creationdate";
	
	$elements[7]=new stdClass();
	$elements[7]->field="`attach_userpolloption`.`modificationdate`";
	$elements[7]->sort="1";
	$elements[7]->header="Modification Date";
	$elements[7]->alias="modificationdate";
	
	$search=$this->input->get_post("search");
	$pageno=$this->input->get_post("pageno");
	$orderby=$this->input->get_post("orderby");
	$orderorder=$this->input->get_post("orderorder");
	$maxrow=$this->input->get_post("maxrow");
		if($maxrow=="")
	{
		$maxrow=20;
	}
		if($orderby=="")
	{
		$orderby="id";
		$orderorder="ASC";
	}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpolloption` LEFT OUTER JOIN `attach_userpoll` ON `attach_userpoll`.`id`=`attach_userpolloption`.`userpoll`");
	$this->load->view("json",$data);
}

public function createuserpolloption()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createuserpolloption";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data["title"]="Create userpolloption";
$this->load->view("template",$data);
}
public function createuserpolloptionsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("text","Text","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createuserpolloption";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data["title"]="Create userpolloption";
$this->load->view("template",$data);
}
else
{
//$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
$userpoll=$this->input->get_post("userpoll");
$timestamp=$this->input->get_post("timestamp");
$text=$this->input->get_post("text");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
	 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->userpolloption_model->create($image,$order,$userpoll,$timestamp,$text,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpolloption could not be created.";
else
$data["alertsuccess"]="userpolloption created Successfully.";
$data["redirect"]="site/viewuserpolloption";
$this->load->view("redirect",$data);
}
}
public function edituserpolloption()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edituserpolloption";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data["title"]="Edit userpolloption";
$data["before"]=$this->userpolloption_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edituserpolloptionsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("text","Text","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edituserpolloption";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data["title"]="Edit userpolloption";
$data["before"]=$this->userpolloption_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$image=$this->input->get_post("image");
$order=$this->input->get_post("order");
$userpoll=$this->input->get_post("userpoll");
$timestamp=$this->input->get_post("timestamp");
$text=$this->input->get_post("text");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
	
	          $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
			
if($this->userpolloption_model->edit($id,$image,$order,$userpoll,$timestamp,$text,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpolloption could not be Updated.";
else
$data["alertsuccess"]="userpolloption Updated Successfully.";
$data["redirect"]="site/viewuserpolloption";
$this->load->view("redirect",$data);
}
}
public function deleteuserpolloption()
{
$access=array("1");
$this->checkaccess($access);
$this->userpolloption_model->delete($this->input->get("id"));
$data["redirect"]="site/viewuserpolloption";
$this->load->view("redirect",$data);
}
public function viewuserpollresponse()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewuserpollresponse";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["base_url"]=site_url("site/viewuserpollresponsejson");
$data["title"]="View userpollresponse";
$this->load->view("template",$data);
}
function viewuserpollresponsejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`attach_userpollresponse`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`attach_userpolloption`.`text`";
$elements[1]->sort="1";
$elements[1]->header="User Poll Option";
$elements[1]->alias="userpolloption";
$elements[2]=new stdClass();
$elements[2]->field="`attach_userpoll`.`title`";
$elements[2]->sort="1";
$elements[2]->header="User Poll";
$elements[2]->alias="userpoll";
$elements[3]=new stdClass();
$elements[3]->field="`user`.`name`";
$elements[3]->sort="1";
$elements[3]->header="User";
$elements[3]->alias="user";
$elements[4]=new stdClass();
$elements[4]->field="`attach_userpollresponse`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Time stamp";
$elements[4]->alias="timestamp";
$elements[5]=new stdClass();
$elements[5]->field="`attach_userpollresponse`.`creationdate`";
$elements[5]->sort="1";
$elements[5]->header="Creation Date";
$elements[5]->alias="creationdate";
$elements[6]=new stdClass();
$elements[6]->field="`attach_userpollresponse`.`modificationdate`";
$elements[6]->sort="1";
$elements[6]->header="Modification Date";
$elements[6]->alias="modificationdate";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpollresponse` LEFT OUTER JOIN `attach_userpoll` ON `attach_userpoll`.`id`=`attach_userpollresponse`.`userpoll` LEFT OUTER JOIN `user` ON `user`.`id`=`attach_userpollresponse`.`user` LEFT OUTER JOIN `attach_userpolloption` ON `attach_userpolloption`.`id`=`attach_userpollresponse`.`userpolloption`");
$this->load->view("json",$data);
}

public function createuserpollresponse()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createuserpollresponse";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'userpolloption' ] =$this->userpolloption_model->getuserpolloptiondropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userpollresponse";
$this->load->view("template",$data);
}
public function createuserpollresponsesubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("userpolloption","User Poll Option","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createuserpollresponse";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data["title"]="Create userpollresponse";
$this->load->view("template",$data);
}
else
{
$userpolloption=$this->input->get_post("userpolloption");
$userpoll=$this->input->get_post("userpoll");
$user=$this->input->get_post("user");
$timestamp=$this->input->get_post("timestamp");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userpollresponse_model->create($userpolloption,$userpoll,$user,$timestamp,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpollresponse could not be created.";
else
$data["alertsuccess"]="userpollresponse created Successfully.";
$data["redirect"]="site/viewuserpollresponse";
$this->load->view("redirect",$data);
}
}
public function edituserpollresponse()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edituserpollresponse";
$data[ 'userpolloption' ] =$this->userpolloption_model->getuserpolloptiondropdown();
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userpollresponse";
$data["before"]=$this->userpollresponse_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edituserpollresponsesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("userpolloption","User Poll Option","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edituserpollresponse";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userpollresponse";
$data["before"]=$this->userpollresponse_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$userpolloption=$this->input->get_post("userpolloption");
$userpoll=$this->input->get_post("userpoll");
$user=$this->input->get_post("user");
$timestamp=$this->input->get_post("timestamp");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userpollresponse_model->edit($id,$userpolloption,$userpoll,$user,$timestamp,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpollresponse could not be Updated.";
else
$data["alertsuccess"]="userpollresponse Updated Successfully.";
$data["redirect"]="site/viewuserpollresponse";
$this->load->view("redirect",$data);
}
}
public function deleteuserpollresponse()
{
$access=array("1");
$this->checkaccess($access);
$this->userpollresponse_model->delete($this->input->get("id"));
$data["redirect"]="site/viewuserpollresponse";
$this->load->view("redirect",$data);
}
public function viewuserpollfavourites()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewuserpollfavourites";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["base_url"]=site_url("site/viewuserpollfavouritesjson");
$data["title"]="View userpollfavourites";
$this->load->view("template",$data);
}
function viewuserpollfavouritesjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`attach_userpollfavourites`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`user`.`name`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`attach_userpoll`.`title`";
$elements[2]->sort="1";
$elements[2]->header="User Poll";
$elements[2]->alias="userpoll";
$elements[3]=new stdClass();
$elements[3]->field="`attach_userpollfavourites`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Time stamp";
$elements[3]->alias="timestamp";
$elements[4]=new stdClass();
$elements[4]->field="`attach_userpollfavourites`.`creationdate`";
$elements[4]->sort="1";
$elements[4]->header="Creation Date";
$elements[4]->alias="creationdate";
$elements[5]=new stdClass();
$elements[5]->field="`attach_userpollfavourites`.`modificationdate`";
$elements[5]->sort="1";
$elements[5]->header="Modification Date";
$elements[5]->alias="modificationdate";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpollfavourites` LEFT OUTER JOIN `user` ON `user`.`id`=`attach_userpollfavourites`.`user` LEFT OUTER JOIN `attach_userpoll` ON `attach_userpoll`.`id`=`attach_userpollfavourites`.`userpoll`");
$this->load->view("json",$data);
}

public function createuserpollfavourites()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createuserpollfavourites";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userpollfavourites";
$this->load->view("template",$data);
}
public function createuserpollfavouritessubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createuserpollfavourites";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data["title"]="Create userpollfavourites";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$userpoll=$this->input->get_post("userpoll");
$timestamp=$this->input->get_post("timestamp");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userpollfavourites_model->create($user,$userpoll,$timestamp,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpollfavourites could not be created.";
else
$data["alertsuccess"]="userpollfavourites created Successfully.";
$data["redirect"]="site/viewuserpollfavourites";
$this->load->view("redirect",$data);
}
}
public function edituserpollfavourites()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edituserpollfavourites";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userpollfavourites";
$data["before"]=$this->userpollfavourites_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edituserpollfavouritessubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edituserpollfavourites";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data["title"]="Edit userpollfavourites";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["before"]=$this->userpollfavourites_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$userpoll=$this->input->get_post("userpoll");
$timestamp=$this->input->get_post("timestamp");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userpollfavourites_model->edit($id,$user,$userpoll,$timestamp,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpollfavourites could not be Updated.";
else
$data["alertsuccess"]="userpollfavourites Updated Successfully.";
$data["redirect"]="site/viewuserpollfavourites";
$this->load->view("redirect",$data);
}
}
public function deleteuserpollfavourites()
{
$access=array("1");
$this->checkaccess($access);
$this->userpollfavourites_model->delete($this->input->get("id"));
$data["redirect"]="site/viewuserpollfavourites";
$this->load->view("redirect",$data);
}
public function viewuserpollcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewuserpollcomment";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["base_url"]=site_url("site/viewuserpollcommentjson");
$data["title"]="View userpollcomment";
$this->load->view("template",$data);
}
function viewuserpollcommentjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`attach_userpollcomment`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`user`.`name`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`attach_userpoll`.`title`";
$elements[2]->sort="1";
$elements[2]->header="User Poll";
$elements[2]->alias="userpoll";
$elements[3]=new stdClass();
$elements[3]->field="`attach_userpollcomment`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`attach_userpollcomment`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Time stamp";
$elements[4]->alias="timestamp";
$elements[5]=new stdClass();
$elements[5]->field="`attach_userpollcomment`.`content`";
$elements[5]->sort="1";
$elements[5]->header="Content";
$elements[5]->alias="content";
$elements[6]=new stdClass();
$elements[6]->field="`attach_userpollcomment`.`creationdate`";
$elements[6]->sort="1";
$elements[6]->header="Creation Date";
$elements[6]->alias="creationdate";
$elements[7]=new stdClass();
$elements[7]->field="`attach_userpollcomment`.`modificationdate`";
$elements[7]->sort="1";
$elements[7]->header="Modification Date";
$elements[7]->alias="modificationdate";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpollcomment` LEFT OUTER JOIN `attach_userpoll` ON `attach_userpoll`.`id`=`attach_userpollcomment`.`userpoll` LEFT OUTER JOIN `user` ON `user`.`id`=`attach_userpollcomment`.`user`");
$this->load->view("json",$data);
}

public function createuserpollcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createuserpollcomment";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userpollcomment";
$this->load->view("template",$data);
}
public function createuserpollcommentsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createuserpollcomment";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userpollcomment";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$userpoll=$this->input->get_post("userpoll");
$status=$this->input->get_post("status");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userpollcomment_model->create($user,$userpoll,$status,$timestamp,$content,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpollcomment could not be created.";
else
$data["alertsuccess"]="userpollcomment created Successfully.";
$data["redirect"]="site/viewuserpollcomment";
$this->load->view("redirect",$data);
}
}
public function edituserpollcomment()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edituserpollcomment";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userpollcomment";
$data["before"]=$this->userpollcomment_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edituserpollcommentsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("userpoll","User Poll","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edituserpollcomment";
$data[ 'userpoll' ] =$this->userpoll_model->getuserpolldropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userpollcomment";
$data["before"]=$this->userpollcomment_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$userpoll=$this->input->get_post("userpoll");
$status=$this->input->get_post("status");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userpollcomment_model->edit($id,$user,$userpoll,$status,$timestamp,$content,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userpollcomment could not be Updated.";
else
$data["alertsuccess"]="userpollcomment Updated Successfully.";
$data["redirect"]="site/viewuserpollcomment";
$this->load->view("redirect",$data);
}
}
public function deleteuserpollcomment()
{
$access=array("1");
$this->checkaccess($access);
$this->userpollcomment_model->delete($this->input->get("id"));
$data["redirect"]="site/viewuserpollcomment";
$this->load->view("redirect",$data);
}
public function viewuserfollow()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewuserfollow";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["base_url"]=site_url("site/viewuserfollowjson");
$data["title"]="View userfollow";
$this->load->view("template",$data);
}
function viewuserfollowjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`attach_userfollow`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`tab1`.`name`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`tab2`.`name`";
$elements[2]->sort="1";
$elements[2]->header="User Followed";
$elements[2]->alias="userfollowed";
$elements[3]=new stdClass();
$elements[3]->field="`attach_userfollow`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Time stamp";
$elements[3]->alias="timestamp";
$elements[4]=new stdClass();
$elements[4]->field="`attach_userfollow`.`creationdate`";
$elements[4]->sort="1";
$elements[4]->header="Creation Date";
$elements[4]->alias="creationdate";
$elements[5]=new stdClass();
$elements[5]->field="`attach_userfollow`.`modificationdate`";
$elements[5]->sort="1";
$elements[5]->header="Modification Date";
$elements[5]->alias="modificationdate";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userfollow` LEFT OUTER JOIN `user` as `tab1` ON `tab1`.`id`=`attach_userfollow`.`user` LEFT OUTER JOIN `user` as `tab2` ON `tab2`.`id`=`attach_userfollow`.`userfollowed`");
$this->load->view("json",$data);
}

public function createuserfollow()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createuserfollow";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data[ 'userfollowed' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userfollow";
$this->load->view("template",$data);
}
public function createuserfollowsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("userfollowed","User Followed","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createuserfollow";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data[ 'userfollowed' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userfollow";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$userfollowed=$this->input->get_post("userfollowed");
$timestamp=$this->input->get_post("timestamp");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userfollow_model->create($user,$userfollowed,$timestamp,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userfollow could not be created.";
else
$data["alertsuccess"]="userfollow created Successfully.";
$data["redirect"]="site/viewuserfollow";
$this->load->view("redirect",$data);
}
}
public function edituserfollow()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edituserfollow";
$data[ 'userfollowed' ] =$this->user_model->getuserdropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userfollow";
$data["before"]=$this->userfollow_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function edituserfollowsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("userfollowed","User Followed","trim");
$this->form_validation->set_rules("timestamp","Time stamp","trim");
$this->form_validation->set_rules("creationdate","Creation Date","trim");
$this->form_validation->set_rules("modificationdate","Modification Date","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edituserfollow";
$data[ 'userfollowed' ] =$this->user_model->getuserdropdown();
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userfollow";
$data["before"]=$this->userfollow_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$userfollowed=$this->input->get_post("userfollowed");
$timestamp=$this->input->get_post("timestamp");
$creationdate=$this->input->get_post("creationdate");
$modificationdate=$this->input->get_post("modificationdate");
if($this->userfollow_model->edit($id,$user,$userfollowed,$timestamp,$creationdate,$modificationdate)==0)
$data["alerterror"]="New userfollow could not be Updated.";
else
$data["alertsuccess"]="userfollow Updated Successfully.";
$data["redirect"]="site/viewuserfollow";
$this->load->view("redirect",$data);
}
}
public function deleteuserfollow()
{
$access=array("1");
$this->checkaccess($access);
$this->userfollow_model->delete($this->input->get("id"));
$data["redirect"]="site/viewuserfollow";
$this->load->view("redirect",$data);
}

}
?>
