<?php namespace Dmrch\UserExtension\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Address Back-end Controller
 */
class Address extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Rainlab.User', 'user', 'address');
    }
}
