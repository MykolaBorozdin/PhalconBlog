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
    }
    
    /**
     * Shows the form to create a new product
     */
    public function newAction()
    {
        $this->view->form = new ArticleForm(null, array('edit' => true));
    }
    
    /**
     * Creates a new product
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("products/index");
        }
        print_r($this->request->getPost());
        echo '<br>';
        $form = new ArticleForm;
        $article = new Article();
        $form->bind($this->request->getPost(), $article);
        echo "form=";
        var_dump(get_object_vars($form));
        echo "article=";
        var_dump(get_object_vars($article));
        $data = $this->request->getPost();
        if (!$form->isValid($data, $article)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('article/new');
        }
        if ($article->save() == false) {
            foreach ($article->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('article/new');
        }
        $form->clear();
        $this->flash->success("Article was created successfully");
        return $this->forward("article/index");
    }
    
}
