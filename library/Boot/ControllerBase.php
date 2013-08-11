<?php
abstract class Boot_ControllerBase extends Zend_Controller_Action
{
    protected $db;
    public function getdb() {
        $this->db = Zend_Db_Table::getDefaultAdapter();
        return $this->db;
    }

    public function getPost($key = NULL) {
        return $this->getRequest()->getPost($key);
    }


}
