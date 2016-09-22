<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller {
    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new ArticleForm;
        $this->view->articles = Article::find();
        $this->view->currentUser =  ($this->session->get('currentUser'));
    }
    
    private function _registerSession($user)
    {
        $this->session->set(
            'currentUser', $user->email
        );
    }
    
    private function _clearSession()
    {
        $this->session->remove('currentUser');
    }
    
    
    public function loginAction() {
        if ($this->request->isPost()) {
            $arr = $this->request->getPost();
            
            $user = User::findFirst(
                array(
                    array(
                        'email' => $arr['email'],
                        'password' => $arr['password']
                    )
                )
            );
            
            if (!$user) {
                $this->view->hideLogin = true;
                echo "Wrong password or email.";
            } else {
                echo "Hello, %username%!";
                $this->_registerSession($user);
    
                    $this->flash->success('Welcome ' . $user->name);
    
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'index',
                            'action'     => 'index'
                        ]
                    );
            }
        }
    }

    public function logoutAction() {
        $this->_clearSession();
        return $this->dispatcher->forward(
                        [
                            'controller' => 'index',
                            'action'     => 'index'
                        ]
       );
    }
    
}
