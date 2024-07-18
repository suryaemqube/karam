<?php
namespace Wyomind\PointOfSale\Block\Adminhtml\Manage\Edit\Tab\Customergroups;

/**
 * Interceptor class for @see \Wyomind\PointOfSale\Block\Adminhtml\Manage\Edit\Tab\Customergroups
 */
class Interceptor extends \Wyomind\PointOfSale\Block\Adminhtml\Manage\Edit\Tab\Customergroups implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Wyomind\PointOfSale\Helper\Delegate $wyomind, \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, array $data = [])
    {
        $this->___init();
        parent::__construct($wyomind, $context, $registry, $formFactory, $data);
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
