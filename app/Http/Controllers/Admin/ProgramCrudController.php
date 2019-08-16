<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProgramRequest as StoreRequest;
use App\Http\Requests\ProgramRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProgramCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProgramCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Program');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/program');
        $this->crud->setEntityNameStrings('program', 'programs');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // Columns (in list table)
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'exercices', 'type' => 'text', 'label' => 'Exercice count']);


        // Fields
        $this->crud->addField(['name' => 'user_id', 'type' => 'hidden', 'value' => backpack_user()->id]);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name', 'attributes' => ['required' => 'required']]);

        $this->crud->addField(['label' => "Exercises",
            'type' => 'select2_multiple',
            'name' => 'exercises', // the method that defines the relationship in your Model
            'entity' => 'exercise', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Exercise", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?])
        ]);

        $this->crud->addField([
            'name' => 'image',
            'type' => 'image',
            'label' => 'Image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio;
            'prefix' => 'storage/'
        ]);

        // add asterisk for fields that are required in ProgramRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here

        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
