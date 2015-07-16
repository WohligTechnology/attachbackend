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
$this->db->where("id",$id);
$query=$this->db->get("attach_userpoll")->row();
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
