<?php namespace Dmrch\UserExtension;

use Backend;
use Event;
use System\Classes\PluginBase;

/**
 * UserExtension Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.User'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'User Extension',
            'description' => 'Extension for RainLab.User',
            'author'      => 'Dmrch',
            'icon'        => 'icon-user'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {    

        \RainLab\User\Controllers\Users::extend(function($controller){
           $controller->implement[] = 'Backend.Behaviors.RelationController';
           $controller->relationConfig = '$/dmrch/userextension/controllers/address/config_relation.yaml';
        });

        \RainLab\User\Models\User::extend(function($model) {
            $model->hasMany = [
                'addresses' => ['Dmrch\UserExtension\Models\Address'],
            ];
        });

        // Extend all backend form usage
        Event::listen('backend.form.extendFields', function($widget) {

            // Only for the User controller
            if (!$widget->getController() instanceof \RainLab\User\Controllers\Users) {
                return;
            }

            // Only for the User model
            if (!$widget->model instanceof \RainLab\User\Models\User) {
                return;
            }

            // Add an extra birthday field
            $widget->addFields([
                'cpf' => [
                    'label'   => 'CPF',
                    'type'    => 'text',
                    'span' => 'right'
                ],

                'phone' => [
                    'label'   => 'Telefone',
                    'type'    => 'text',
                    'span' => 'left'
                ]
            ]);

            $widget->addTabFields([
                'addresses' => [
                    'tab' => 'Endereços',
                    'type' => 'partial',
                    'path' => '$/dmrch/userextension/controllers/address/_relation.htm'
                ]
            ]);

            // Remove a Surname field
            $widget->removeField('surname');
        });
    }
}
