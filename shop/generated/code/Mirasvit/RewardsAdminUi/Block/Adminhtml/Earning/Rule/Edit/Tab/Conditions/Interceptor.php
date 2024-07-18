<?php
namespace Mirasvit\RewardsAdminUi\Block\Adminhtml\Earning\Rule\Edit\Tab\Conditions;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Block\Adminhtml\Earning\Rule\Edit\Tab\Conditions
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Block\Adminhtml\Earning\Rule\Edit\Tab\Conditions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Widget\Form\Renderer\Fieldset $widgetFormRendererFieldset, \Magento\Rule\Block\Conditions $conditions, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Framework\Registry $registry, \Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        $this->___init();
        parent::__construct($widgetFormRendererFieldset, $conditions, $formFactory, $registry, $context, $data);
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
