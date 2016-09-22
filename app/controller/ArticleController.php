<?php

class ArticleController extends BaseController {
    public function initialize()
    {
        
    }
    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new ArticleForm;
        $this->view->articles = Article::find();
    }
    
    /**
     * Shows the form to create a new product
     */
    public function newAction()
    {
        $this->view->currentUser =  ($this->session->get('currentUser'));   
        $this->view->form = new ArticleForm(null, array('edit' => true));
    }
    
    public function editAction($id)
    {
        $this->view->currentUser =  ($this->session->get('currentUser')); 
        $article = Article::findById($id);  
        $this->view->form = new ArticleForm($article, array('edit' => true));
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form = new ArticleForm;
            $article = Article::findById($post['id']);
            $form->bind($post, $article);
            // var_dump(get_object_vars($article));
            if (!$form->isValid($post, $article)) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
                //return $this->forward('article/new');
            }
            $article->updatedDate = new MongoDate();
            if ($article->save() == false) {
                foreach ($article->getMessages() as $message) {
                    $this->flash->error($message);
                }
                //return $this->forward('article/new');
            }
            $form->clear();
            $this->flash->success("Article was created successfully");
            return $this->forward("index");
        }
        
    }

    public function deleteAction($id)
    {
        $this->view->currentUser =  ($this->session->get('currentUser')); 
        $article = Article::findById($id);  
        if ($article->delete() == false) {
            echo "Sorry, can not delete in the moment.";
        } else {
            return $this->forward("index");            
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
        //print_r($post);
        $form = new ArticleForm;
        $article = new Article();
        $article->bindObject($post, $this->session);
        //causes error [:error] [pid 5804:tid 1808] [client ::1:55295] Invalid object ID\r\n#0 [internal function]: MongoId->__construct('')
        //$form->bind($this->request->getPost(), $article);
        // var_dump(get_object_vars($article));
        $data = $this->request->getPost();
        // if (!$form->isValid($data, $article)) {
            // foreach ($form->getMessages() as $message) {
                // $this->flash->error($message);
            // }
            // return $this->forward('article/new');
        // }
        if ($article->save() == false) {
            foreach ($article->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('article/new');
        }
        $form->clear();
        $this->flash->success("Article was created successfully");
        return $this->forward("index");
    }
    
}
