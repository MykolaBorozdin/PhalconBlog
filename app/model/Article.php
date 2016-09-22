<?php
use Phalcon\Mvc\Collection;
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
    
}