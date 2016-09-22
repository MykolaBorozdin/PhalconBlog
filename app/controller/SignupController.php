<?php

use Phalcon\Mvc\Controller;

class SignupController extends BaseController {
    public function indexAction() {
        $this->view->hideLogin = TRUE;
    }
    
    public function registerAction() {
        $user = new User();
        $arr = $this->request->getPost();
        foreach ($arr as $key => $value) {
            echo $key."=".$value."\n";
        }
        $user->password = $arr['password'];
        $user->email = $arr['email'];
        
        if ($user->save() == false) {
            echo "Umh, We can't store users right now: \n";
            foreach ($user->getMessages() as $message) {
                echo $message, "\n";
            }
        } else {
            echo "Great, a new user was saved successfully!";
            return $this->dispatcher->forward(
                        [
                            'controller' => 'index',
                            'action'     => 'index'
                        ]
             );
        }
    }
}
