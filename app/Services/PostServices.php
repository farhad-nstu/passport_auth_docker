<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Traits\ResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class PostServices
{
    use ResponseTrait;
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getPostsList(){
        try{
            $postList = $this->postRepository->getPostsList();
            if($postList) {
                return [
                    Response::HTTP_OK,
                    "Rider get successfully",
                    $postList
                ];
            } else {
                return [
                    Response::HTTP_OK,
                    "Data store failed",
                    []
                ];
            }
        } catch(\Exception $e){
            return [
                $e->getCode(),
                "Something went wrong",
                []
            ];
        }
    }

    /**
     * @param array $request
     *
     * @return array
     */
    public function storePost(array $request) : array
    {
        try{
            $postData = $this->postRepository->store($request);
            if($postData) {
                return [
                    Response::HTTP_OK,
                    "Rider location stored successfully",
                    $postData
                ];
            } else {
                return [
                    Response::HTTP_OK,
                    "Data store failed",
                    []
                ];
            }
        } catch(\Exception $e){
            return [
                $e->getCode(),
                // $e->getMessage(),
                "Something went wrong",
                []
            ];
        }

    }
}
