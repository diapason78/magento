<?php
class Bt_Mag_Block_Adminhtml_Mag_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('bt_mag/mag_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getRowUrl($row)
    {	
        return $this->getUrl('adminhtml/mag/edit',['id' => $row->getId()]);
    }

    protected function _prepareColumns()
    {
        $magSingleton = Mage::getSingleton('bt_mag/mag');
        $this->addColumn('magazine_id', [
            'header' => $this->_getHelper()->__('N°'),
            'type' => 'number',
            'index' => 'magazine_id',
        ])
            ->addColumn('under_number', [
            'header' => $this->_getHelper()->__('Sous N°'),
            'type' => 'text',
            'index' => 'under_number',
        ])
            ->addColumn('title', [
            'header' => $this->_getHelper()->__('Titre'),
            'type' => 'options',
            'index' => 'title',
            'options' => $magSingleton->getTitles()
        ])
            ->addColumn('uri', [
            'header' => $this->_getHelper()->__('Cle URL'),
            'type' => 'text',
            'index' => 'uri',
        ])
            ->addColumn('status', [
            'header' => $this->_getHelper()->__('Statut'),
            'type' => 'options',
            'index' => 'Status',
            'options' => $magSingleton->getStatuses()
        ])
            ->addColumn('update_time', [
            'header' => $this->_getHelper()->__('Date mise à jour'),
            'type' => 'datetime',
            'index' => 'update_time',
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ])
            ->addColumn('push_forward', [
            'header' => $this->_getHelper()->__('Mise en avant'),
            'type' => 'radio',
            'html_name' => 'push_forward[]',
            'align'     => 'center',
            'index' => 'push_forward',
            'value'    => ['1']
        ])
;


        return parent::_prepareColumns();
    }

    protected function _getHelper()
    {
        return Mage::helper('bt_mag');
    }
}
