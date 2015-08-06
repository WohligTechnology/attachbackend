<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class userpollimages_model extends CI_Model
{
public function create($pollid,$image)
{
$data=array("pollid" => $pollid,"image" => $image);
$query=$this->db->insert( "userpollimages", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("userpollimages")->row();
return $query;
}

public function edit($id,$pollid,$image)
{
$data=array("pollid" => $pollid,"image" => $image);
$this->db->where( "id", $id );
$query=$this->db->update( "userpollimages", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `userpollimages` WHERE `id`='$id'");
return $query;
}
   public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `userpollimages` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
