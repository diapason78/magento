<?php
class Bt_Mag_Block_Adminhtml_Article_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'bt_mag';
        $this->_controller = 'article';
        $this->_mode = 'edit';
        $newOrEdit = $this->getRequest()->getParam('id') ? $this->__('Edit') : $this->__('New');
        $this->_headerText =  $newOrEdit . ' ' . $this->__('Article');
    }
}
