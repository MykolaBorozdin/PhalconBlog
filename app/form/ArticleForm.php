<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class ArticleForm extends Form
{
    public function initialize($entity = null, $options = array())
    {
        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $title = new Text("title");
        $title->setLabel("Title");
        $title->setFilters(array('striptags', 'string'));
        $title->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => 'Title is required'
                    )
                )
            )
        );
        $this->add($title);

        $text = new TextArea("text");
        $text->setLabel("Text");
        $text->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => 'Text is required'
                    )
                )
            )
        );
        $this->add($text);
    }
}