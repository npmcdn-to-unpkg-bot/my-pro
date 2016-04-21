<?php
namespace Admin\Model;
use Think\Model;

class AdminMenuModel extends Model{
	//protected  $insertFields = array("ID" , "MENU_NAME" , "URI" , "MENU_ICON" , "SORT" , "PNAME" , "PID" , "CREATE_TIME" , "STATE" , "_pk" => "ID");
	protected  $updateFields = array("MENU_NAME" , "URI" , "MENU_ICON" , "SORT" , "PNAME" , "PID" , "STATE");
}