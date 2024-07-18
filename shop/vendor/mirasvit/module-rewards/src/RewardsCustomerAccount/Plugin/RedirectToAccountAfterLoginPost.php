<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-rewards
 * @version   3.2.4
 * @copyright Copyright (C) 2024 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\RewardsCustomerAccount\Plugin;

use Magento\Customer\Controller\Account\LoginPost;
use Magento\Framework\Controller\Result\Redirect as ResultRedirect;
use Magento\Framework\Controller\Result\Forward as ResultForward;
use Mirasvit\Rewards\Model\Config;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\UrlInterface;

class RedirectToAccountAfterLoginPost
{
    private $config;

    private $storeManager;

    protected $customerSession;

    protected $url;

    public function __construct(
        Config $config,
        StoreManagerInterface $storeManager,
        Session $customerSession,
        UrlInterface $url
    ) {
        $this->config          = $config;
        $this->storeManager    = $storeManager;
        $this->customerSession = $customerSession;
        $this->url             = $url;
    }

    /**
     * @param LoginPost $subject
     * @param ResultRedirect|ResultForward $result
     *
     * @return ResultRedirect|ResultForward
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterExecute(LoginPost $subject, $result)
    {
        if ($this->config->getGeneralIsRedirectAfterLogin($this->storeManager->getStore())
            && !$subject->getRequest()->getParam('product')
            && $this->customerSession->authenticate($this->url->getUrl(\Magento\Customer\Model\Url::ROUTE_ACCOUNT_LOGIN))) {
            $result->setPath('rewards/account');
        }

        return $result;
    }
}
