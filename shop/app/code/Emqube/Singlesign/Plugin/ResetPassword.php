<?php
namespace Emqube\Singlesign\Plugin;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Response\Http as responseHttp;
use Magento\Framework\UrlInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Customer\Model\ForgotPasswordToken\GetCustomerByToken;
use Magento\Framework\App\ObjectManager;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Account\Redirect as AccountRedirect;
use \Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\HTTP\Client\Curl;
class ResetPassword
{

    
    protected $customerAccountManagement;
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;
    /**
     * @var GetCustomerByToken
     * @param GetCustomerByToken|null $getByToken
     */
    protected $getByToken;
      /**
     * @var AccountRedirect
     */
    protected $accountRedirect;
    //protected $redirecturl;
    protected $resultRedirectFactory;
    protected $response;
    protected $_url;
    protected $_curl;

    protected $_storeManager;

    public function __construct(
        Context $context,
       // CustomerRepositoryInterface $customerRepository,
        AccountManagementInterface $customerAccountManagement,
        responseHttp $response,
        UrlInterface $url,
        CustomerRepositoryInterface $customerRepository,
        GetCustomerByToken $getByToken = null,
        AccountRedirect $accountRedirect,
        Curl $curl,
        StoreManagerInterface $storeManager
        // $customerSession,
      
        
    ) {
        $objectManager = ObjectManager::getInstance();
        //$this->customerRepository = $customerRepository;
        $this->customerAccountManagement = $customerAccountManagement;
       // $this->$redirecturl = $redirect;
        $this->response = $response;
        $this->_url = $url;
        $this->customerRepository = $customerRepository;
        $this->getByToken = $getByToken
            ?: $objectManager->get(GetCustomerByToken::class);
        $this->accountRedirect = $accountRedirect;
        $this->_curl = $curl;
        $this->_storeManager = $storeManager;
        // $this->session = $customerSession;
      
    }

    public function beforeResetPassword(\Magento\Customer\Model\AccountManagement $subject,$email,$resetToken,$newPassword){
        $secret_token='Emqube';
        try{
            $baseurl = $this->_storeManager->getStore()->getBaseUrl();
            $baseurl = str_replace("shop/", "",$baseurl);
            $customer = $this->getByToken->execute($resetToken);
            $email = $customer->getEmail();
            $newPassword=$newPassword;
            if($email!='' && $newPassword!=''){
                // $url_api_reset = "https://mohammeds44.sg-host.com/wp-json/wp/v2/resetpassworduser?email=".$email."&password=".$newPassword."&token=".$secret_token."";
                $url_api_reset = $baseurl."wp-json/wp/v2/resetpassworduser?email=".$email."&password=".$newPassword."&token=".$secret_token."";
                
                $url_api_reset = str_replace(" ", '%20', $url_api_reset);
                $this->_curl->get($url_api_reset);
                $response_key_cancel = $this->_curl->getBody();
                $key_cancel=json_decode($response_key_cancel);
            }
                
        }catch (\Exception $e) {
            return;
        }
    
    
        
    }

}