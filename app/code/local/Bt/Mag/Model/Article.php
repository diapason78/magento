<?php
class Bt_Mag_Model_Article extends Mage_Core_Model_Abstract
{
    const BLOCK_SIMPLE = 0;
    const BLOCK_EXTENSIBLE = 1;
    const WIDTH_HALF = 0;
    const WIDTH_FULL = 1;

    protected function _construct()
    {
        $this->_init('bt_mag/article');
    }

    public function getCategories()
    {
        return [
            self::BLOCK_SIMPLE => Mage::helper('bt_mag')->__('Bloc simple'),
            self::BLOCK_EXTENSIBLE => Mage::helper('bt_mag')->__('Bloc extensible')
        ];
    }

    public function getSizes()
    {
        return [
            self::WIDTH_HALF => Mage::helper('bt_mag')->__('50%'),
            self::WIDTH_FULL => Mage::helper('bt_mag')->__('100%')
        ];
    }
    protected function _beforeSave()
    {
        parent::_beforeSave();

        $this->_updateTimestamps();
        $this->_prepareUrlKey();

        return $this;
    }

    protected function _updateTimestamps()
    {
        $timestamp = now();
        $this->setUpdatedAt($timestamp);

        return $this;
    }

    protected function _prepareUrlKey()
    {
        /**
         * In this method, you might consider ensuring
         * that the URL Key entered is unique and
         * contains only alphanumeric characters.
         */

        return $this;
    }
}
