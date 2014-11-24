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
        $modelName = \Request::segment(1);
        $modelClassName = ucfirst($this->inflector->singularize($modelName));
        $parameters = \Route::getCurrentRoute()->parameters();
        $model = call_user_func("{$modelClassName}::find", $parameters[$modelName]);
        $model->update(\Input::all());
        return $model;
    }

    public function destroy()
    {
        $modelName = \Request::segment(1);
        $modelClassName = ucfirst($this->inflector->singularize($modelName));
        $parameters = \Route::getCurrentRoute()->parameters();
        return call_user_func("{$modelClassName}::destroy", $parameters[$modelName]);
    }

    /**
     * @return string
     */
    public function modelClassName()
    {
        return ucfirst($this->inflector->singularize(\Request::segment(1)));
    }
}