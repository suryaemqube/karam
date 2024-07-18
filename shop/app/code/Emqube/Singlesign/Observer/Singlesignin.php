<?php

namespace Emqube\Singlesign\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Response\RedirectInterface ;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\UrlInterface;
class Singlesignin implements ObserverInterface
{

 protected $customerRepositoryInterfaceNew;
 protected $_curl;
 protected $redirect;
 protected $_storeManager;
 protected $_urlInterface;
 public function __construct(RedirectInterface $redirect,Http $request,Curl $curl,StoreManagerInterface $storeManager,UrlInterface $urlInterface){    
     
    $this->customerRepositoryInterfaceNew = $request;
    $this->_curl = $curl;
    $this->redirect = $redirect;
    $this->_storeManager = $storeManager;
    $this->_urlInterface = $urlInterface;
  
 }
  public function execute(\Magento\Framework\Event\Observer $observer)
  {    

    // $post_data=$this->customerRepositoryInterfaceNew->getPost();
    // $dispatch_data=get_object_vars($post_data);
    $customer = $observer->getEvent()->getCustomer();
    $baseurl = $this->_storeManager->getStore()->getBaseUrl();
    $baseurl = str_replace("shop/", "",$baseurl);
    //$customer = $observer->getEvent()->getData('customer');
    $customerID = $customer->getId();
    $secret_token='Emqube';
    $dispatch_data=array();
    $fname='';
    $lname='';
    $email='';
    $password_confirmation='';
    $id='';
    
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password_confirmation'])){
        if($_POST['firstname']!='' && $_POST['lastname']!='' && $_POST['email']!='' && $_POST['password_confirmation']!=''){
            $fname=$_POST['firstname'];
            $lname=$_POST['lastname'];
            $email=$_POST['email'];
            $password_confirmation=$_POST['password_confirmation'];
            $dispatch_data=array(
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email,
                'password_confirmation' => $password_confirmation
    
    
            );
        }
        
    }
    if(!empty($dispatch_data)){
        
        // Setup request to send json via POST
        $name=strtolower($dispatch_data['firstname']).strtolower($dispatch_data['lastname']);
        
        $email=$dispatch_data['email'];
        try{
            
            $data = array(
                'username' => $name.$customerID,
                'email' => $email,
                'password' => $dispatch_data['password_confirmation']
            );

            //$url = "https://mohammeds44.sg-host.com/wp-json/wp/v2/users/register";
            $url =  $baseurl."wp-json/wp/v2/users/register";
           
            //if the method is post
            $data=json_encode($data);
            $this->_curl->setHeaders([
                'Content-Type' => 'application/json'
            ]);
            $this->_curl->post($url, $data);
            //response will contain the output in form of JSON string
            $response = $this->_curl->getBody();
            $key_id=json_decode($response);
           
            if(isset($key_id->id)){
                $id=$key_id->id;
            }
            
            if($id!='' && $customerID!=''){
                // $url_api_update = "https://mohammeds44.sg-host.com/wp-json/wp/v2/updateuser?magento_customer_id=".$customerID."&user_id=".$id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&token=".$secret_token."";
                setcookie('MOSHIN',$id." ".$customerID, 1, "/"); 
                $url_api_update = $baseurl."wp-json/wp/v2/updateuser?magento_customer_id=".$customerID."&user_id=".$id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&token=".$secret_token."";
                 
                $url_api_update = str_replace(" ", '%20', $url_api_update);
                $this->_curl->get($url_api_update);
                $response_key_update = $this->_curl->getBody();
                $key_update=json_decode($response_key_update);
            }
            
        }
        catch (\Exception $e) {
             return;
            // $this->_logger->critical('Error Curl', ['exception' => $e]);
        }   

    }
    return;
  } 

}
