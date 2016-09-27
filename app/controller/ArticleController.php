<?php

class ArticleController extends BaseController {
    /**
     * Shows the form to create a new product
     */
    public function newAction()
    {
        $this->view->currentUser =  ($this->session->get('currentUser'));   
        $this->view->form = new ArticleForm(null, array('edit' => true));
        $this->view->hideLogin = TRUE;
    }
    
    public function editAction($id)
    {
        $this->view->currentUser =  ($this->session->get('currentUser')); 
        $this->view->hideLogin = TRUE;
        $article = Article::findById($id);  
        $this->view->form = new ArticleForm($article, array('edit' => true));
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form = new ArticleForm;
            $article = Article::findById($post['id']);
            $form->bind($post, $article);
            if (!$form->isValid($post, $article)) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
                return $this->forward('index/index');
            }
            $article->updatedDate = new MongoDate();
            $form->clear();
            $this->flash->success("Article was created successfully");
            return $this->forward("index/index");
        }
        
    }

    public function deleteAction($id)
    {
        $this->view->currentUser =  ($this->session->get('currentUser')); 
        $article = Article::findById($id);  
        if ($article->delete() == false) {
            echo "Sorry, can not delete in the moment.";
        } else {
            return $this->forward("index/index");            
        }
    }
    
    /**
     * Creates a new product
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("products/index");
        }
        $post = $this->request->getPost();
        $form = new ArticleForm;
        $article = new Article();
        $article->bindObject($post, $this->session);
        $data = $this->request->getPost();
        if ($article->save() == false) {
            foreach ($article->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('article/new');
        }
        $form->clear();
        $this->flash->success("Article was created successfully");
        return $this->forward("index/index");
    }
    
}
