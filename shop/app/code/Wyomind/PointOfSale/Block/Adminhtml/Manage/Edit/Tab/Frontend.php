<?php

/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Wyomind\PointOfSale\Block\Adminhtml\Manage\Edit\Tab;

/**
 * Class Frontend
 * @package Wyomind\PointOfSale\Block\Adminhtml\Manage\Edit\Tab
 */
class Frontend extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    public $wysiwygConfig;
    public function __construct(
        \Wyomind\PointOfSale\Helper\Delegate $wyomind,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        /** @delegation off */
        array $data = []
    )
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * @return \Magento\Backend\Block\Widget\Form\Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('pointofsale');
        $form = $this->_formFactory->create();
        $fieldset = $form->addFieldset('frontend_storelocator', ['legend' => __('Store Locator')]);
        $fieldset->addField('store_locator_description_use_global', 'select', ['name' => 'store_locator_description_use_global', 'label' => __('Store locator description template'), 'title' => __('Store locator description template'), 'options' => [1 => __('Use the global description template'), 0 => __('Use this POS/WH description template')]]);
        $fieldset->addField('store_locator_description', 'textarea', ['name' => 'store_locator_description', 'label' => __('Description template'), 'title' => __('Description template'), 'note' => 'Html and css code are supported. ' . '<br/>Available variables: {{code}}, {{name}}, {{phone}}, {{email}}, {{address_1}}, {{address_2}}, {{city}}, {{state}}, {{country}}, {{zipcode}}, {{hours}}, {{description}}, {{image}}, {{link}}' . '<br/>And all custom attributes configured: {{additional_attribute_code}}']);
        $fieldset = $form->addFieldset('frontend_storepage', ['legend' => __('Store Page')]);
        $fieldset->addField('store_page_enabled', 'select', ['name' => 'store_page_enabled', 'label' => __('Enable store page'), 'values' => [['value' => 1, 'label' => __('Yes')], ['value' => 0, 'label' => __('No')]]]);
        $fieldset->addField('store_page_url_key', 'text', ['name' => 'store_page_url_key', 'label' => __('Url key'), 'title' => __('Url key')]);
        $fieldset->addField('store_page_content_use_global', 'select', ['name' => 'store_page_content_use_global', 'label' => __('Page content template'), 'title' => __('Page content template'), 'options' => [1 => __('Use the global page content template'), 0 => __('Use this POS/WH page content template')]]);
        $wysiwygConfig = $this->wysiwygConfig->getConfig();
        $wysiwygConfig->setData('add_widgets', false);
        $fieldset->addField('store_page_content', 'editor', ['name' => 'store_page_content', 'label' => __('Content template'), 'title' => __('Content template'), 'config' => $wysiwygConfig, 'note' => 'Html and css code are supported. ' . '<br/>Available variables : {{code}}, {{name}}, {{phone}}, {{email}}, {{address_1}}, {{address_2}}, {{city}}, {{state}}, {{country}}, {{zipcode}}, {{hours}}, {{description}}, {{image}}, {{link}}, {{google_map}}' . '<br/>And all custom attributes configured: {{additional_attribute_code}}']);
        $fieldset->addField('store_page_meta_title_use_global', 'select', ['name' => 'store_page_meta_title_use_global', 'label' => __('Page meta title'), 'title' => __('Page meta title'), 'options' => [1 => __('Use the global page meta title'), 0 => __('Use this POS/WH page meta title')]]);
        $fieldset->addField('store_page_meta_title', 'text', ['name' => 'store_page_meta_title', 'label' => __('Meta title'), 'title' => __('Meta title')]);
        $fieldset->addField('store_page_meta_keywords_use_global', 'select', ['name' => 'store_page_meta_keywords_use_global', 'label' => __('Page meta keywords'), 'title' => __('Page meta keywords'), 'options' => [1 => __('Use the global page meta keywords'), 0 => __('Use this POS/WH page meta keywords')]]);
        $fieldset->addField('store_page_meta_keywords', 'textarea', ['name' => 'store_page_meta_keywords', 'label' => __('Meta keywords'), 'title' => __('Meta keywords')]);
        $fieldset->addField('store_page_meta_description_use_global', 'select', ['name' => 'store_page_meta_description_use_global', 'label' => __('Page meta description'), 'title' => __('Page meta description'), 'options' => [1 => __('Use the global page meta description'), 0 => __('Use this POS/WH page meta description')]]);
        $fieldset->addField('store_page_meta_description', 'textarea', ['name' => 'store_page_meta_description', 'label' => __('Meta description'), 'title' => __('Meta description')]);
        $fieldset->addField('store_page_meta_robots_use_global', 'select', ['name' => 'store_page_meta_robots_use_global', 'label' => __('Page meta robots'), 'title' => __('Page meta robots'), 'options' => [1 => __('Use the global page meta robots'), 0 => __('Use this POS/WH page meta robots')]]);
        $fieldset->addField('store_page_meta_robots', 'select', ['name' => 'store_page_meta_robots', 'label' => __('Meta robots'), 'title' => __('Meta robots'), 'options' => ['NO INDEX, NO FOLLOW' => 'NO INDEX, NO FOLLOW', 'NO INDEX, FOLLOW' => 'NO INDEX, FOLLOW', 'INDEX, FOLLOW' => 'INDEX, FOLLOW', 'INDEX, NO FOLLOW' => 'INDEX, NO FOLLOW']]);
        $fieldset->addField('store_page_layout_update', 'textarea', ['name' => 'store_page_layout_update', 'label' => __('Layout update'), 'title' => __('Layout update')]);
        $this->setChild('form_after', $this->getLayout()->createBlock('Magento\\Backend\\Block\\Widget\\Form\\Element\\Dependence')->addFieldMap('store_page_enabled', 'store_page_enabled')->addFieldMap('store_page_url_key', 'store_page_url_key')->addFieldMap('store_page_content', 'store_page_content')->addFieldMap('store_page_meta_title', 'store_page_meta_title')->addFieldMap('store_page_meta_keywords', 'store_page_meta_keywords')->addFieldMap('store_page_meta_description', 'store_page_meta_description')->addFieldMap('store_page_meta_robots', 'store_page_meta_robots')->addFieldMap('store_locator_description_use_global', 'store_locator_description_use_global')->addFieldMap('store_page_content_use_global', 'store_page_content_use_global')->addFieldMap('store_page_meta_title_use_global', 'store_page_meta_title_use_global')->addFieldMap('store_page_meta_keywords_use_global', 'store_page_meta_keywords_use_global')->addFieldMap('store_page_meta_description_use_global', 'store_page_meta_description_use_global')->addFieldMap('store_page_meta_robots_use_global', 'store_page_meta_robots_use_global')->addFieldMap('store_locator_description', 'store_locator_description')->addFieldDependence('store_page_url_key', 'store_page_enabled', 1)->addFieldDependence('store_page_content', 'store_page_enabled', 1)->addFieldDependence('store_page_content_use_global', 'store_page_enabled', 1)->addFieldDependence('store_locator_description', 'store_locator_description_use_global', 0)->addFieldDependence('store_page_content', 'store_page_content_use_global', 0)->addFieldDependence('store_page_meta_title', 'store_page_meta_title_use_global', 0)->addFieldDependence('store_page_meta_keywords', 'store_page_meta_keywords_use_global', 0)->addFieldDependence('store_page_meta_description', 'store_page_meta_description_use_global', 0)->addFieldDependence('store_page_meta_robots', 'store_page_meta_robots_use_global', 0));
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('Frontend');
    }
    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Frontend');
    }
    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }
    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}