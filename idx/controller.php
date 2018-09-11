<?php       
namespace Concrete\Package\IDX;
use Package;
use BlockType;
use SinglePage;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

	protected $pkgHandle = 'IDX';
	protected $appVersionRequired = '5.7.1';
	protected $pkgVersion = '1.0';

	public function getPackageDescription()
	{
		return t("IDX Broker Api Middleware");
	}

	public function getPackageName()
	{
		return t("idx");
	}
	
	public function install()
	{
		$pkg = parent::install();
        BlockType::installBlockTypeFromPackage('idx', $pkg); 
		BlockType::installBlockTypeFromPackage('slider', $pkg); 
		 
			}
}
?>