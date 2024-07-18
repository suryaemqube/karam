<?php
namespace Magento\Payment\Gateway\Request\BuilderComposite;

/**
 * Interceptor class for @see \Magento\Payment\Gateway\Request\BuilderComposite
 */
class Interceptor extends \Magento\Payment\Gateway\Request\BuilderComposite implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\ObjectManager\TMapFactory $tmapFactory, array $builders = [])
    {
        $this->___init();
        parent::__construct($tmapFactory, $builders);
    }

    /**
     * {@inheritdoc}
     */
    public function build(array $buildSubject)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'build');
        return $pluginInfo ? $this->___callPlugins('build', func_get_args(), $pluginInfo) : parent::build($buildSubject);
    }
}
