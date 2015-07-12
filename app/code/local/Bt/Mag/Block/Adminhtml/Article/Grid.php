<?php
class Bt_Mag_Block_Adminhtml_Article_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('bt_mag/article_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {	
        return $this->getUrl('adminhtml/article/edit',['id' => $row->getId()]);
    }

    protected function _prepareColumns()
    {
        $articleSingleton = Mage::getSingleton(
            'bt_mag/article'
        );
        $this->addColumn('article_id', [
            'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'article_id',
        ])
            ->addColumn('category', [
            'header' => $this->_getHelper()->__('Category'),
            'type' => 'options',
            'index' => 'category',
            'options' => $articleSingleton->getCategories()
        ])
            ->addColumn('title', [
            'header' => $this->_getHelper()->__('Titre'),
            'type' => 'text',
            'index' => 'title',
        ])
            ->addColumn('size', [
            'header' => $this->_getHelper()->__('Taille'),
            'type' => 'options',
            'index' => 'size',
            'options' => $articleSingleton->getSizes()
        ])
            ->addColumn('update_time', [
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'update_time',
        ])
            ->addColumn('action', [
            'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions' => [
                [
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url' => ['base' => 'adminhtml/article/edit'],
                    'field' => 'id'
                ],
            ],
            'filter' => false,
            'sortable' => false,
            'index' => 'article_id',
        ]);

        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('bt_mag');
    }
}
