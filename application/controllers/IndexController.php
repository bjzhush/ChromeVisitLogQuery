<?php
class IndexController extends Boot_ControllerBase
{

    public function indexAction()
    {
        date_default_timezone_set('Asia/Chongqing');

        $post = $this->getPost();
        if (count($post)) {
            if ($this->getRequest()->getCookie('user') != 'bjzhush') {
                exit("Auth required");
            }
            $table = Boot_Registry::getTable('Chromeurllog');
            $select = $table->select();

            if (strlen($post['start']) && strlen ($post['end'])) {
                $timeStart = date("Y-m-d H:i:s" ,strtotime($post['start']));
                $timeEnd   = date("Y-m-d H:i:s" ,strtotime($post['end']));
                $select->where(sprintf("time < '%s'", $timeEnd))
                       ->where(sprintf("time > '%s'", $timeStart));
            }

            if (strlen($post['key'])) {
                $select->where(sprintf("url like '%%%s%%'", $post['key']));
            }

            $historyList           = $table->fetchAll($select)->toArray();

            $this->view->hList     = $historyList;
            $this->view->key       = $post['key'];
            $this->view->resultCount = count($historyList);
            if (isset($this->timeStart)) {
                $this->view->timeStart = $timeStart;
                $this->view->timeEnd   = $timeEnd;
            }
        }

    }


}

