<?php


namespace Vibrary\Repositories\Video;

/**
 * Interface VideoRepositoryInterface
 * @package Vibrary\Repositories\Video
 */
interface VideoRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function getVideoById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function getVideosByUser($id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
