<?php
/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\HomepageBannerSlider\Block\Adminhtml\Bannerslider\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config as WysiwygConfig;
use Magento\Store\Model\System\Store as SystemStore;

class Info extends Generic implements TabInterface
{
    /**
     * Info constructor.
     *
     * @param Context       $context
     * @param Registry      $registry
     * @param FormFactory   $formFactory
     * @param WysiwygConfig $wysiwygConfig
     * @param SystemStore   $systemStore
     * @param array         $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        WysiwygConfig $wysiwygConfig,
        SystemStore $systemStore,
        array $data = []
    ) {
        $this->wysiwygConfig = $wysiwygConfig;
        $this->systemStore   = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prpeare form
     *
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('bannerslider');
        $form  = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information')]
        );
        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }

        $fieldset->addField(
            'status',
            'select',
            [
                'name'    => 'status',
                'label'   => __('Status'),
                'comment' => __('Status'),
                'values'  => [
                    [
                        'value' => 'Enabled',
                        'label' => 'Enabled',
                    ],
                    [
                        'value' => 'Disabled',
                        'label' => 'Disabled',
                    ],
                ],
            ]
        );
        
        $fieldset->addField(
            'title',
            'text',
            [
                'name'     => 'title',
                'label'    => __('Title'),
                'comment'  => __('Title'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'slidertitle',
            'editor',
            [
                'name' => 'slidertitle',
                'label' => __('Desktop Slider Title'),
                'title' => __('Desktop Slider Title'),
                'style' => 'height:1px',
                'required' => false,
                'config' => $this->wysiwygConfig->getConfig(),
                'note'    => 'Display title on the image.',
            ]
        );

        $fieldset->addField(
            'mobileslider_title',
            'editor',
            [
                'name' => 'mobileslider_title',
                'label' => __('Mobile Slider Title'),
                'title' => __('Mobile Slider Title'),
                'style' => 'height:1px',
                'required' => false,
                'config' => $this->wysiwygConfig->getConfig(),
                'note'    => 'Display title on the image.',
            ]
        );

        $fieldset->addField(
            'enable_button',
            'select',
            [
                'name'    => 'enable_button',
                'label'   => __('Enable Button'),
                'comment' => __('Enable Button'),
                'values'  => [
                    [
                        'value' => '0',
                        'label' => 'No',
                    ],
                    [
                        'value' => '1',
                        'label' => 'Yes',
                    ],
                ],
            ]
        );

        $fieldset->addField(
            'buttontitle',
            'text',
            [
                'name'    => 'buttontitle',
                'label'   => __('Button Title'),
                'comment' => __('Button Title'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'text_position',
            'select',
            [
                'name'    => 'text_position',
                'label'   => __('Button Position'),
                'comment' => __('Button Position'),
                'values'  => [
                    [
                        'value' => 'top-left',
                        'label' => 'Top Left',
                    ],
                    [
                        'value' => 'top-right',
                        'label' => 'Top Right',
                    ],
                    [
                        'value' => 'bottom-left',
                        'label' => 'Bottom Left',
                    ],
                    [
                        'value' => 'bottom-right',
                        'label' => 'Bottom Right',
                    ],
                    [
                        'value' => 'center',
                        'label' => 'Center',
                    ],
                ],
            ]
        );

        $fieldset->addField(
            'url_key',
            'text',
            [
                'name'    => 'url_key',
                'label'   => __('Button Url Key'),
                'comment' => __('Button Url Key'),
                'class'   => 'validate-url',
                'required' => true,
                'note'    => 'E.g : https://test.com/test.html',
            ]
        );

        $fieldset->addField(
            'open_new_tab',
            'select',
            [
                'name'    => 'open_new_tab',
                'label'   => __('Open Link In New Tab'),
                'comment' => __('Open Link In New Tab'),
                'default' => '1',
                'value'   => 1,
                'values'  => [
                    ['label' => 'Yes', 'value' => 1],
                    ['label' => 'No', 'value' => 0]]
            ]
        );

        $fieldset->addField(
            'imagename',
            'image',
            [
                'name'     => 'imagename',
                'label'    => __('Desktop Image'),
                'comment'  => __('Image'),
                'required' => true,
                'note'     => 'Maximum file size: 2 MB. Allowed file types: jpg,jpeg,png,svg,gif',
            ]
        );

        $fieldset->addField(
            'mobileimagename',
            'image',
            [
                'name'    => 'mobileimagename',
                'label'   => __('Mobile Image'),
                'comment' => __('Mobile Image'),
                'note'    => 'Maximum file size: 2 MB. Allowed file types: jpg,jpeg,png,svg,gif',
            ]
        );

        $fieldset->addField(
            'position',
            'text',
            [
                'name'    => 'position',
                'label'   => __('Position'),
                'comment' => __('Position'),
                'class'   => 'validate-number',
                'note'=>   "<script type='text/javascript'>
                            require([
                                'jquery'
                            ], function ($) {
                                'use strict';
                                jQuery(document).ready(function(){
                                    function updatefeilds() {
                                        var enable_button = $('#enable_button').val();
                                        if(enable_button=='1')
                                        {
                                            $('#buttontitle').addClass('required-entry');
                                            $('#buttontitle').parent().parent().show(); 
                                            $('#text_position').parent().parent().show(); 
                                            $('#url_key').parent().parent().show();
                                            $('#url_key').addClass('required-entry'); 
                                            $('#open_new_tab').parent().parent().show();
                                        } else {
                                           $('#buttontitle').removeClass('required-entry');
                                           $('#buttontitle').parent().parent().hide(); 
                                           $('#text_position').parent().parent().hide(); 
                                           $('#url_key').parent().parent().hide();
                                           $('#url_key').removeClass('required-entry'); 
                                           $('#open_new_tab').parent().parent().hide();
                                        }
                                    }
                                    $('#enable_button').change(function(){
                                        updatefeilds();
                                    });
                                    var pathname = window.location.pathname;
                                    if(pathname.includes('new')){
                                        $('#open_new_tab').val(1);
                                        $('#text_position').val('center');
                                    }
                                    setInterval(updatefeilds, 500);
                                });
                            });
                            </script>"
            ]
        );

        $fieldset->addField(
            'store_id',
            'multiselect',
            [
                'name'     => 'store_id[]',
                'label'    => __('Store Views'),
                'title'    => __('Store Views'),
                'required' => true,
                'values'   => $this->systemStore->getStoreValuesForForm(false, true),
            ]
        );
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Get Label
     *
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('Bannerslider');
    }

    /**
     * Get Tab Title
     *
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Bannerslider');
    }

    /**
     * Check Tab Can show
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Check if it is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}
