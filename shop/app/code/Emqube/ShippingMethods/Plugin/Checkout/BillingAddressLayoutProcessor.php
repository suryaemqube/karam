<?php
namespace Emqube\ShippingMethods\Plugin\Checkout;
 
use Magento\ShippingMethods\Block\Checkout\LayoutProcessor;
 
 
class BillingAddressLayoutProcessor
{
    public function afterProcess(
        LayoutProcessor $subject,
        array $jsLayout
    )
    {
         

      
        
        

        return $jsLayout;

    }
 
}