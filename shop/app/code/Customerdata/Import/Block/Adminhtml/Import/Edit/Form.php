<?php

namespace Customerdata\Import\Block\Adminhtml\Import\Edit;
use Magento\Config\Model\Config\Source\Yesno;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Config\Model\Config\Source\Yesno
     */
    protected $_yesno;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Lof\Setup\Model\System\Config\Source\Export\ExportFolders
     */
    //protected $_exportFolders;

    /**
     * @var Yesno
     */
    protected $_yesNo;

    /**
     * @var \Lof\Setup\Model\System\Config\Source\Import
     */
    //protected $_importFiles;

    /**
     * @param \Magento\Backend\Block\Template\Context                    $context       
     * @param \Magento\Framework\Registry                                $registry      
     * @param \Magento\Framework\Data\FormFactory                        $formFactory   
     * @param \Lof\Setup\Model\System\Config\Source\Export\ExportFolders $exportFolders 
     * @param \Magento\Store\Model\System\Store                          $systemStore   
     * @param \Lof\Setup\Model\System\Config\Source\Import\Files         $importFiles   
     * @param Yesno                                                      $yesNo         
     * @param array                                                      $data          
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        //\Lof\Setup\Model\System\Config\Source\Export\ExportFolders $exportFolders,
        \Magento\Store\Model\System\Store $systemStore,
        //\Lof\Setup\Model\System\Config\Source\Import\Files $importFiles,
        \Magento\Config\Model\Config\Source\Yesno $yesno,
        array $data = []
    ) {
        
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_yesno = $yesno;
        //$this->_exportFolders = $exportFolders;
        $this->_systemStore = $systemStore;
       // $this->_importFiles = $importFiles;
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    { 
        /**
         * Checking if user have permission to save information
         */
        if($this->_isAllowedAction('Customerdata_Import::import')) {
            $isElementDisabled = false;
        }else {
            $isElementDisabled = true;
        }

        /**
 * @var \Magento\Framework\Data\Form $form 
*/
        $form = $this->_formFactory->create(
            [
                    'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                    ]
                ]
        );

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Order Export')]);

          
        $fieldset->addField(
            'date_from',
            'date',
            [
                'name' => 'date_from',
                'label' => __('From Date'),
                'title' => __('From Date'),
                'date_format' => $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT),
                'required' => true,
                'class' => 'validate-date'
            ]
        );

        $fieldset->addField(
            'date_to',
            'date',
            [
                'name' => 'date_to',
                'label' => __('To Date'),
                'title' => __('To Date'),
                'date_format' => $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT),
                'required' => true,
                'class' => 'validate-date'
            ]
        );
       /* $fieldset->addField(
            'overwrite_blocks',
            'select',
            [
                'name' => 'overwrite_blocks',
                'label' => __('Overwrite Existing Blocks'),
                'title' => __('Overwrite Existing Blocks'),
                'values' => $this->_yesno->toArray(),
                'value' => 1,
                'note' => __('If set to <b>Yes</b>, the import data will override exist data. Check exits data according to the field <b>URL Key</b> of <b>Cms Pages</b> and the field <b>Identifier</b> of <b>Static Block</b>.<br><br>If set to <b>No</b>, the function import will empty data of all table of <b>CMS Page</b> and <b>Static Block</b>, then insert import data.')
            ]
        );

        $field = $fieldset->addField(
            'store_id',
            'select',
            [
                    'name' => 'store_id',
                    'label' => __('Configuration Scope'),
                    'title' => __('Configuration Scope'),
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                    'disabled' => $isElementDisabled,
                    'note' => __('Imported configuration settings will be applied to selected scope (selected store view or website). If you\'re not sure what is \'scope\' in Magento system configuration.<br/><br/>It is highly recommended to leave the default scope <strong>\'Default Config\'</strong>. In this case imported configuration will be applied to all existing store views.')
                ]
        );*/

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Check permission for passed action
     *
     * @param  string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}