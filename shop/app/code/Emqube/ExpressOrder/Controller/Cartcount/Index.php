<?php

namespace Emqube\ExpressOrder\Controller\Cartcount;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use Magento\Checkout\Helper\Cart;
use Magento\Framework\Message\ManagerInterface;
class Index extends Action
{

    protected $cartHelper;
    protected $messageManager;
    protected $resultFactory;
    public function __construct(     
        Cart $cartHelper,
        Context $context,
        ManagerInterface $messageManager,
        ResultFactory $resultFactory
    ) {
        $this->cartHelper = $cartHelper;
        $this->messageManager = $messageManager;
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        
            $cart_qty = $this->cartHelper->getItemsCount();
            // if($cart_qty=='0'){
            //     $this->messageManager->addError(__("Cart is empty"));
            // }else{
            //     $this->messageManager->addError(__("Cart is empty"));
            //     $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            //     $redirect->setPath('/shop/checkout/');

            //     return $redirect;
            // }
           
            
            $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            //$resultJson->setData($size_attriburtes);
            $resultJson->setData($cart_qty);
            
            return $resultJson;
        
    }
    

    
}