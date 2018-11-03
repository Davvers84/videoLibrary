<?php

namespace Vibrary\Repositories;

/**
 * Class BaseRepository
 * @package Vibrary\Repositories
 */
abstract class BaseRepository
{
    /**
     * @var
     */
    public $model;

    /**
     * BaseRepository constructor.
     * @param $model
     */
    public function __construct($model)
    {
        return $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->model->create($request);
    }

    /**
     * @param array $request
     * @param $id
     * @return mixed
     */
    public function update(Array $request, $id)
    {
        $item = $this->model->findOrFail($id);
        return $item->fill($request)->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
