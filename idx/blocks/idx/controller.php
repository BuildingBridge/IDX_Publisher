<?php 
namespace Concrete\Package\IDX\Block\IDX;
use \Concrete\Core\Block\BlockController;
use Loader;
use \File;
use Page;
use \Concrete\Core\Block\View\BlockView as BlockView;

defined('C5_EXECUTE') or die(_("Access Denied.")); 

class Controller extends BlockController
{

    protected $btTable = "idx";
	protected $btInterfaceWidth = "370";
	protected $btInterfaceHeight = "400";

	public function on_page_view() {
		$html = Loader::helper('html');
		$this->addHeaderItem($html->css('idx.css', 'idx'));
	}

    public function getBlockTypeDescription()
    {
        return t("Add Featured Listings to Your Site");
    }

    public function getBlockTypeName()
    {
        return t("idx");
    }
	
	
	 public function save($args){
		$args["listing"];
		parent::save($args);
	}
	
	public function curl_call($url,$headers){
		
		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($handle);
		$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		return $response;

		}
		
	public function logic($response){
		?>
		<div class="container">
		
		<div class="row">
		
		<?php
		
		$i=0;
		
		foreach($response as $key => $val){
		
		echo '<a href='.$val['fullDetailsURL'].'>';
		?>
	    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		 <?php		
				echo "<h3 class='address'>".$val['address']."</h3>";
				echo "<h4 class='country'>".$val['countyName']."</h4>";
				echo "<h5 class='state'>".$val['state']."<h5>";
				
				foreach($val['image'] as $imageVal){
			$i++;
			if($i==1)
		echo "<img src=".$imageVal['url']." class='img-responsive'>";			
		}
		$i=0;
		?>
			</div>
		<?php echo '</a>';}?>
			
 		 </div>  
	
		</div>
		
		<?php
		
		}	
	public function listings(){
		
		$url='https://api.idxbroker.com/clients/featured';
		$method = 'GET';

		//curl Header
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
			'accesskey: -M01XNFJLFa-BneZ8U9_FV', 
			'outputtype: json'
		);
		//making curl call
		$response=$this->curl_call($url,$headers);
		
		$response = json_decode($response,true);
		
		//populating html
		
		$this->logic($response);
		?>
       
			<?php
		}
}