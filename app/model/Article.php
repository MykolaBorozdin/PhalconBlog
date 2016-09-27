<?php
use Phalcon\Mvc\Collection;
use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;

class Article extends Collection
{
    public $title;
    public $text;
    public $authorId;
    public $createdDate;
    public $updatedDate;
    
    public function bindObject($requestData, $session){
        if(!is_null($requestData)) {
            $this->title = $requestData['title'];
            $this->text = $requestData['text'];
            $this->createdDate = new MongoDate();
            $this->authorId = $session->get('currentUser');
        }
    }
    
    public function getCreatedDate() {
        if (!is_null($this->createdDate)) {
            return date('Y-M-d h:i:s', $this->createdDate->sec);
        } else {
            return "";
        }
    }
    
    public function getUpdatedDate() {
        if (!is_null($this->updatedDate)) {
            return date('Y-M-d h:i:s', $this->updatedDate->sec);
        } else {
            return "";
        }
    }
    
    public function validation() {
        $this->validate(
            new StringLengthValidator(
                array(
                    "field"   => "title",
                    'max' => 50,
                    'min' => 2,
                    "messageMinimum" => "Title must be not empty",
                    "messageMaximum" => "Title must be not too long"
                )
            )
        );
        
        $this->validate(
            new StringLengthValidator(
                array(
                    "field"   => "text",
                    'max' => 500,
                    'min' => 2,
                    "messageMinimum" => "Text must be long",
                    "messageMaximum" => "Text must be not too long"
                )
            )
        );
        return $this->validationHasFailed() != true;
    }
    
}