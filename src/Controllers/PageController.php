<?php
namespace Vibrary\Controllers;

/**
 * Class PageController
 * @package Vibrary\Controllers
 */
class PageController extends Controller
{

    /**
     * @var
     */
    public $userData;
    /**
     * @var
     */
    public $pageData;

    /**
     * PageController constructor.
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    function addUserPageData()
    {
        if ($this->userData) {
            $this->addPageData(
                'user',
                array(
                    "id" => $this->userData['user']->id,
                    "name" => $this->userData['oAuth']->name,
                    "email" => $this->userData['oAuth']->email,
                    )
            );
        }
    }

    /**
     *
     */
    function setMessages()
    {
        $this->setSuccessMessage();
        $this->setErrorMessage();
    }

    /**
     * @param string $message
     */
    function setSuccessMessage($message = '')
    {
        if ($message) {
            $this->addPageData('successMessage', $message);
        } elseif (array_key_exists('success_message', $_SESSION)) {
            $this->addPageData('successMessage', $_SESSION['success_message']);
        }
        unset($_SESSION['success_message']);
    }

    /**
     * @param string $message
     */
    function setErrorMessage($message = '')
    {
        if ($message) {
            $this->addPageData('errorMessage', $message);
        } elseif (array_key_exists('error_message', $_SESSION)) {
            $this->addPageData('errorMessage', $_SESSION['error_message']);
        }
        unset($_SESSION['error_message']);
    }

    /**
     * @param $key
     * @param $data
     */
    function addPageData($key, $data)
    {
        $this->pageData[$key] = $data;
    }

    /**
     * @return mixed
     */
    function getPageData()
    {
        $this->addUserPageData();
        $this->setMessages();
        return $this->pageData;
    }

    /**
     * @param $view
     * @param array $data
     * @return array
     */
    function view($view, $data = array())
    {
        return array("view" => $view, "data" => $data);
    }
}
