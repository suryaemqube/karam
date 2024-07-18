<?php

namespace Meetanshi\SubscriptionRestriction\Helper;
use Magento\Customer\Block\Account\AuthorizationLink;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Request\Http;


class Data extends AbstractHelper
{
	/**
     * @var \Magento\Backend\Model\UrlInterface
     */

    protected $redirectPage;

    /**
     * @var \Magento\Customer\Block\Account\AuthorizationLink
     */
    protected $customerLogin;

    protected $urlInterface;

    /**
     * [__construct description].
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Customer\Block\Account\AuthorizationLink $customerLogin
     */
    public function __construct(
        Context                              $context,
        AuthorizationLink                    $customerLogin,
        \Magento\Framework\App\Response\Http $redirectPage,
        \Magento\Framework\UrlInterface $urlInterface
    ) {
        parent::__construct($context);
        $this->redirectPage = $redirectPage;
        $this->customerLogin = $customerLogin;
        $this->urlInterface = $urlInterface;
    }

    
    public function getCustomerLogin()
    {
       return $this->customerLogin->isLoggedIn();
    }
    public function getRedirectPage()
    {
        return $this->urlInterface->getUrl('customer/account/login', array('referer' => base64_encode($this->urlInterface->getCurrentUrl())));
    }
    
}
