<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        if(!$this->session->has("user_id")){
            return $this->dispatcher->forward(array(
                'controller' => 'index', 'action' => 'login'
            ));
        }
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");
            if ($username === "") {
                $this->flashSession->error("return enter your username");
                return $this->dispatcher->forward(array(
                    'controller' => 'index', 'action' => 'notify'
                ));
            }
            if ($password === "") {
                $this->flashSession->error("return enter your password");
                return $this->dispatcher->forward(array(
                    'controller' => 'index', 'action' => 'notify'
                ));
            }
//            check login
            $this->session->set("user_id", $username);
            $this->flashSession->success('Login Success!!!');
            return $this->dispatcher->forward(array(
                'controller' => 'index', 'action' => 'notify'
            ));
        }
    }
    public function logoutAction(){
        $this->session->remove("user_id");
        $this->flashSession->success('Logout Success!!!');
        return $this->dispatcher->forward(array(
            'controller' => 'index', 'action' => 'notify'
        ));
    }
    public function notifyAction(){

    }
}