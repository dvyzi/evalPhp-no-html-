<?php

namespace Cooker\controllers;


class MainController
{
    public function __construct()
    {
    }

    /** HomePage **/
    public function index()
    {
        require VIEWS . 'Layout.php';
    }
}
