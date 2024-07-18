<?php

namespace Emqube\ExpressOrder\Controller\Price;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableProTypeModel;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Index extends Action
{
    protected $request;
    protected $_productRepository;
    protected $_productCollectionFactory;
    /**
     * @var \Magento\ConfigurableProduct\Model\Product\Type\Configurable
     */
    private $_configurableProTypeModel;
 
    /**
     * @var \Magento\Catalog\Model\Product
     */
    private $_product;

    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        ConfigurableProTypeModel $configurableProTypeModel,
        CollectionFactory $productCollectionFactory,
        Product $product) {
        $this->_productRepository = $productRepository;
        $this->_configurableProTypeModel = $configurableProTypeModel;
        $this->_product = $product;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        
        $resultJson='';
        if ($this->getRequest()->getPost('product_id')  && $this->getRequest()->getPost('coffee_type') && $this->getRequest()->getPost('coff_weight')){     
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

            $product_id=$this->getRequest()->getPost('product_id');
            $coffee_type=$this->getRequest()->getPost('coffee_type');
            $coff_weight=$this->getRequest()->getPost('coff_weight');

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
            array(array('attribute'=>'coffee_type','eq'=> $coffee_type)),
           );
           $collection->addFieldToFilter(
            array(array('attribute'=>'coffee_weight','eq'=> $coff_weight)),
           );
           $products_child = $collection->getData();
           $price_check=array();
           $price['price']='';
           $price_final=0;
           if(!empty($products_child)){
               foreach($products_child as $products_child_price){
                 $configProductprice = $objectManager->create('Magento\Catalog\Model\Product')->load($products_child_price['entity_id']);
                 $special_price = $configProductprice->getSpecialPrice();


               //   added by surya 14-07-2022

               $orgprice = $configProductprice->getPrice();
               $specialprice = $configProductprice->getSpecialPrice();
               $specialfromdate = $configProductprice->getSpecialFromDate();
               $specialtodate = $configProductprice->getSpecialToDate();
               $today = time();


               // if ((is_null($specialfromdate) &&is_null($specialtodate)) || ($today >= strtotime($specialfromdate) &&is_null($specialtodate)) || ($today <= strtotime($specialtodate) &&is_null($specialfromdate)) || ($today >= strtotime($specialfromdate) && $today <= strtotime($specialtodate))) {
               //    // return 1;
               //    $price_final = $specialprice;
               // } else {
               //    $price_final = $orgprice;
               // }
               //   added by surya 14-07-2022



// added by Mohsin on 24th Feb 2023 starts

if (is_null($specialfromdate) && is_null($specialtodate) && is_null($specialprice)) {
   $price_final = $orgprice;
} else if (strtotime($specialfromdate) <= $today && $today <= strtotime($specialtodate)) {
   $price_final = $specialprice;
} else {
   $price_final = $orgprice;
}
// added by Mohsin on 24th Feb 2023 ends



               // commented code
               //   if($special_price){
               //      $price_final = $configProductprice->getSpecialPrice();
               //   }else{
               //      $price_final = $configProductprice->getPrice();
               //   }
                              
                 array_push($price_check,$price_final);
               }
           }
          
           if(count($price_check) < 2 && !empty($price_check)){
              $price['price']=$price_check;
           }else{
              $price['price']='';
           }

          
        }   

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        //$resultJson->setData($size_attriburtes);
        $resultJson->setData($price);
        
        return $resultJson;
    }
    

    
}