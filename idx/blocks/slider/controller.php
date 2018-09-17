<?php 
namespace Concrete\Package\IDX\Block\slider;
use \Concrete\Core\Block\BlockController;
use Loader;
use \File;
use Page;
use Database;
use \Concrete\Core\Block\View\BlockView as BlockView;

defined('C5_EXECUTE') or die(_("Access Denied.")); 

class Controller extends BlockController
{

    protected $btTable = "slider";
	protected $btInterfaceWidth = "370";
	protected $btInterfaceHeight = "400";
	protected $blocksss;

	public function on_page_view() {
		$html = Loader::helper('html');
		$this->addHeaderItem($html->css('idx.css', 'idx'));

	}
     public function credentials(){
		$content = '';
		$db = Database::connection();
		$v = array(1);
		$q = 'SELECT `key` FROM `idx_credentials` WHERE `status`=?';
		
			$resultaat = $db->fetchColumn($q,$v);
			return $resultaat;
		}	
    public function getBlockTypeDescription()
    {
        return t("Add Featured Listings Slider to Your Site");
    }

    public function getBlockTypeName()
    {
        return t("Listing Slider");
    }
	
	
	 public function save($args){
		$args["slider"];
	
		$args["blocks"];
		parent::save($args);
		
	}
	
	public function block_count($blocks){
		return $blocks;
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
		
	public function logic($response,$args){
		?>
		<div class="container">
		
		<div class="row">
		
		<?php
		
		$i=0;
		
		
		
	?>	
    
    
    
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
 
  <?php
  $slide=0;
  $initiator=0;
 
  		foreach($response as $key => $val){
$slide++;
 	
		if($slide==1){ ?>
 <div class="item <?php  if($initiator==0){echo 'active';} ?>">
 <?php $initiator++;
		} 
		
		
	    
		echo '<a href='.$val['fullDetailsURL'].'>';
		?>
			<div class="<?php if($args==1) echo 'col-lg-12 col-md-12 col-sm-12';?> <?php if($args==2) echo 'col-lg-6 col-md-6 col-sm-6';?> <?php if($args==3) echo 'col-lg-4 col-md-4 col-sm-4'; ?> <?php if($args==4) echo 'col-lg-3 col-md-3 col-sm-3'; ?> col-xs-12">
		 <?php	
		        echo "<h3 class='address'>".$block.$val['address']."</h3>";
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
 
       
 
		<?php echo '</a>'; if($slide==$args){
 echo '</div>';
 $slide=0;
		} }?>
        	
        
       </div> 
			 <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
 		 </div>  
	
		</div>
		
		<?php
		
		}	
	public function listings($slider){
		
		$url='https://api.idxbroker.com/clients/featured';
		$method = 'GET';
		$results=$this->credentials();
		//curl Header
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
			'accesskey:'.$results, 
			'outputtype: json'
		);
		//making curl call
		$response=$this->curl_call($url,$headers);
		
		$response = json_decode($response,true);
		
		//populating html
		
		$this->logic($response,$slider);
		?>
       
			<?php
		}
}