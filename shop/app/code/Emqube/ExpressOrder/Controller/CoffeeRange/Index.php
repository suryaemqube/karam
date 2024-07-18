<?php

namespace Emqube\ExpressOrder\Controller\CoffeeRange;

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
        $resultJson='';
        if ($this->getRequest()->getPost('coffeetype_value')){

           $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
           $products=array();
           $coffee_type_value=$this->getRequest()->getPost('coffeetype_value');
           $resultJson = $coffee_type_value;
           $collection = $this->_productCollectionFactory->create();
           $collection->addAttributeToFilter('type_id', array('eq' => 'configurable'));
           $collection->addAttributeToFilter('status', 1);

           $collection->addFieldToFilter(array(
            array('attribute'=>'coffee_type','eq'=> $coffee_type_value),
           ));

           $products = $collection->getData();
           $attributes_coffee_type = array();
           if(!empty($products)){
               foreach($products as $products_coffeetype){
                  $product_colletion_entity = $objectManager->get('Magento\Catalog\Model\Product')->load($products_coffeetype['entity_id']);
                // modified by surya for excluding subscription products
                array_push($attributes_coffee_type,['id'=>$product_colletion_entity->getID(),'label'=>$product_colletion_entity->getName(),'subenb'=>$product_colletion_entity->getData('subscription')]);
                // modified by surya for excluding subscription products
            
               }    
           }
        }
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($attributes_coffee_type);
        return $resultJson;
             
    }
    

    
}