<?php
namespace Mageants\StoreLocator\Block\Adminhtml\Storelocator\Edit\Tabs\Schedule;

/**
 * Interceptor class for @see \Mageants\StoreLocator\Block\Adminhtml\Storelocator\Edit\Tabs\Schedule
 */
class Interceptor extends \Mageants\StoreLocator\Block\Adminhtml\Storelocator\Edit\Tabs\Schedule implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Mageants\StoreLocator\Helper\Data $helper, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $registry, $formFactory, $helper, $data);
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
