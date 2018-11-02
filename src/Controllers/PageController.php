<?php
namespace Vibrary\Controllers;

class PageController extends Controller {

    public $userData;
    public $pageData;

    function __construct() {
        parent::__construct();
    }

    function addUserPageData() {
        if($this->userData) {
            $this->addPageData(
                'user'
                , array(
                    "id" => $this->userData['user']->id,
                    "name" => $this->userData['oAuth']->name,
                    "email" => $this->userData['oAuth']->email,
                    )
            );
        }
    }

    function setMessages() {
        $this->setSuccessMessage();
        $this->setErrorMessage();
    }

    function setSuccessMessage($message = '') {
        if($message) {
            $this->addPageData('successMessage', $message);
        } else if(array_key_exists('success_message', $_SESSION)) {
            $this->addPageData('successMessage', $_SESSION['success_message']);
        }
        unset($_SESSION['success_message']);
    }

    function setErrorMessage($message = '') {
        if($message) {
            $this->addPageData('errorMessage', $message);
        } else if(array_key_exists('error_message', $_SESSION)) {
            $this->addPageData('errorMessage', $_SESSION['error_message']);
        }
        unset($_SESSION['error_message']);
    }

    function addPageData($key, $data) {
        $this->pageData[$key] = $data;
    }

    function getPageData() {
        $this->addUserPageData();
        $this->setMessages();
        return $this->pageData;
    }

    function view($view, $data = array()) {
        return array("view" => $view, "data" => $data);
    }

}