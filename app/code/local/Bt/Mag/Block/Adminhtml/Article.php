<?php
class Bt_Mag_Block_Adminhtml_Article extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();
        $this->_blockGroup = 'bt_mag';
        $this->_controller = 'article';
        $this->_headerText = Mage::helper('bt_mag')->__('Articles');
        $this->_addButtonLabel = Mage::helper('bt_mag')->__('Ajouter un article');
    }

    public function getCreateUrl()
    {
        return $this->getUrl('adminhtml/article/edit');
    }
}
