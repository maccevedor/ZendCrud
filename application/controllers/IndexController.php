<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $tab_animal= new Application_Model_DbTable_Animal();
        $this->view->animals = $tab_animal->fetchAll();
    }

    public function showformAction()
    {
       $this->view->form = new Application_Form_Animalform();
       $this->view->form->setAction($this->view->url(array('controller'=>'index','action'=>'createform')));


    }

    public function createformAction()
    {
        // action body
        $request=$this->getRequest();
        if ($request->isPost()) 
        {
         $form_animal = new Application_Form_Animalform();
         if ($form_animal->isValid( $request->getPost()) ) 
            { 
              $data = array('name'=>$form_animal->getValue('animal_name') );
              $tab_animal= new Application_Model_DbTable_Animal();
              $tab_animal->insert($data);
               $form_animal->reset(); 
           }
        }
        $this->_helper->redirector('index');
    }

    public function editAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        $tab_animal= new Application_Model_DbTable_Animal();
        $animal = $tab_animal->find($id)->current(); 
        $this->view->form = new Application_Form_Animalform();
        $this->view->form->populate($animal->toArray());
        $this->view->form->setAction($this->view->url(array('controller'=>'index','action'=>'update','id'=>$id, 'name'=>$animal['name'] ) ) );
    }

    public function deleteAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        $tab_animal= new Application_Model_DbTable_Animal();
        $animal = $tab_animal->find($id)->current();
        $animal->delete();
        return $this->_helper->redirector('index');
    }

    public function updateAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        $name = $this->getRequest()->getParam('animal_name');
        $tab_animal= new Application_Model_DbTable_Animal();
        $animal = $tab_animal->find($id)->current(); 
        $request=$this->getRequest();
        if ($request->isPost()) 
        {
          $data = array('id'=>$id , 'name'=> $name );
          $animal->setFromArray($data);
          $animal->save();
          return $this->_helper->redirector('index');
        }
    }


}











