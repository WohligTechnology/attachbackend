<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
class restapi_model extends CI_Model {
	public function home($user)
{
	$query['followcount']=$this->db->query("SELECT count(userfollowed) as `followcount` FROM `attach_userfollow` WHERE    			       `user`='$user'")->row();
	$query['followcount']=$query['followcount']->followcount;
		
	$query['favouritecount']=$this->db->query("SELECT count(id) as `favouritecount` FROM `attach_userpollfavourites` WHERE    			`user`='$user'")->row();
	$query['favouritecount']=$query['favouritecount']->favouritecount;	
		
	$query['pollcount']=$this->db->query("SELECT count(id) as `pollcount` FROM `attach_userpoll` WHERE `user`='$user'")->row();
	$query['pollcount']=$query['pollcount']->pollcount;	
		
	$query['commentcount']=$this->db->query("SELECT count(id) as `commentcount` FROM `attach_userpollcomment` WHERE `user`='$user'")->row();
	$query['commentcount']=$query['commentcount']->commentcount;
	return $query;
}
	public function userfollow($user,$userfollowed,$creationdate){
	 	$data = array("user" => $user, "userfollowed" => $userfollowed, "creationdate" => $creationdate);
     	$query = $this->db->insert("attach_userfollow", $data);
     	$id = $this->db->insert_id();
		return $id;
	}
	public function userunfollow($user,$userfollowed){
	 $query=$this->db->query("DELETE FROM `attach_userfollow` WHERE `user`='$user' AND `userfollowed`='$userfollowed'");
    return $query;
	}
	public function createuserpoll($content,$image,$title,$video,$user,$creationdate){
	$data = array( "content" => $content, "image" => $image,"title" => $title,"video" => $video,"user" => $user,"creationdate" => $creationdate);
     	$query = $this->db->insert("attach_userpoll", $data);
     	$id = $this->db->insert_id();
		return $id;
	}	
	public function edituserpoll($id,$content,$image,$title,$video,$user,$modificationdate){
	$data = array("user" => $user, "content" => $content, "image" => $image,"title" => $title,"video" => $video,"modificationdate" => $modificationdate);
     	$this->db->where( "id", $id );
		$query=$this->db->update( "attach_userpoll", $data );
		if(!$query)
			return 0;
		else
		return 1;
	}
	public function deleteuserpoll($id)
{
$query=$this->db->query("DELETE FROM `attach_userpoll` WHERE `id`='$id'");
return $query;
}
	public function createuserpollresponse($userpolloption,$userpoll,$user,$creationdate){
	$data = array("user" => $user, "userpolloption" => $userpolloption, "userpoll" => $userpoll,"creationdate" => $creationdate);
     	$query = $this->db->insert("attach_userpollresponse", $data);
     	$id = $this->db->insert_id();
		return $id;
	}	
	public function edituserpollresponse($id,$userpolloption,$userpoll,$user,$modificationdate){
	$data = array("user" => $user, "userpolloption" => $userpolloption, "userpoll" => $userpoll,"modificationdate" => $modificationdate);
     	$this->db->where( "id", $id );
		$query=$this->db->update( "attach_userpollresponse", $data );
		return 1;
	}
	public function deleteuserpollresponse($id)
{
$query=$this->db->query("DELETE FROM `attach_userpollresponse` WHERE `id`='$id'");
return $query;
}
	public function createuserpollfavourites($userpoll,$user,$creationdate){
	$data = array("user" => $user, "userpoll" => $userpoll,"creationdate" => $creationdate);
     	$query = $this->db->insert("attach_userpollfavourites", $data);
     	$id = $this->db->insert_id();
		return $id;
	}
		public function deleteuserpollfavourites($id)
{
$query=$this->db->query("DELETE FROM `attach_userpollfavourites` WHERE `id`='$id'");
return $query;
}
	public function createuserpolloption($text,$image,$userpoll,$creationdate){
	$data = array("text" => $text, "image" => $image, "userpoll" => $userpoll,"creationdate" => $creationdate);
     	$query = $this->db->insert("attach_userpolloption", $data);
     	$id = $this->db->insert_id();
		return $id;
	}	
	public function edituserpolloption($id,$text,$image,$userpoll,$modificationdate){
	$data = array("text" => $text, "image" => $image, "userpoll" => $userpoll,"modificationdate" => $modificationdate);
     	$this->db->where( "id", $id );
		$query=$this->db->update( "attach_userpolloption", $data );
		return 1;
	}
	public function deleteuserpolloption($id)
{
$query=$this->db->query("DELETE FROM `attach_userpolloption` WHERE `id`='$id'");
return $query;
}
	public function createuserpollcomment($user,$userpoll,$content,$creationdate){
	$data = array("user" => $user, "content" => $content, "userpoll" => $userpoll,"creationdate" => $creationdate);
     	$query = $this->db->insert("attach_userpollcomment", $data);
     	$id = $this->db->insert_id();
		return $id;
	}	
	public function deleteuserpollcomment($id)
{
$query=$this->db->query("DELETE FROM `attach_userpollcomment` WHERE `id`='$id'");
return $query;
}
	public function countoffavourites($userpoll){
	$query['viewsinglepoll']=$this->db->query("SELECT `id`, `image`, `title`, `video`, `user`, `status`, `shouldhavecomment`, `timestamp`, `content`, `creationdate`, `modificationdate` FROM `attach_userpoll` WHERE 'id'='$userpoll'")->row();	
	
		$query['countoffavourites']=$this->db->query("SELECT count(id) as `countoffavourites` FROM `attach_userpollfavourites` WHERE    			       `userpoll`='$userpoll'")->row();
	$query['countoffavourites']=$query['countoffavourites']->countoffavourites;
		
		$query['totalpolls']=$this->db->query("SELECT count(id) as `totalpolls` FROM `attach_userpoll`")->row();
		$query['totalpolls']=$query['totalpolls']->totalpolls;
		
		$query['pollsperpolloption']=$this->db->query("SELECT count(id) as `totalpolls` FROM `attach_userpollresponse` WHERE `userpoll`='$userpoll'")->row();
		$query['pollsperpolloption']=$query['pollsperpolloption']->totalpolls;
		return $query;
	}
	public function viewallfollowedlatest($user){
	$query=$this->db->query("SELECT `id`, `user`, `userfollowed`, `timestamp`, `creationdate`, `modificationdate` FROM `attach_userfollow` WHERE `user`='$user'")->result();
		return $query;
	}
}
?>