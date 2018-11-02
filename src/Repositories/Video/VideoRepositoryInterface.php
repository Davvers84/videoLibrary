<?php


namespace Vibrary\Repositories\Video;

use Vibrary\Models\Video;

interface VideoRepositoryInterface
{
    public function all();
//
//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function findById($id);
//
//    /**
//     * @param $request
//     * @return mixed
//     */
//    public function create($request);
//
//
//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function delete($id);
//

    public function getVideoById($id);

    public function getVideosByUser($id);

}