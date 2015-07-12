<?php
class Bt_Mag_Block_Adminhtml_Article_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                'bt_mag_adminhtml/article/edit',
                ['_current' => true,
                 'continue' => 0]
            ),
            'method' => 'post',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset = $form->addFieldset('general', ['legend' => $this->__('Article Details')]);
        $articleSingleton = Mage::getSingleton('bt_mag/article');

        // Add the fields that we want to be editable.
        $this->_addFieldsToFieldset($fieldset, array(
            'article_id' => [
                'label' => $this->__('Id'),
                'input' => 'text',
                'required' => true,
            ],
            'title' => [
                'label' => $this->__('Title'),
                'input' => 'text',
                'required' => true,
            ],
            'size' => [
                'label' => $this->__('Size'),
                'input' => 'select',
                'required' => true,
                'options' => $articleSingleton->getSizes(),
            ],
            'category' => [
                'label' => $this->__('Category'),
                'input' => 'select',
                'required' => true,
                'options' => $articleSingleton->getCategories(),
            ],
            'img_path' => [
                'label' => $this->__('Img path'),
                'input' => 'text',
                'required' => true,
            ],
            'background_color' => [
                'label' => $this->__('Background color'),
                'input' => 'text',
                'required' => true,
            ],
            'rubric' => [
                'label' => $this->__('Rubrique'),
                'input' => 'text',
                'required' => true,
            ],
            'title_1' => [
                'label' => $this->__('Titre Ligne 1'),
                'input' => 'text',
                'required' => true,
            ],
            'title_2' => [
                'label' => $this->__('Titre Ligne 2'),
                'input' => 'text',
                'required' => true,
            ],
            'content' => [
                'label' => $this->__('Content'),
                'input' => 'textarea',
                'required' => true,
            ]
        ));

        return $this;
    }

    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('articleData'));
        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }

            // Wrap all fields with brandData group.
            $_data['name'] = "articleData[$name]";

            // Generally, label and title are always the same.
            $_data['title'] = $_data['label'];

            // If no new value exists, use the existing brand data.
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getArticle()->getData($name);
            }

            // Finally, call vanilla functionality to add field.
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Retrieve the existing brand for pre-populating the form fields.
     * For a new brand entry, this will return an empty brand object.
     */
    protected function _getArticle()
    {
        if (!$this->hasData('article')) {
            // This will have been set in the controller.
            $article = Mage::registry('current_article');

            // Just in case the controller does not register the brand.
            if (!$article instanceof
                    Bt_Mag_Model_Article) {
                $article = Mage::getModel(
                    'bt_mag/article'
                );
            }

            $this->setData('article', $article);
        }

        return $this->getData('article');
    }
}
