<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ExerciseRequest as StoreRequest;
use App\Http\Requests\ExerciseRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ExerciseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ExerciseCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Exercise');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/exercise');
        $this->crud->setEntityNameStrings('exercise', 'exercises');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // Columns
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'image', 'type' => 'image', 'label' => 'Image',
            'prefix' => 'storage/'
        ]);

        // Fields
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addField(['name' => 'type', 'type' => 'enum', 'label' => 'Type']);
        $this->crud->addField([
            'name' => 'image',
            'type' => 'image',
            'label' => 'Image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio;
            'prefix' => 'storage/'
        ]);

        $this->crud->addField(
            [
                'label' => 'Exercise type',
                'name' => 'type',
                'type' => 'toggle',
                'inline' => true,
                'options' => [
                    'time' => 'Time',
                    'reps' => 'Reps',
                    'pause' => 'Pause'
                ],
                'hide_when' => [
                    'time' => ['default_reps'],
                    'reps' => ['default_time'],
                    'pause' => ['default_reps']
                ],
                'default' => 0
            ]
        );


        $this->crud->addField([ 'label' => "Default Time (secs)", 'type' => 'number', 'name' => 'default_time']);
        $this->crud->addField([ 'label' => "Default Reps", 'type' => 'number', 'name' => 'default_reps']);

        // add asterisk for fields that are required in ExerciseRequest
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
