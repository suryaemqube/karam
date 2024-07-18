<?php

namespace Emqube\ExpressOrder\Controller\Variations;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableProTypeModel;

class Index extends Action
{
    protected $request;
    protected $_productRepository;

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
        Product $product) {
        $this->_productRepository = $productRepository;
        $this->_configurableProTypeModel = $configurableProTypeModel;
        $this->_product = $product;
        parent::__construct($context);
    }

    public function execute()
    {
        
        if ($this->getRequest()->getPost('product_id')){
            $assocateProId = false;
            $product_id=$this->getRequest()->getPost('product_id');
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $configProduct = $objectManager->create('Magento\Catalog\Model\Product')->load($product_id);
            $_children = $configProduct->getTypeInstance()->getUsedProducts($configProduct);
            $assocateProId=array();
            foreach ($_children as $child){
                
                //array_push($assocateProId,['id'=>$child->getID(),'name'=>$child->getName()]);
                array_push($assocateProId,['value'=>$child->getData('size'),'label'=>$child->getAttributeText('size'),'id'=>$child->getID()]);

            }
            $size_attriburtes ='';
            if(!empty($assocateProId)){
                $size_attriburtes = array_unique($assocateProId,SORT_REGULAR);
            }
             
            $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            //$resultJson->setData($size_attriburtes);
            $resultJson->setData($size_attriburtes);
            
            return $resultJson;
        }
    }
    

    
}