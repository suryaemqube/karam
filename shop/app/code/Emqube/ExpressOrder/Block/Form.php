<?php

namespace Emqube\ExpressOrder\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Catalog\Model\CategoryFactory;
use \Magento\Framework\Registry;
use \Magento\Backend\Block\Template\Context; 
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Eav\Model\Config;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Directory\Model\Currency;

class Form extends Template
{
 
    protected $_registry;
    protected $_categoryFactory;
    protected $_storeManager;
    protected $eavConfig;
    protected $_productCollectionFactory;
    protected $_currency;

    public function __construct(
        Context $context,
        Registry $registry,
        CategoryFactory $categoryFactory,
        StoreManagerInterface $storeManager,
        CollectionFactory $productCollectionFactory,
        Config $eavConfig,
        Currency $currency,
        array $data = []
    )
    {        
        $this->_registry = $registry;
        $this->_categoryFactory = $categoryFactory;
        $this->_storeManager = $storeManager;
        $this->_eavConfig = $eavConfig;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_currency = $currency; 
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getCurrentCategory()
    {        
        return $this->_registry->registry('current_category');
      
    }

    public function getCurrentProduct()
    {      
        // $products = $this->_registry->registry('current_product');  
        // var_dump($products)
        return $this->_registry->registry('current_product');
    }  

    public function getCategory($categoryId) 
	{
		$category = $this->_categoryFactory->create();
		$category->load($categoryId);
		return $category;
	}

    public function getProductsByCategory($categoryId)
    {
        $products = $this->getCategory($categoryId)->getProductCollection();
		$products->addAttributeToSelect('*');
        $products->addAttributeToFilter('type_id', ['eq' => 'configurable']);
        $products->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
		return $products;
    }
    public function getProducts()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get('Emqube\ExpressOrder\Helper\Data');
        $stringtoarray = $helper->CategoryList();
        $array_category = explode(",",$stringtoarray);
        //$array_category=array(42,43,44,45,46,47);
        $products = $this->_productCollectionFactory->create();
		$products->addAttributeToSelect('*');
        $products->addCategoriesFilter(['in' => $array_category]);
        $products->addAttributeToFilter('type_id', ['eq' => 'configurable']);
        $products->addAttributeToFilter('status',\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
		return $products;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getCoffeeNo()
    {
        // $attributeCode = "coffee_no";
        $attributeCode = "coffee_type";
        
		$attribute = $this->_eavConfig->getAttribute('catalog_product', $attributeCode);
		$options = $attribute->getSource()->getAllOptions();
		$arr = [];
		foreach ($options as $option) {
		    if ($option['value'] > 0) {
		        $arr[] = $option;
		    }
		}

        return $arr;
    }
    /**
     * Get currency symbol for current locale and currency code
     *
     * @return string
     */    
    public function getCurrentCurrencySymbol()
    {
        return $this->_currency->getCurrencySymbol();
    }  

    /**
     * Get default store currency code
     *
     * @return string
     */
    public function getDefaultCurrencyCode()
    {
        return $this->_storeManager->getStore()->getDefaultCurrencyCode();
    }
}

