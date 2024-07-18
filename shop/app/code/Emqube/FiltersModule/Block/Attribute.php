<?php

namespace Emqube\FiltersModule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Eav\Model\Config;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;


class Attribute extends Template
{
 
    protected $productFactory;
    protected $eavConfig;
    protected $_productCollectionFactory;
    protected $optionId = 212;
    protected $attributeCode_coffeetype = 'coffee_type';
    protected $attributeCode_raostprofile = 'roast_profile';
    protected $attributeCode_brand = 'product_brand';
    protected $category_id_array = ['41'];

    protected $_storeManager;
    protected $categoryRepository;

    public function __construct(
        Context $context,
        Config $eavConfig,
        CollectionFactory $productCollectionFactory,
        ProductFactory $productFactory,
        CategoryRepositoryInterface $categoryRepository,
        StoreManagerInterface $storeManager
    )
    {
        $this->productFactory = $productFactory;
        $this->eavConfig = $eavConfig;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($context);
    }
    
    public function get_coffeetype_attribute($cat_id,$attribute_id){
      
        $attribute = $this->eavConfig->getAttribute('catalog_product', $this->attributeCode_coffeetype);
        $options = $attribute->getSource()->getAllOptions();
        $options = array_filter($options);    
        $options_array = array();  
        if(!empty($options)){
            foreach($options as $value_options){

                if ($value_options['value'] > 0 || $value_options['value']!='' ) {
                    if (!empty($this->checkattribute_coffeetype($value_options['value'],$cat_id,$attribute_id))) {
                        array_push($options_array,['value' =>$value_options['value'],'label' =>$value_options['label']]);  
                    }
                  
                }
                
                
            }
           
        }
        return $options_array;
        
    }

    public function get_roastprofile_attribute($cat_id,$attribute_id){
       

        $attribute = $this->eavConfig->getAttribute('catalog_product', $this->attributeCode_raostprofile);
        $options = $attribute->getSource()->getAllOptions();
        $options = array_filter($options);    
        $options_array = array();  
        if(!empty($options)){
            foreach($options as $value_options){
                if ($value_options['value'] > 0 || $value_options['value']!='' ) {
                    if (!empty($this->checkattribute_raost($value_options['value'],$cat_id,$attribute_id))) {
                       array_push($options_array,['value' =>$value_options['value'],'label' =>$value_options['label']]);
                    }
                    
                 
                }
                
            }
           
        }
        return $options_array;
        
    }

    public function getproduct_brand_attribute($cat_id){
      
        $attribute = $this->eavConfig->getAttribute('catalog_product', $this->attributeCode_brand);
        $options = $attribute->getSource()->getAllOptions();
        $options = array_filter($options);    
        $options_array = array();  
        if(!empty($options)){
            foreach($options as $value_options){
                if ($value_options['value'] > 0 || $value_options['value']!='' ) {
                    if (!empty($this->checkattribute_brand($value_options['value'],$cat_id))) {
                      array_push($options_array,['value' =>$value_options['value'],'label' =>$value_options['label']]);  
                    }
                    
                } 
                
            }
           
        }
        return $options_array;
        
    }


    public function checkattribute_coffeetype($id,$catergory_id,$attribute_id){

        //$category_id_array=['41'];
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('type_id', \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
        $collection->addCategoriesFilter(['in' => $catergory_id]);
        $collection->addAttributeToFilter('status', 1);
        if ($attribute_id=='null') {
          $collection->addFieldToFilter(array(
             array('attribute'=>$this->attributeCode_coffeetype,'eq'=> $id),
          ));  
      }else{
            $collection->addFieldToFilter(array(
               array('attribute'=>$this->attributeCode_raostprofile,'eq'=> $attribute_id),
            ));
            $collection->addFieldToFilter(array(
               array('attribute'=>$this->attributeCode_coffeetype,'eq'=> $id),
            ));
      }
        
        
        $products = $collection->getData();
        return $products;
    }
    public function checkattribute_raost($id,$catergory_id,$attribute_id){

        //$category_id_array=['41'];
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('type_id', \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
        $collection->addCategoriesFilter(['in' => $catergory_id]);
        $collection->addAttributeToFilter('status', 1);
        if ($attribute_id=='null') {
           $collection->addFieldToFilter(array(
              array('attribute'=>$this->attributeCode_raostprofile,'eq'=> $id),
           )); 
        }else{
            
            $collection->addFieldToFilter(array(
               array('attribute'=>$this->attributeCode_coffeetype,'eq'=> $attribute_id),
            ));
            $collection->addFieldToFilter(array(
               array('attribute'=>$this->attributeCode_raostprofile,'eq'=> $id),
            ));
        }
        // echo $collection->getSelect()->__toString()."----------------------<br>";
        $products = $collection->getData();
        return $products;
    }


    public function checkattribute_brand($id,$catergory_id){

        //$category_id_array=['41'];
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('type_id', \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
        $collection->addCategoriesFilter(['in' => $catergory_id]);
        $collection->addAttributeToFilter('status', 1);
     
           $collection->addFieldToFilter(array(
              array('attribute'=>$this->attributeCode_brand,'eq'=> $id),
           )); 
        // echo $collection->getSelect()->__toString()."----------------------<br>";
        $products = $collection->getData();
        return $products;
    }

    public  function getCategoryUrl($categoryId='')
    {  
        $cat_url='';
        if ($categoryId!='') {
              $category = $this->categoryRepository->get($categoryId, $this->_storeManager->getStore()->getId());
            $cat_url=$category->getUrl();
        }
      

        return $cat_url;
    }
    
}

