<?php

namespace Emqube\ExpressOrder\Controller\Roastprofile;

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
        // if ($this->getRequest()->getPost('coffee_no_id') && $this->getRequest()->getPost('coff_type') && $this->getRequest()->getPost('product_id')){
    if ($this->getRequest()->getPost('product_id')){
          $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        //    $coffee_no_id=$this->getRequest()->getPost('coffee_no_id');
        //    $coff_type=$this->getRequest()->getPost('coff_type');
           $product_id=$this->getRequest()->getPost('product_id');

           $product_child = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
           $_children_array = $product_child->getTypeInstance()->getUsedProducts($product_child);
           $productIds =array();
           foreach ($_children_array as $child){
            
              array_push($productIds,$child->getID());
           }

           //$category_id_array=['41'];
           $helper = $objectManager->get('Emqube\ExpressOrder\Helper\Data');
           $stringtoarray = $helper->CategoryList();
           $category_id_array = explode(",",$stringtoarray);
           
           $collection = $this->_productCollectionFactory->create();
           $collection->addAttributeToSelect('*');
           $collection->addAttributeToFilter('type_id', \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE);
           $collection->addCategoriesFilter(['in' => $category_id_array]);
           $collection->addAttributeToFilter('status', 1);
           $collection->addIdFilter($productIds);

        //    $collection->addAttributeToFilter('coffee_no','310');
        //    $collection->addFieldToFilter(
        //         array(array('attribute'=>'coffee_no','eq'=> $coffee_no_id)),
               
        //     );
            // $collection->addFieldToFilter(
            //     array( array('attribute'=>'coffee_type','eq'=> $coff_type))
            // );
           $attributes_coffee_raoster= array();
           $products = $collection->getData();
           
           if(!empty($products)){
               foreach($products as $products_coffeeroast){
                   
                $product_att = $objectManager->get('Magento\Catalog\Model\Product')->load($products_coffeeroast['entity_id']);
                array_push($attributes_coffee_raoster,['value'=>$product_att->getData('roast_profile'),'label'=>$product_att->getAttributeText('roast_profile')]);
            
               }    
           }
           $coffee_roast_attribute ='';
           if(!empty($attributes_coffee_raoster)){
               $coffee_roast_attribute = array_unique($attributes_coffee_raoster,SORT_REGULAR);
           }
          
           $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            //$resultJson->setData($size_attriburtes);
           $resultJson->setData($coffee_roast_attribute);
            
           return $resultJson;

        }
           
        //    return $collection;
            
        
    }
    

    
}