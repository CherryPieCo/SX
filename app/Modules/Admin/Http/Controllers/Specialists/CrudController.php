<?php

namespace App\Modules\Admin\Http\Controllers\Specialists;

use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController as BaseController;

class CrudController extends BaseController
{

    public function setup()
    {
        $this->crud->setModel(User::class);
        $this->crud->setRoute("admin/specialists");
        $this->crud->setEntityNameStrings('specialist', 'specialists');

        $this->crud->setColumns(['name']);
        $this->crud->addField([
            'name' => 'name',
            'label' => "Tag name"
        ]);
        $this->crud->addField([
            'name' => 'diploma_image_base64',
            'label' => "diploma_image",
            'type' => 'image',
        ]);

        $this->crud->enableAjaxTable();

        $this->crud->addClause('where', 'type', '=', User::TYPE_SPECIALIST);
    }

    public function store()
    {
        return parent::storeCrud();
    }

    public function update()
    {
        return parent::updateCrud();
    }
}