<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class userpoll_model extends CI_Model
{
public function create($image,$title,$video,$user,$status,$shouldhavecomment,$timestamp,$content,$creationdate,$modificationdate)
{
$data=array("image" => $image,"title" => $title,"video" => $video,"user" => $user,"status" => $status,"shouldhavecomment" => $shouldhavecomment,"content" => $content,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$query=$this->db->insert( "attach_userpoll", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("attach_userpoll")->row();
return $query;
}
function getsingleuserpoll($id){

$query['userpolldetail']=$this->db->query("SELECT `attach_userpoll`.`id`,`attach_userpoll`.`share`,`attach_userpoll`.`timestamp`, `attach_userpoll`.`content`, `attach_userpoll`.`image`, `attach_userpoll`.`title`, `attach_userpoll`.`video`, `attach_userpoll`.`user`, `attach_userpoll`.`status`, `attach_userpoll`.`shouldhavecomment`, `attach_userpoll`.`creationdate`, `attach_userpoll`.`modificationdate`,`user`.`name`, `user`.`password`, `user`.`email`, `user`.`accesslevel`, `user`.`timestamp`, `user`.`status`, `user`.`image`, `user`.`username`, `user`.`socialid`, `user`.`logintype`, `user`.`json`, `user`.`dob`,`attach_userpoll`.`shouldhaveoption` FROM `attach_userpoll` LEFT OUTER JOIN `user` ON `user`.`id`=`attach_userpoll`.`user`
WHERE `attach_userpoll`.`id`='$id'")->row();
    
    $query['poll_images']=$this->db->query("SELECT `userpollimages`.`id` as `pollimageid`,`userpollimages`.`pollid`,`userpollimages`.`image` FROM `userpollimages`
WHERE `userpollimages`.`pollid`='$id'")->result(); 
    
    $query['poll_options']=$this->db->query("SELECT `attach_userpolloption`.`id` as `optionid`,`attach_userpolloption`.`image` as `optionimage`,`attach_userpolloption`.`text`,`attach_userpolloption`.`timestamp` as `pollcreationtime` FROM `attach_userpolloption`
WHERE `attach_userpolloption`.`userpoll`='$id'")->result();
//print_r(sizeOf($query['poll_options']));
    
    foreach($query['poll_options'] as $row){
         $row->pollcount=$this->db->query("SELECT COUNT(*) as `count` FROM `attach_userpollresponse` WHERE `attach_userpollresponse`.`userpolloption`=$row->optionid AND `attach_userpollresponse`.`userpoll`=$id")->row();
    }
return $query;
}
public function edit($id,$image,$title,$video,$user,$status,$shouldhavecomment,$timestamp,$content,$creationdate,$modificationdate)
{
$data=array("image" => $image,"title" => $title,"video" => $video,"user" => $user,"status" => $status,"shouldhavecomment" => $shouldhavecomment,"timestamp" => $timestamp,"content" => $content,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$this->db->where( "id", $id );
$query=$this->db->update( "attach_userpoll", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `attach_userpoll` WHERE `id`='$id'");
return $query;
}
public function getuserpolldropdown()
	{
		$query=$this->db->query("SELECT * FROM `attach_userpoll`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->title;
		}
		
		return $return;
	}
}
?>
