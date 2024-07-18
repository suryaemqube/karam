<?php
namespace Emqube\CategoryLanding\Block;
use \Magento\Catalog\Model\CategoryFactory;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\ObjectManagerInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Eav\Model\Config;
use \Magento\Catalog\Model\CategoryRepository;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as productCollectionFactory;
use \Magento\Catalog\Api\ProductRepositoryInterfaceFactory;
use \Magento\Catalog\Helper\Image;
use \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectioFactory;
class Categories extends \Magento\Framework\View\Element\Template
{

	protected $categoryFactory;
	protected $_objectManager;
	protected $_storeManager;
	protected $eavConfig;
	protected $attributeCode = 'coffee_type';
	protected $categoryRepository;
	protected $_productCollectionFactory;
	protected $_productRepositoryFactory;
	protected $imageHelper;
    protected $categorycollectionfactory;
	public function __construct(Context $context,CategoryFactory $categoryFactory,ObjectManagerInterface $objectmanager,StoreManagerInterface $storeManager,Config $eavConfig,CategoryRepository $categoryRepository,productCollectionFactory $productfactory,ProductRepositoryInterfaceFactory $productRepositoryFactory,Image $imageHelper,CategoryCollectioFactory $categorycollectionfactory)
	{
		parent::__construct($context);
		$this->categoryFactory = $categoryFactory;
		$this->_objectManager = $objectmanager;
		$this->_storeManager = $storeManager;
		$this->eavConfig = $eavConfig; 
		$this->categoryRepository = $categoryRepository;
		$this->_productCollectionFactory = $productfactory;
		$this->_productRepositoryFactory = $productRepositoryFactory;
		$this->imageHelper = $imageHelper;
        $this->categorycollectionfactory = $categorycollectionfactory;
	}

	public function getSubCategories($categoryId='')
	{
		$categoryId = $categoryId;
		$subCats=array();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $subCategory = $this->_objectManager->create('Magento\Catalog\Model\Category')->load($categoryId); 
        $subCats = $subCategory->getChildrenCategories();
        return $subCats;
	}

	public function getThumbnailUrl($imageName){
        $url = $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ) . 'catalog/category/' . $imageName;
        return $url;
    }

	public function Categoryimage($id=''){

		$load_cat = $this->_objectManager->create('Magento\Catalog\Model\Category')->load($id);
		$imageUrl = $load_cat->getImageUrl();
		return $imageUrl;

	}
	public function get_base_url()
	{
		return $this->_storeManager->getStore()->getBaseUrl();
	}

	public function getattributes(){
      	$options=array();	
        $attribute = $this->eavConfig->getAttribute('catalog_product', $this->attributeCode);
        $options = $attribute->getSource()->getAllOptions();
        $options = array_filter($options);    
    	$options_array=array();
        if(!empty($options)){
            foreach($options as $value_options){
          	   if ($value_options['value']!='') {
          	   	  array_push($options_array,['value' =>$value_options['value'],'label' =>$value_options['label']]);
          	   }
				
                
            }
           
        }
        return $options_array;
        
    }

    public function GetCategoryUrl($id='')
    {
    	 $category = $this->categoryRepository->get($id, $this->_storeManager->getStore()->getId());
    	 $url_cat='';
    	 $url_cat=$category->getUrl();
    	 return $url_cat;
    }

    public function OfferProducts($id='')
    {
    	$categoryid = $id;
    	$collection='';
    	if ($categoryid!='') {
    		$ids = $id;
    		 $collection = $this->_productCollectionFactory->create();
    		 $collection->addAttributeToSelect('*');
    		 $collection->addCategoriesFilter(['in' => $ids]);
             $collection->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
    		  
    	}
    	return $collection;
    }

    public function ProductImage($pro_id=''){
    	$productimage_url='';
    	if ($pro_id!='') {
    		$product = $this->_productRepositoryFactory->create()
    	    ->getById($pro_id);
    		 $productimage_url = $this->imageHelper->init($product, 'product_base_image')->getUrl();
    	}

    	return $productimage_url;
    	
    }

    public function Hovertext($cat_id){
        $cat_rtt='';
        $collection = $this->categorycollectionfactory
                    ->create()
                    ->addAttributeToSelect('*')
                    ->addAttributeToFilter('entity_id',['eq'=>$cat_id])
                    ->setPageSize(1);


        $catObj = $collection->getFirstItem();
        $catData = $catObj->getData();
        $cat_rtt = $catObj->getRhCatAttr();
        if ($cat_rtt=='') {
            $cat_rtt=$catObj->getName();
        }
        return $cat_rtt;
    }


}