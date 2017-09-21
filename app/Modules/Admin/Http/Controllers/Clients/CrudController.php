<?php

namespace App\Modules\Admin\Http\Controllers\Clients;

use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController as BaseController;

class CrudController extends BaseController
{

    public function setup()
    {
        $this->crud->setModel(User::class);
        $this->crud->setRoute("admin/clients");
        $this->crud->setEntityNameStrings('client', 'clients');

        $this->crud->setColumns(['name']);
        $this->crud->addField([
            'name' => 'name',
            'label' => "Tag name"
        ]);
        $this->crud->addField([
            'name' => 'certificate_image_base64',
            'label' => "certificate_image",
            'type' => 'image',
        ]);

        $this->crud->enableAjaxTable();

        $this->crud->addClause('where', 'type', '=', User::TYPE_CLIENT);
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