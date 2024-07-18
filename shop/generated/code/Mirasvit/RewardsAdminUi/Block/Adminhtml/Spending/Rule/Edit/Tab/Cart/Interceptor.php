<?php
namespace Mirasvit\RewardsAdminUi\Block\Adminhtml\Spending\Rule\Edit\Tab\Cart;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Block\Adminhtml\Spending\Rule\Edit\Tab\Cart
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Block\Adminhtml\Spending\Rule\Edit\Tab\Cart implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Helper\Rule\Style $ruleStyle, \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $widgetFormRendererFieldset, \Magento\Rule\Block\Actions $actions, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Framework\Registry $registry, \Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        $this->___init();
        parent::__construct($ruleStyle, $widgetFormRendererFieldset, $actions, $formFactory, $registry, $context, $data);
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
