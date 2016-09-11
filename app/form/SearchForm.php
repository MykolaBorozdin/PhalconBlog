<?php

/**
 * The start action, it shows the "search" view
 */
class SearchForm extends Form
{
    public function indexAction()
    {
        $this->persistent->searchParams = null;
        $this->view->form               = new ProductsForm;
    }
}