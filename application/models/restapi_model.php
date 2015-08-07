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
	public function userfollow($user,$userfollowed){
	 	$data = array("user" => $user, "userfollowed" => $userfollowed);
     	$query = $this->db->insert("attach_userfollow", $data);
     	$id = $this->db->insert_id();
        if($id)
		return true;
        else
            return false;
	}
	public function userunfollow($user,$userfollowed){
	 $query=$this->db->query("DELETE FROM `attach_userfollow` WHERE `user`='$user' AND `userfollowed`='$userfollowed'");
    return $query;
	}
	public function createuserpoll($content,$image,$user,$option,$status){
       // CREATE POLL
	 
            $data = array( "content" => $content,"user" => $user,"shouldhaveoption" =>$status);
     	$query = $this->db->insert("attach_userpoll", $data);
     	$id = $this->db->insert_id();
        
//        CREATE IMAGES OF POLLS
        
        $imagelength=count($image);
        for($i=0;$i<$imagelength;$i++){
        
            $data = array( "image" => $image[$i]['image'],"pollid" => $id);
     	$query = $this->db->insert("userpollimages", $data);
     	$id1 = $this->db->insert_id();
            
        }   
        
        //CREATE OPTIONS OF POLLS
        
        $optionlength=count($option);
        for($i=0;$i<$optionlength;$i++){
          $text=$option[$i]['text'];
         $data = array( "text" => $text,"userpoll" => $id);
     	$query = $this->db->insert("attach_userpolloption", $data);
     	$id2 = $this->db->insert_id();
        }
        
		return true;
	}	
	public function edituserpoll($id,$content,$image,$status){
	$data = array( "content" => $content,"shouldhaveoption" =>$status);
     	$this->db->where( "id", $id );
		$query=$this->db->update( "attach_userpoll", $data );
        
        //IMAGE COUNT
        
        $imagecount=count($image);
            $query=$this->db->query("DELETE FROM `userpollimages` WHERE `pollid`='$id'");
        for($i=0;$i<$imagecount;$i++){
             $data = array( "image" => $image[$i]['image'],"pollid" => $id);
     	$query = $this->db->insert("userpollimages", $data);
     	$id1 = $this->db->insert_id();
        }
		if(!$query)
			return 0;
		else
		return 1;
	}
	public function deleteuserpoll($id)
{
    $query=$this->db->query("DELETE FROM `attach_userpoll` WHERE `id`='$id'");
    $query=$this->db->query("DELETE FROM `userpollimages` WHERE `pollid`='$id'");
       	if(!$query)
			return 0;
		else
		return 1;
}
	public function createuserpollresponse($userpolloption,$userpoll,$user){
	$data = array("user" => $user, "userpolloption" => $userpolloption, "userpoll" => $userpoll);
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
	public function createuserpollfavourites($userpoll,$user){
	$data = array("user" => $user, "userpoll" => $userpoll);
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
    public function userfollowedlist($id){
    	$query=$this->db->query("SELECT `userfollowed` FROM `attach_userfollow` WHERE `user`='$id'")->result();
		return $query;
    }
    public function userdetails($userid,$followid){
    $query=$this->db->query("SELECT `user`.`id`, `user`.`name`, `user`.`password`, `user`.`email`, `user`.`accesslevel`, `user`.`timestamp`, `user`.`status`, `user`.`image`, `user`.`username`, `user`.`socialid`, `user`.`logintype`, `user`.`json`, `user`.`dob`, `user`.`facebook`, `user`.`twitter`, `user`.`creationdate`, `user`.`modificationdate`, `user`.`street`, `user`.`address`, `user`.`city`, `user`.`state`, `user`.`pincode`, `user`.`country`, `user`.`google` FROM `user` LEFT OUTER JOIN `attach_userfollow` ON `attach_userfollow`.`user`=`user`.`id` WHERE `user`.`id`='$followid'")->row();
        $query->isfollowed=false;
        $query2=$this->db->query("SELECT `id` FROM `attach_userfollow` WHERE `user`='$userid' AND `userfollowed`='$followid'")->result();
        	if ( empty($query2) ) 
            {
            }
        else
        {
		 $query->isfollowed=true;
    }
        return $query;
    }
    
    public function getalluser(){
    $query=$this->db->query("SELECT `id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `facebook`, `twitter`, `creationdate`, `modificationdate`, `street`, `address`, `city`, `state`, `pincode`, `country`, `google` FROM `user`")->result();
		return $query;
    }
//    public function getpollids($followids,$id){
//        foreach($followids as $followid){
//       $query=$this->db->query("SELECT `id` FROM `attach_userpoll` WHERE `user`='$followid->userfollowed'");
//        
//        if($query->num_rows()>0){
//        $query1=$query->result();
//            foreach($query1 as $q)
//                {
//                print_r($q);
//                     $query2=$this->db->query("SELECT `id` FROM `attach_userpollfavourites` WHERE `user`='$id' AND `userpoll`='$q->id'"); 
//                if($query2->num_rows()> 0){
//                return true;
//                }
//              
//                 }
//        }
//        }
//		return $query;
//    }
}
?>

