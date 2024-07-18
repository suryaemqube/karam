<?php

namespace Emqube\ExpressOrder\Controller\Coffeeno;

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
        if ($this->getRequest()->getPost('product_id')){


           $product_id=$this->getRequest()->getPost('product_id');

           
           $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
           $product_att = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
           $_children = $product_att->getTypeInstance()->getUsedProducts($product_att);
           $attributes_coffee_no =array();
           foreach ($_children as $child){
            
              array_push($attributes_coffee_no,['value'=>$child->getData('coffee_no'),'label'=>$child->getAttributeText('coffee_no')]);
           }

           $coffee_no_attribute ='';
           if(!empty($attributes_coffee_no)){
               $coffee_no_attribute = array_unique($attributes_coffee_no,SORT_REGULAR);
           }
      
           $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
           $resultJson->setData($coffee_no_attribute);
            
           return $resultJson;

        }
           
     
            
        
    }
    

    
}