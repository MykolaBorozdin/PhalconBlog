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
     * Search products based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Products", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }
        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }
        $products = Products::find($parameters);
        if (count($products) == 0) {
            $this->flash->notice("The search did not find any products");
            return $this->forward("products/index");
        }
        $paginator = new Paginator(array(
            "data"  => $products,
            "limit" => 10,
            "page"  => $numberPage
        ));
        $this->view->page = $paginator->getPaginate();
    }
    /**
     * Shows the form to create a new product
     */
    public function newAction()
    {
        $this->view->form = new ArticleForm(null, array('edit' => true));
    }
    /**
     * Edits a product based on its id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $article = Article::findFirstById($id);
            if (!$article) {
                $this->flash->error("Article was not found");
                return $this->forward("article/index");
            }
            $this->view->form = new ArticleForm($product, array('edit' => true));
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
        $form = new ArticleForm;
        $article = new Article();
        $data = $this->request->getPost();
        if (!$form->isValid($data, $article)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/new');
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
    /**
     * Saves current product in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("article/index");
        }
        $id = $this->request->getPost("id", "int");
        $article = Article::findFirstById($id);
        if (!$article) {
            $this->flash->error("Article does not exist");
            return $this->forward("article/index");
        }
        $form = new ArticleForm;
        $this->view->form = $form;
        $data = $this->request->getPost();
        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('products/edit/' . $id);
        }
        if ($article->save() == false) {
            foreach ($article->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('article/edit/' . $id);
        }
        $form->clear();
        $this->flash->success("Article was updated successfully");
        return $this->forward("$article/index");
    }
    /**
     * Deletes a product
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $article = Article::findFirstById($id);
        if (!$article) {
            $this->flash->error("Article was not found");
            return $this->forward("article/index");
        }
        if (!$article->delete()) {
            foreach ($article->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward("article/search");
        }
        $this->flash->success("Article was deleted");
        return $this->forward("$article/index");
    }
}
