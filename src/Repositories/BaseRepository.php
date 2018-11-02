<?php

namespace Vibrary\Repositories;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    public $model;

    /**
     * BaseRepository constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        return $this->model = $model;
    }

    /**
     * @param $id
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $request
     */
    public function create($request)
    {
        return $this->model->create($request);
    }

    /**
     * @param $request
     * @param $id
     */
    public function update(Array $request, $id)
    {
        $item = $this->model->findOrFail($id);
        return $item->fill($request)->save();
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        return $this->model->delete($id);
    }
}