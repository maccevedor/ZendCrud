<?php

class Application_Form_Animalform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');
        $text_animal=new Zend_Form_Element_Text('animal_name',array('label'=>'Animal name:'));
        $this->addElement($text_animal);
        $submit_animal=new Zend_Form_Element_Submit('animal_submit',array('label'=>'Save animal'));
        $this->addElement($submit_animal);
    }


}

