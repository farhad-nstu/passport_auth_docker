<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostServices;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    use ResponseTrait;
    protected $postService;

    public function __construct(PostServices $postService)
    {
        $this->postService = $postService;
    }

    public function getPosts(){
        try{
            [$code, $message, $data] = $this->postService->getPostsList();
            if($code === Response::HTTP_OK){
                return $this->success($data, $message, $code);
            }
            return $this->error($message, null, $code, $data);
        } catch(\Exception $e){
            return $this->error('Something went wrong!', $e->getTrace(), 500);
        }
    }

    public function storePost(PostRequest $request)
    {
        // dd("ol");
        try{
            [$code, $message, $data]  = $this->postService->storePost($request->all());
            if($code === Response::HTTP_OK){
                return $this->success($data, $message, $code);
            }
            return $this->error($message, null, $code, $data);

        }catch(\Exception $e){
            return $e->getMessage();
            return $this->error('Something went wrong!', $e->getTrace(), 500);
        }

    }
}
