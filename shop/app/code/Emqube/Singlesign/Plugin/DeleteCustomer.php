<?php

namespace Emqube\Singlesign\Plugin ;
use Magento\Framework\HTTP\Client\Curl;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\UrlInterface;
class DeleteCustomer
{

    protected $_curl;
    protected $_storeManager;
    protected $_urlInterface;
    public function __construct(Curl $curl,StoreManagerInterface $storeManager,UrlInterface $urlInterface) {
      
        $this->_curl = $curl;
        $this->_storeManager = $storeManager;
        $this->_urlInterface = $urlInterface;
        // $this->session = $customerSession;
      
    }
    public function aroundDeleteById(
        \Magento\Customer\Model\ResourceModel\CustomerRepository $subject,
        \Closure $proceed,
        $customerId
    ) {

        $baseurl = $this->_storeManager->getStore()->getBaseUrl();
        $baseurl = str_replace("shop/", "",$baseurl);
        $secret_token='Emqube';
        // You can add your logic here

        if($customerId!=''){
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $customerFactory = $objectManager->get('\Magento\Customer\Model\CustomerFactory')->create();
            $customer = $customerFactory->load($customerId);
            $email_id = $customer->getEmail();
    
            // $url_api_delete = "https://mohammeds44.sg-host.com/wp-json/wp/v2/deleteuser?customer_id=".$customerId."&token=".$secret_token."";
            $url_api_delete = $baseurl."wp-json/wp/v2/deleteuser?customer_id=".$customerId."&token=".$secret_token."&email=".$email_id;
            $this->_curl->get($url_api_delete);
            $response_key_delete = $this->_curl->getBody();
            $key_delete=json_decode($response_key_delete);
        }
        
        // It will proceed ahead with the default delete function        
        $result = $proceed($customerId);

        return $result;
    }
}
