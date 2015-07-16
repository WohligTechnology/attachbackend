<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getalluserpoll()
{
	$data = json_decode(file_get_contents('php://input'), true);
    $id=$data['id'];
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
	$elements[4]->field="`attach_userpoll`.`user`";
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
	}
		if($orderby=="")
	{
		$orderby="id";
		$orderorder="ASC";
	}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpoll`","WHERE `attach_userpoll`.`user`='$id'");
	$this->load->view("json",$data);
}
public function getsingleuserpoll()
{
	$id=$this->input->get_post("id");
	$data["message"]=$this->userpoll_model->getsingleuserpoll($id);
	$this->load->view("json",$data);
}
function getalluserpolloption()
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
	$elements[3]->field="`attach_userpolloption`.`userpoll`";
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
	}
	if($orderby=="")
	{
	$orderby="id";
	$orderorder="ASC";
	}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpolloption`");
	$this->load->view("json",$data);
}
public function getsingleuserpolloption()
{
	$id=$this->input->get_post("id");
	$data["message"]=$this->userpolloption_model->getsingleuserpolloption($id);
	$this->load->view("json",$data);
}
function getalluserpollresponse()
{
	$elements=array();
	$elements[0]=new stdClass();
	$elements[0]->field="`attach_userpollresponse`.`id`";
	$elements[0]->sort="1";
	$elements[0]->header="ID";
	$elements[0]->alias="id";

	$elements[1]=new stdClass();
	$elements[1]->field="`attach_userpollresponse`.`userpolloption`";
	$elements[1]->sort="1";
	$elements[1]->header="User Poll Option";
	$elements[1]->alias="userpolloption";

	$elements[2]=new stdClass();
	$elements[2]->field="`attach_userpollresponse`.`userpoll`";
	$elements[2]->sort="1";
	$elements[2]->header="User Poll";
	$elements[2]->alias="userpoll";

	$elements[3]=new stdClass();
	$elements[3]->field="`attach_userpollresponse`.`user`";
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
		}
	if($orderby=="")
		{
	$orderby="id";
	$orderorder="ASC";
		}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpollresponse`");
	$this->load->view("json",$data);
}
public function getsingleuserpollresponse()
{
	$id=$this->input->get_post("id");
	$data["message"]=$this->userpollresponse_model->getsingleuserpollresponse($id);
	$this->load->view("json",$data);
}
function getalluserpollfavourites()
{
	$elements=array();
	$elements[0]=new stdClass();
	$elements[0]->field="`attach_userpollfavourites`.`id`";
	$elements[0]->sort="1";
	$elements[0]->header="ID";
	$elements[0]->alias="id";

	$elements[1]=new stdClass();
	$elements[1]->field="`attach_userpollfavourites`.`user`";
	$elements[1]->sort="1";
	$elements[1]->header="User";
	$elements[1]->alias="user";

	$elements[2]=new stdClass();
	$elements[2]->field="`attach_userpollfavourites`.`userpoll`";
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
		}
	if($orderby=="")
		{
	$orderby="id";
	$orderorder="ASC";
		}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userpollfavourites`");
	$this->load->view("json",$data);
}
public function getsingleuserpollfavourites()
{
	$id=$this->input->get_post("id");
	$data["message"]=$this->userpollfavourites_model->getsingleuserpollfavourites($id);
	$this->load->view("json",$data);
}
function getalluserpollcomment()
{
	$data = json_decode(file_get_contents('php://input'), true);
    $userpoll=$data['id'];
	$elements=array();
	$elements[0]=new stdClass();
	$elements[0]->field="`attach_userpollcomment`.`id`";
	$elements[0]->sort="1";
	$elements[0]->header="ID";
	$elements[0]->alias="id";

	$elements[1]=new stdClass();
	$elements[1]->field="`attach_userpollcomment`.`user`";
	$elements[1]->sort="1";
	$elements[1]->header="User";
	$elements[1]->alias="user";

	$elements[2]=new stdClass();
	$elements[2]->field="`attach_userpollcomment`.`userpoll`";
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
	  }
	if($orderby=="")
	{
		$orderby="id";
		$orderorder="ASC";
	}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM 			`attach_userpollcomment`","WHERE `attach_userpollcomment`.`userpoll`='$userpoll'");
	$this->load->view("json",$data);
}
public function getsingleuserpollcomment()
{
	$id=$this->input->get_post("id");
	$data["message"]=$this->userpollcomment_model->getsingleuserpollcomment($id);
	$this->load->view("json",$data);
}
function getalluserfollow()
{
	$elements=array();
	$elements[0]=new stdClass();
	$elements[0]->field="`attach_userfollow`.`id`";
	$elements[0]->sort="1";
	$elements[0]->header="ID";
	$elements[0]->alias="id";

	$elements=array();
	$elements[1]=new stdClass();
	$elements[1]->field="`attach_userfollow`.`user`";
	$elements[1]->sort="1";
	$elements[1]->header="User";
	$elements[1]->alias="user";

	$elements=array();
	$elements[2]=new stdClass();
	$elements[2]->field="`attach_userfollow`.`userfollowed`";
	$elements[2]->sort="1";
	$elements[2]->header="User Followed";
	$elements[2]->alias="userfollowed";

	$elements=array();
	$elements[3]=new stdClass();
	$elements[3]->field="`attach_userfollow`.`timestamp`";
	$elements[3]->sort="1";
	$elements[3]->header="Time stamp";
	$elements[3]->alias="timestamp";

	$elements=array();
	$elements[4]=new stdClass();
	$elements[4]->field="`attach_userfollow`.`creationdate`";
	$elements[4]->sort="1";
	$elements[4]->header="Creation Date";
	$elements[4]->alias="creationdate";

	$elements=array();
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
		}
	if($orderby=="")
		{
	  		$orderby="id";
	  		$orderorder="ASC";
		}
	$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `attach_userfollow`");
	$this->load->view("json",$data);
}
public function getsingleuserfollow()
	{
		$id=$this->input->get_post("id");
		$data["message"]=$this->userfollow_model->getsingleuserfollow($id);
		$this->load->view("json",$data);
	}
   public function logout()
    {
        $this->session->sess_destroy();
		$this->load->view('json',true);
    }
 public function userfollow()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user=$data['user'];
        $userfollowed=$data['userfollowed'];
        $creationdate=$data['creationdate'];
        $data['message']=$this->restapi_model->userfollow($user,$userfollowed,$creationdate);
        $this->load->view("json",$data);
    }
 public function userunfollow()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user=$data['user'];
        $userfollowed=$data['userfollowed'];
        $data['message']=$this->restapi_model->userunfollow($user,$userfollowed);
        $this->load->view("json",$data);
    }
 public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $email=$data['email'];
        $password=$data['password'];
        $data['message']=$this->user_model->login($email,$password);
        $this->load->view("json",$data);
    } 
 public function createuserpoll()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $content=$data['content'];
        $image=$data['image'];
        $title=$data['title'];
        $video=$data['video'];
        $user=$data['user'];
        $creationdate=$data['creationdate'];
        $data['message']=$this->restapi_model->createuserpoll($content,$image,$title,$video,$user,$creationdate);
        $this->load->view("json",$data);
    } 
 public function edituserpoll()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $content=$data['content'];
        $image=$data['image'];
        $title=$data['title'];
        $video=$data['video'];
        $user=$data['user'];
        $modificationdate=$data['modificationdate'];
        $data['message']=$this->restapi_model->edituserpoll($id,$content,$image,$title,$video,$user,$modificationdate);
        $this->load->view("json",$data);
    } 
 public function deleteuserpoll()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $data['message']=$this->restapi_model->deleteuserpoll($id);
        $this->load->view("json",$data);
    } 
 public function createuserpollresponse()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $userpolloption=$data['userpolloption'];
        $userpoll=$data['userpoll'];
        $user=$data['user'];
        $creationdate=$data['creationdate'];
        $data['message']=$this->restapi_model->createuserpollresponse($userpolloption,$userpoll,$user,$creationdate);
        $this->load->view("json",$data);
    } 
 public function edituserpollresponse()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
 		$userpolloption=$data['userpolloption'];
        $userpoll=$data['userpoll'];
        $user=$data['user'];
        $modificationdate=$data['modificationdate'];
        $data['message']=$this->restapi_model->edituserpollresponse($id,$userpolloption,$userpoll,$user,$modificationdate);
        $this->load->view("json",$data);
    } 
 public function deleteuserpollresponse()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $data['message']=$this->restapi_model->deleteuserpollresponse($id);
        $this->load->view("json",$data);
    }
 public function createuserpollfavourites()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $userpoll=$data['userpoll'];
        $user=$data['user'];
        $creationdate=$data['creationdate'];
	 	print_r($data);
        $data['message']=$this->restapi_model->createuserpollfavourites($userpoll,$user,$creationdate);
        $this->load->view("json",$data);
    } 
 public function deleteuserpollfavourites()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $data['message']=$this->restapi_model->deleteuserpollfavourites($id);
        $this->load->view("json",$data);
    }
  public function createuserpolloption()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $text=$data['text'];
        $image=$data['image'];
        $userpoll=$data['userpoll'];
        $creationdate=$data['creationdate'];
        $data['message']=$this->restapi_model->createuserpolloption($text,$image,$userpoll,$creationdate);
        $this->load->view("json",$data);
    } 
 public function edituserpolloption()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
 		$text=$data['text'];
        $image=$data['image'];
        $userpoll=$data['userpoll'];
        $modificationdate=$data['modificationdate'];
        $data['message']=$this->restapi_model->edituserpolloption($id,$text,$image,$userpoll,$modificationdate);
        $this->load->view("json",$data);
    } 
 public function deleteuserpolloption()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $data['message']=$this->restapi_model->deleteuserpolloption($id);
        $this->load->view("json",$data);
    }
  public function createuserpollcomment()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user=$data['user'];
        $userpoll=$data['userpoll'];
        $content=$data['content'];
        $creationdate=$data['creationdate'];
        $data['message']=$this->restapi_model->createuserpollcomment($user,$userpoll,$content,$creationdate);
        $this->load->view("json",$data);
    }  
 public function deleteuserpollcomment()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id=$data['id'];
        $data['message']=$this->restapi_model->deleteuserpollcomment($id);
        $this->load->view("json",$data);
    }
 public function countoffavourites(){
 		$data = json_decode(file_get_contents('php://input'), true);
        $userpoll=$data['id'];
        $data['message']=$this->restapi_model->countoffavourites($userpoll);
        $this->load->view("json",$data);
 }
  public function viewallfollowedlatest(){
 		$data = json_decode(file_get_contents('php://input'), true);
        $user=$data['user'];
        $data['message']=$this->restapi_model->viewallfollowedlatest($user);
        $this->load->view("json",$data);
 }
} ?>