<?php       
namespace Concrete\Package\IDX;
use Package;
use BlockType;
use SinglePage;
use Database;
use Page;
use PageType;
use PageTemplate;
use \Concrete\Core\Page\Type\PublishTarget\Type\Type as PublishTargetType;
use CollectionAttributeKey;
use Concrete\Core\Attribute\Type as AttributeType;

use Concrete\Core\Attribute\Key\Category;
use Concrete\Core\Attribute\Type;


defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

	protected $pkgHandle = 'IDX';
	protected $appVersionRequired = '5.7.2';
	protected $pkgVersion = '0.9.4';

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
		SinglePage::add('/dashboard/idx_configrations', $pkg);
		
		
		        $newsPage = $this->addPage('property_listings', 'Property Listings', 'Programmatic Page Property Listings', 'page', 'full', 1,$pkg);

$key = CollectionAttributeKey::getByHandle('my_attr');
if (!$key || !intval($key->getAttributeKeyID())) {
   $attr_type = AttributeType::getByHandle('textarea');
   $desc =   array ( 'akHandle' => 'my_attr', 
               'akName'=> t('My Attribute'), 
               'asID' => $asID,
               'akTextareaDisplayMode' => 'text'
            );
   $key = CollectionAttributeKey::add(   $attr_type, $desc , $pkg);
}
 		
		
        $newsItemPageType = $this->addPageTypeWithParentPagePublishTarget('listings', 'Listings', 'full', 'C', array('full'), $newsPage->getCollectionID(), $pkg);
        
        
					}
        public function uninstall(){ 
		$pkg = parent::uninstall();
		$db = Database::connection();
		$db->Execute('DROP TABLE IF EXISTS idx');
	}			
protected function addPage($pathOrCID, $name, $description, $type, $template, $parent, $pkg, $handle=null)
    {
        //Get Page if it's already created
        if (is_int($pathOrCID)) {
            $page = Page::getByID($pathOrCID);
        } else {
            $page = Page::getByPath($pathOrCID);
        }
        if ($page->isError() && $page->getError() == COLLECTION_NOT_FOUND) {
            //Get Page Type and Templates from their handles
            $pageType = PageType::getByHandle($type);
            $pageTemplate = PageTemplate::getByHandle($template);
            
            //Get parent, depending on what format parent is passed in
            if (is_object($parent)) {
                $parent = $parent;
            } elseif (is_int($parent)) {
                $parent = Page::getById($parent);
            } else {
                $parent = Page::getByPath($parent);
            }
            //Get package
            $pkgID = $pkg->getPackageID();
            
            //Create Page
            $page = $parent->add($pageType, array(
                'cName' => $name,
                'cHandle' => $handle,
                'cDescription' => $description,
                'pkgID' => $pkgID,
                'cHandle' => $handle
            ), $pageTemplate);
        }
        
        return $page;
    }

 
    protected function addPageTypeWithParentPagePublishTarget($typeHandle, $typeName, $defaultTemplateHandle, $allowedTemplates, $templateArray, $parentPageCID, $pkg) 
    {
        //Get the Page Type if it already exists
        $pt = PageType::getByHandle($typeHandle);
        if(!is_object($pt)) {
            //Add the Page Type, then set the publishing target
            $pto = $this->addPageType($typeHandle, $typeName, $defaultTemplateHandle, $allowedTemplates, $templateArray, $pkg);
            $pt = $this->setParentPagePublishTarget($pto, $parentPageCID);
        }
        
        return $pt;
    }
    
    protected function addPageType($typeHandle, $typeName, $defaultTemplateHandle, $allowedTemplates, $templateArray, $pkg)
    {
        //Get required Template objects (these can be handles after 8)
        $defaultTemplate = PageTemplate::getByHandle($defaultTemplateHandle);
        $allowedTemplateArray = array();
        foreach($templateArray as $handle) {
            $allowedTemplateArray[] = PageTemplate::getByHandle($handle);
        }
        //Set data array for Page Type Creation
        $data = array (
            'handle' => $typeHandle,
            'name' => $typeName,
            'defaultTemplate' => $defaultTemplate,
            'allowedTemplates' => $allowedTemplates,
            'templates' => $allowedTemplateArray
        );
        $pt = PageType::add($data, $pkg);

        return $pt;
    }

    
    protected function setParentPagePublishTarget($pageTypeObject, $parentPageCID)
    {
        $parentTarget = PublishTargetType::getByHandle('parent_page');
        $configuredParentTarget = $parentTarget->configurePageTypePublishTarget(
            $pageTypeObject,
            array(
                'CParentID' => $parentPageCID
            )
         );
        $pageTypeObject->setConfiguredPageTypePublishTargetObject($configuredParentTarget);
        
        return $pageTypeObject;
    }	
 }
?>