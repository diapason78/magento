<?php
class Bt_Mag_Block_Adminhtml_Mag_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'bt_mag';
        $this->_controller = 'mag';
        $this->_mode = 'edit';
        $newOrEdit = $this->getRequest()->getParam('id') ? $this->__('Modifier le ') : $this->__('Nouveau');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Mag');
    }
}
