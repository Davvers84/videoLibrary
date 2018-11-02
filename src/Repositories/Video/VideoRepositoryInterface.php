<?php


namespace Vibrary\Repositories\Video;

interface VideoRepositoryInterface
{
    public function all();

    public function getVideoById($id);

    public function getVideosByUser($id);
}
