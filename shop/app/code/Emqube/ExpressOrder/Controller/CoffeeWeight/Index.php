<?php

namespace Emqube\ExpressOrder\Controller\CoffeeWeight;

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
        //if ($this->getRequest()->getPost('coffee_no_id') && $this->getRequest()->getPost('coff_type') && $this->getRequest()->getPost('coff_roaster') && $this->getRequest()->getPost('product_id')){
        $resultJson='';
        if ($this->getRequest()->getPost('coffeetype_value') && $this->getRequest()->getPost('product_id')){
           $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
           $coffeetype_value=$this->getRequest()->getPost('coffeetype_value');
           $product_id=$this->getRequest()->getPost('product_id');

           $product_child = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
           $_children_array = $product_child->getTypeInstance()->getUsedProducts($product_child);
           $productIds =array();
           foreach ($_children_array as $child){
            
              array_push($productIds,$child->getID());
           }
          
           $collection = $this->_productCollectionFactory->create();
           $collection->addAttributeToSelect('*');
           $collection->addAttributeToFilter('type_id', \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
           $collection->addAttributeToFilter('status', 1);
           $collection->addIdFilter($productIds);

           $collection->addFieldToFilter(   
            array(array('attribute'=>'coffee_type','eq'=> $coffeetype_value)),
        
           );
         

           $attributes_coffee_weight= array();
           $products = $collection->getData();
           
           if(!empty($products)){
               foreach($products as $products_coffeeweight){
                   
                $product_att = $objectManager->get('Magento\Catalog\Model\Product')->load($products_coffeeweight['entity_id']);
                array_push($attributes_coffee_weight,['value'=>$product_att->getData('coffee_weight'),'label'=>$product_att->getAttributeText('coffee_weight')]);
            
               }    
           }
           $coffee_weight_attribute ='';
           if(!empty($attributes_coffee_weight)){
               $coffee_weight_attribute = array_unique($attributes_coffee_weight,SORT_REGULAR);
           }

        }
           
       $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
       $resultJson->setData($coffee_weight_attribute);
       return $resultJson;
 
    }
    
}