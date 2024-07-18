<?php 
namespace Emqube\Singlesign\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Customer\Model\Session;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\UrlInterface;
// use Magento\Framework\App\RequestInterface;

class Customeedit implements ObserverInterface
{

    
    protected $customerRepositoryInterfaceNew;
    public $_curl;
    public $customerSession;
    protected $_storeManager;
    protected $_urlInterface;

    public function __construct(Curl $curl,Session $customerSession,Http $request,StoreManagerInterface $storeManager,UrlInterface $urlInterface) {
         $this->customerRepositoryInterfaceNew = $request;
         $this->_curl = $curl;
         $this->customerSession = $customerSession;
         $this->_storeManager = $storeManager;
         $this->_urlInterface = $urlInterface;
      
    }

   
    public function execute(Observer $observer)
    {
         //$post_data = $this->customerRepositoryInterfaceNew->getPost();
         //  $dispatch_data=get_object_vars($post_data);
         $baseurl = $this->_storeManager->getStore()->getBaseUrl();
         $baseurl = str_replace("shop/", "",$baseurl);
         $dispatch_data=array();
         $fname='';
         $lname='';
         $email='';
         $password_confirmation='';
         $change_email_flag='';
         $change_password_flag='';

         if(isset($_POST['firstname'])){
            $fname=$_POST['firstname'];
         }
         if(isset($_POST['lastname'])){
            $lname=$_POST['lastname'];
         }
         if(isset($_POST['email'])){
            $email=$_POST['email'];
         }
         if(isset($_POST['email'])){
            $email=$_POST['email'];
         }
         if(isset($_POST['password_confirmation'])){
            $password_confirmation=$_POST['password_confirmation'];
         }
         if(isset($_POST['change_password'])){
            $change_password_flag=$_POST['change_password'];
         }
         if(isset($_POST['change_email'])){
            $change_email_flag=$_POST['change_email'];
         }
         
         $dispatch_data = array(
             'firstname' => $fname,
             'lastname' => $lname,
             'email' => $email,
             'password_confirmation' => $password_confirmation,
             'change_password' => $change_password_flag,
             'change_email' => $change_email_flag
         );
        //  echo "<pre>";
        //  print_r($dispatch_data);
       
        
        $secret_token='Emqube';
        // var_dump($this->customerSession->getCustomer()->getId());
        $magento_id = $this->customerSession->getCustomer()->getId();
        
        if(!empty($dispatch_data) && $magento_id!=''){

        
            // if($dispatch_data['firstname']!='' && $dispatch_data['lastname']!='' && $dispatch_data['change_email']=='' && $dispatch_data['change_password']==''){
                
            //   $url_api_update = "https://mohammeds44.sg-host.com/wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=&password=&token=".$secret_token.""; 
            
            // }
            // else if($dispatch_data['change_email']!='' && $dispatch_data['change_password']==''){
               
            //     $url_api_update = "https://mohammeds44.sg-host.com/wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=".$dispatch_data['email']."&password=&token=".$secret_token."";  
            
            // }else if($dispatch_data['change_email']=='' && $dispatch_data['change_password']!=''){
                
            //     $url_api_update = "https://mohammeds44.sg-host.com/wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=&password=".$dispatch_data['password_confirmation']."&token=".$secret_token."";
            
            
            // }else if($dispatch_data['change_email']!='' && $dispatch_data['change_password']!=''){
            //     //echo "both email pass";
            //     $url_api_update = "https://mohammeds44.sg-host.com/wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=".$dispatch_data['email']."&password=".$dispatch_data['password_confirmation']."&token=".$secret_token."";
                
            // }



            if($dispatch_data['firstname']!='' && $dispatch_data['lastname']!='' && $dispatch_data['change_email']=='' && $dispatch_data['change_password']==''){
               setcookie('MOSHIN_OK',$dispatch_data['firstname']." ".$dispatch_data['lastname'], 1, "/"); 
              $url_api_update = $baseurl."wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=&password=&token=".$secret_token.""; 
            
            }
            else if($dispatch_data['change_email']!='' && $dispatch_data['change_password']==''){
               
                $url_api_update = $baseurl."wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=".$dispatch_data['email']."&password=&token=".$secret_token."";  
            
            }else if($dispatch_data['change_email']=='' && $dispatch_data['change_password']!=''){
                
                $url_api_update = $baseurl."wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=&password=".$dispatch_data['password_confirmation']."&token=".$secret_token."";
            
            
            }else if($dispatch_data['change_email']!='' && $dispatch_data['change_password']!=''){
                //echo "both email pass";
                $url_api_update = $baseurl."wp-json/wp/v2/edituser?magento_customer_id=".$magento_id."&fname=".$dispatch_data['firstname']."&lastname=".$dispatch_data['lastname']."&email=".$dispatch_data['email']."&password=".$dispatch_data['password_confirmation']."&token=".$secret_token."";
                
            }

            $url_api_update = str_replace(" ", '%20', $url_api_update);
            $this->_curl->get($url_api_update);
            $key_updatee = $this->_curl->getBody();
           
           
            
        }
        //exit;
        return;
     
    }
}

?>