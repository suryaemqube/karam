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



namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $spendingRule = $this->_initSpendingRule();

        if ($spendingRule->getId()) {
            $this->initPage($resultPage)
                ->getConfig()->getTitle()->prepend(__("Edit Spending Rule '%1'", $spendingRule->getName()));

            return $resultPage;
        } else {
            $this->messageManager->addError(__('The Spending Rule does not exist.'));
            $this->_redirect('*/*/');
        }
    }
}
