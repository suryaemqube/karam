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



namespace Mirasvit\RewardsAdminUi\Block\Adminhtml\Spending\Rule\Edit\Tab;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Renderer\Fieldset;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Rule\Block\Actions;
use Mirasvit\Rewards\Helper\Rule\Style;

class Cart extends Form
{
    private   $widgetFormRendererFieldset;

    private   $actions;

    private   $formFactory;

    private   $registry;

    private   $context;

    private   $ruleStyle;

    protected $_nameInLayout = 'conditions_serialized';

    public function __construct(
        Style $ruleStyle,
        Fieldset $widgetFormRendererFieldset,
        Actions $actions,
        FormFactory $formFactory,
        Registry $registry,
        Context $context,
        array $data = []
    ) {
        $this->ruleStyle                  = $ruleStyle;
        $this->widgetFormRendererFieldset = $widgetFormRendererFieldset;
        $this->actions                    = $actions;
        $this->formFactory                = $formFactory;
        $this->registry                   = $registry;
        $this->context                    = $context;

        parent::__construct($context, $data);
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Mirasvit\Rewards\Model\Spending\Rule $spendingRule */
        $spendingRule = $this->registry->registry('current_spending_rule');
        $form         = $this->formFactory->create();

        $formName     = 'rewards_spending_rule_form';
        $fieldsetName = 'rule_cart_actions_fieldset';

        $form->setHtmlIdPrefix($formName);

        $url      = $this->getUrl(
            'rewards/spending_rule/newConditionHtml/form/' . $formName . $fieldsetName,
            ['form_namespace' => $formName]
        );
        $renderer = $this->widgetFormRendererFieldset
            ->setTemplate('Magento_CatalogRule::promo/fieldset.phtml')
            ->setNewChildUrl($url)
            ->setFieldSetId($formName . $fieldsetName)
            ->setNameInLayout($this->_nameInLayout);

        $fieldset = $form->addFieldset($fieldsetName, [
            'legend' => __(
                'Apply the rule only to cart items matching the following conditions (leave blank for all items)'
            ),
        ])->setRenderer($renderer);

        $fieldset->addField('actions', 'text', [
            'name'           => 'actions',
            'label'          => __('Apply To'),
            'title'          => __('Apply To'),
            'required'       => true,
            'data-form-part' => $formName,
        ])->setRule($spendingRule)->setRenderer($this->actions);

        $form->setValues($spendingRule->getData());
        $this->setConditionFormName($spendingRule->getConditions(), $formName);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Handles addition of form name to condition and its conditions.
     *
     * @param \Magento\Rule\Model\Condition\AbstractCondition $conditions
     * @param string                                          $formName
     *
     * @return void
     */
    private function setConditionFormName(\Magento\Rule\Model\Condition\AbstractCondition $conditions, $formName)
    {
        $conditions->setFormName($formName);

        if ($conditions->getConditions() && is_array($conditions->getConditions())) {
            foreach ($conditions->getConditions() as $condition) {
                $this->setConditionFormName($condition, $formName);
            }
        }
    }
}
