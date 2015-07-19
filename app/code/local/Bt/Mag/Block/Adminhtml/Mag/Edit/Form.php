<?php
class Bt_Mag_Block_Adminhtml_Mag_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
		$form = new Varien_Data_Form([
            'id' => 'edit_form',
            'action' => $this->getUrl('adminhtml/mag/edit', ['_current' => true, 'continue' => 0]),
            'method' => 'post'
        ]);

        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset = $form->addFieldset('general', ['legend' => $this->__('Mag Details')]);
        $magSingleton = Mage::getSingleton('bt_mag/mag');
		$id = (int)$this->getRequest()->getParam('id');
        $this->_addFieldsToFieldset($fieldset, array(
            'magazine_id' => [
                'label' => $this->__('N°'),
                'input' => 'text',
                'required' => false,
                'readonly' => true
            ],
            'sub_number' => [
                'label' => $this->__('Sous numero'),
                'input' => 'text',
                'required' => true
            ],
            'title' => [
                'label' => $this->__('Titre Mag'),
                'input' => 'select',
                'required' => true,
                'options' => $magSingleton->getTitles()
            ],
            'uri' => [
                'label' => $this->__('Clé URL'),
                'input' => 'text',
                'required' => true
            ],
            'status' => [
                'label' => $this->__('Statut'),
                'input' => 'select',
                'required' => true,
                'options' => $magSingleton->getStatuses()
            ],
            'associated_articles' => [
                'label' => $this->__('Articles choisis'),
                'input' => 'multiselect',
                'required' => true,
                'options' => $magSingleton->getArticles()
            ]
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('magData'));
        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }
            $_data['name'] = "magData[$name]";
            $_data['title'] = $_data['label'];
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getMag()->getData($name);
            }
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    protected function _getMag()
    {
        if (!$this->hasData('mag')) {
            $mag = Mage::registry('current_mag');
            if (!$mag instanceof Bt_Mag_Model_Mag) {
                $mag = Mage::getModel('bt_mag/mag');
            }
            $this->setData('mag', $mag);
        }

        return $this->getData('mag');
    }
}
