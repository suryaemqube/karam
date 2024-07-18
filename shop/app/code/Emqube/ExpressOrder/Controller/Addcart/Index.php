<?php

namespace Emqube\ExpressOrder\Controller\Addcart;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Message\ManagerInterface;

class Index extends Action
{
   
    private $cart;
    private $productFactory;
    protected $messageManager;
    
    public function __construct(
        Context $context,
        Cart $cart, 
        ProductFactory $productFactory,
        ManagerInterface $messageManager) {
        $this->productFactory = $productFactory;
        $this->cart = $cart;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        
         //if ($this->getRequest()->getPost('product_id') && $this->getRequest()->getPost('quantity') && $this->getRequest()->getPost('price') && $this->getRequest()->getPost('coffee_no') && $this->getRequest()->getPost('coff_type') && $this->getRequest()->getPost('coff_roaster') && $this->getRequest()->getPost('coff_weight')){
        if ($this->getRequest()->getPost('product_id') && $this->getRequest()->getPost('quantity') && $this->getRequest()->getPost('price') && $this->getRequest()->getPost('coffee_type') && $this->getRequest()->getPost('coff_weight')){    
            $success='something went wrong';
            $product_id = $this->getRequest()->getPost('product_id');
            $quantity = $this->getRequest()->getPost('quantity');
            $price = $this->getRequest()->getPost('price');
            $coffee_type = $this->getRequest()->getPost('coffee_type');
            $coff_weight = $this->getRequest()->getPost('coff_weight');
           

            // $product = $this->productFactory->load($product_id);
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->get('\Magento\Catalog\Model\Product')->load($product_id);
            $cart = $this->cart;

            $options = array(
               // 205 => $coffee_no,
                //206 => $coffee_type,
                157 => $coff_weight
            );

            $params = array(
                'product' => $product_id,
                'super_attribute' => $options,
                'qty' => $quantity
            );

           try{
              $cart->addProduct($product, $params);
              $cart->save();
              $success="product ".$product->getName()." has been added to cart successfully";
              $this->messageManager->addSuccess(__("product ".$product->getName()." has been added to cart successfully "));
           }catch(\Exception $e){
              $this->messageManager->addError(__("something went wrong"));
              $success='something went wrong';
           }

        }else{
            $success='something went wrong';
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        //$resultJson->setData($size_attriburtes);
        $resultJson->setData($success);
    }

    
}