<?php

namespace Robbyronk\Mdf;

use Illuminate\Routing\Controller;
use ICanBoogie\Inflector;
use Symfony\Component\Console\Input\Input;

class MdfController extends Controller
{

    private $inflector;

    function __construct()
    {
        $this->inflector = Inflector::get();
    }

    public function index()
    {
        return \View::make('aoeu', ['toRender' => call_user_func($this->modelClassName() . "::all")]);
    }

    public function create()
    {
        // return view to create model
    }

    public function edit()
    {
        // return view to edit model
    }

    public function show()
    {
        return \View::make('aoeu', ['toRender' => call_user_func($this->modelClassName() . "::find", \Request::segment(2))]);
    }

    public function store()
    {
        return call_user_func_array($this->modelClassName() . "::create", array(\Input::all()));
    }

    public function update()
    {
        $model = call_user_func($this->modelClassName() . "::find", \Request::segment(2));
        $model->update(\Input::all());
        return $model;
    }

    public function destroy()
    {
        return call_user_func($this->modelClassName() . "::destroy", \Request::segment(2));
    }

    /**
     * @return string
     */
    public function modelClassName()
    {
        return ucfirst($this->inflector->singularize(\Request::segment(1)));
    }
}