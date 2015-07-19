<?php
class Bt_Mag_Block_Adminhtml_Mag extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();
        $this->_blockGroup = 'bt_mag';
        $this->_controller = 'mag';
        $this->_headerText = Mage::helper('bt_mag')->__('Magazines');
        $this->_addButtonLabel = Mage::helper('bt_mag')->__('Ajouter un magazine');
    }

    public function getCreateUrl()
    {
        return $this->getUrl('adminhtml/mag/edit');
    }
}
