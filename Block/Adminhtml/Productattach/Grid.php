<?php

/**
 * MagePrince
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category MagePrince
 * @package Prince_Productattach
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Prince\Productattach\Block\Adminhtml\Productattach;

/**
 * Class Grid
 * @package Prince\Productattach\Block\Adminhtml\Productattach
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Prince\Productattach\Model\ResourceModel\Productattach\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \Prince\Productattach\Model\Productattach
     */
    private $productattach;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Prince\Productattach\Model\Productattach $productattachPage
     * @param \Prince\Productattach\Model\ResourceModel\Productattach\CollectionFactory $collectionFactory
     * @param \Magento\Core\Model\PageLayout\Config\Builder $pageLayoutBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Prince\Productattach\Model\Productattach $productattach,
        \Prince\Productattach\Model\ResourceModel\Productattach\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->productattach = $productattach;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->setId('productattachGrid');
        $this->setDefaultSort('productattach_id');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return \Magento\Backend\Block\Widget\Grid
     */
    public function _prepareCollection()
    {
        $collection = $this->collectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    public function _prepareColumns()
    {
        $this->addColumn('productattach_id', [
            'header'    => __('ID'),
            'index'     => 'productattach_id',
        ]);
        
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name'
            ]
        );

        $this->addColumn(
            'description',
            [
                'header' => __('Description'),
                'index' => 'description'
            ]
        );

        $this->addColumn(
            'file',
            [
                'header' => __('File'),
                'index' => 'file',
                'renderer' => 'Prince\Productattach\Block\Adminhtml\Productattach\Renderer\FileIcon'
            ]
        );
        
        $this->addColumn(
            'customer_group',
            [
                'header' => __('Customer Group'),
                'index' => 'customer_group',
                'renderer' => 'Prince\Productattach\Block\Adminhtml\Productattach\Renderer\Group'
            ]
        );

        $this->addColumn(
            'store',
            [
                'header' => __('Store '),
                'index' => 'store',
                'renderer' => 'Prince\Productattach\Block\Adminhtml\Productattach\Renderer\Store'
            ]
        );

        $this->addColumn(
            'active',
            [
                'header' => __('Active'),
                'index' => 'active',
                'renderer' => 'Prince\Productattach\Block\Adminhtml\Productattach\Renderer\Active'
            ]
        );
       
        $this->addColumn(
            'action',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'class' => 'action-secondary',
                        'url' => [
                            'base' => '*/*/edit',
                            'params' => ['store' => $this->getRequest()->getParam('store')]
                        ],
                        'field' => 'productattach_id'
                    ]
                ],
                'sortable' => false,
                'filter' => false,
                'css_class' => 'scalable action-secondary',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * Row click url
     *
     * @param \Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return false;
    }

    /**
     * Get grid url
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
