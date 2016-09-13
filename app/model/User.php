<?php
use Phalcon\Mvc\Collection;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;
class User extends Collection
{
    public $id;
    public $name;    
}
    // public function validation()
    // {
        // $this->validate(
            // new StringLengthValidator(
                // array(
                    // "field"   => "email",
                    // 'max' => 50,
                    // 'min' => 5,
                    // "messageMinimum" => "Email must be long",
                    // "messageMaximum" => "Email must be not too long"
                // )
            // )
        // );
//         
        // $this->validate(
            // new StringLengthValidator(
                // array(
                    // "field"   => "password",
                    // 'max' => 50,
                    // 'min' => 2,
                    // "messageMinimum" => "Password must be long",
                    // "messageMaximum" => "Password must be not too long"
                // )
            // )
        // );
//         
        // $this->validate(
            // new EmailValidator(
                // array(
                    // "field"   => "email",
                    // "message" => "Email must be of email format"
                // )
            // )
        // );
//         
        // $this->validate(new UniquenessValidator(array(
            // 'field' => 'email',
            // 'message' => 'Sorry, The email was registered by another user'
        // )));
//         
// 
        // return $this->validationHasFailed() != true;
    // }
