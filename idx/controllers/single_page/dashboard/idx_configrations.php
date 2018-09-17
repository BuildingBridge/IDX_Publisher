<?php 
namespace Concrete\Package\idx\Controller\SinglePage\Dashboard;
defined('C5_EXECUTE') or die('Access Denied.');
use Core;
use Page;
use Package;
use URL;
use Database;
use Concrete\Core\Page\Controller\DashboardPageController;

class IdxConfigrations extends DashboardPageController
{
	
	public function connection()
	{
	 	 $db = Database::connection();
		 return $db;

	}

    public function view()
    {
		
		$this->set('form', Core::make('helper/form'));
		$db=$this->connection();
		$sql = "SELECT * from idx_credentials ORDER BY `bID` DESC";
		$result = $db->Execute($sql);
		$this->set('results',$result);
		        
    }
 
    public function insert()
    {
		extract($_POST); 
		$db=$this->connection();
		$sql = "insert into idx_credentials (`key`) VALUES (?)";
		$vals = array($key);
		$db->query($sql, $vals);
		$this->updated($key); 
    }

    public function updated($key)
    {
		$this->set('message', $key. " Successfully Added");
        return $this->view();
    } 
	
	
	 public function editKey($bID = NULL,$key = NULL)
    {
        $this->set('edit_form', "1");
		$this->set('site', $key);
		$this->set('bID', $bID);
        return $this->view();
    } 
	
	public function update_record()
    {
		extract($_POST);
		$db=$this->connection();
		$sql = "Update idx_credentials set `key`='$key' where bID=$bID";
		$db->Execute($sql);
		$this->set('message', $key. " Successfully Updated");
		return $this->view();

    }
	public function selectKey($bID = NULL,$key=NULL)
	{
		$db=$this->connection();
		$sql = "Update idx_credentials set status=0";
		$db->Execute($sql);
		$sql = "Update idx_credentials set status=1 where bID=$bID";
		$db->Execute($sql);
		$this->set('message', $key. " Successfully Added");
		return $this->view();

	}
	public function deleteKey($bID = NULL,$key=NULL)
	{
		$db=$this->connection();
		$sql = "delete from idx_credentials where bID=$bID";
		$db->Execute($sql);
		$this->set('message',"Record Successfully Removed");
		return $this->view();

	}
		
	public function addKey($arg= NULL)
	{
		$this->set('form_status', "enabled");
		return $this->view();
	}
	
	}
