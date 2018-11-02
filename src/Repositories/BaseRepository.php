<?php

namespace Vibrary\Repositories;

abstract class BaseRepository
{
    public $model;

    public function __construct($model)
    {
        return $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create($request)
    {
        return $this->model->create($request);
    }

    public function update(Array $request, $id)
    {
        $item = $this->model->findOrFail($id);
        return $item->fill($request)->save();
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }
}
