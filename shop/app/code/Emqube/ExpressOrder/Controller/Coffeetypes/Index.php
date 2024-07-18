<?php

namespace Emqube\ExpressOrder\Controller\Coffeetypes;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\ProductRepository;

class Index extends Action
{


    protected $resultFactory;
    protected $_productCollectionFactory;
    protected $_productRepository;
    public function __construct(     
        Context $context,
        CollectionFactory $productCollectionFactory,
        ProductRepository $productRepository
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->getPost('coffee_no_id') && $this->getRequest()->getPost('product_id') ){

           $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
           
           $coffee_no_id=$this->getRequest()->getPost('coffee_no_id');
           $product_id=$this->getRequest()->getPost('product_id');
           $product_child = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
           $_children_array = $product_child->getTypeInstance()->getUsedProducts($product_child);
           $productIds =array();
           foreach ($_children_array as $child){
            
              array_push($productIds,$child->getID());
           }
           $helper = $objectManager->get('Emqube\ExpressOrder\Helper\Data');
           $stringtoarray = $helper->CategoryList();
           $category_id_array = explode(",",$stringtoarray);
           //$category_id_array=['41'];
           $collection = $this->_productCollectionFactory->create();
           $collection->addAttributeToSelect('*');
           $collection->addAttributeToFilter('type_id', \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
           $collection->addCategoriesFilter(['in' => $category_id_array]);
           $collection->addIdFilter($productIds);
           $collection->addAttributeToFilter('status', 1);

           $collection->addFieldToFilter(array(
            array('attribute'=>'coffee_no','eq'=> $coffee_no_id),
           ));


           $attributes_coffee_type = array();
           $products = $collection->getData();
        
           if(!empty($products)){
               foreach($products as $products_coffeetype){
                   
                $product_att = $objectManager->get('Magento\Catalog\Model\Product')->load($products_coffeetype['entity_id']);
                array_push($attributes_coffee_type,['value'=>$product_att->getData('coffee_type'),'label'=>$product_att->getAttributeText('coffee_type')]);
            
               }    
           }
           $coffee_type_attribute ='';
           if(!empty($attributes_coffee_type)){
               $coffee_type_attribute = array_unique($attributes_coffee_type,SORT_REGULAR);
           }
      
           $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
    
           $resultJson->setData($coffee_type_attribute);
            
           return $resultJson;

        }
      
        
    }
    

    
}