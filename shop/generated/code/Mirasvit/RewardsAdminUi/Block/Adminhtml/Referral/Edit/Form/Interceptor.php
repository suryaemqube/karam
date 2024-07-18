<?php
namespace Mirasvit\RewardsAdminUi\Block\Adminhtml\Referral\Edit\Form;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Block\Adminhtml\Referral\Edit\Form
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Block\Adminhtml\Referral\Edit\Form implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\FormFactory $formFactory, \Magento\Framework\Registry $registry, \Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        $this->___init();
        parent::__construct($formFactory, $registry, $context, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getForm');
        return $pluginInfo ? $this->___callPlugins('getForm', func_get_args(), $pluginInfo) : parent::getForm();
    }
}
