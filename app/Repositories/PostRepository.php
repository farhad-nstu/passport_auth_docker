<?php

namespace App\Repositories;

use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PostRepository
{
    protected Model $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getPostsList(){
        try {
            return $this->model->all();
        } catch (\Throwable $th) {
            throw new Exception("Database connectivity problem or query problem", 500);
        }
    }

    /**
     * @param array $data
     *
     * @return Model
     */
    public function store(array $data) : Model
    {
        try {
            $postData = [
                'title' => $data['title'] ?? null,
                'slug' => $data['slug'] ?? null,
                'content' => $data['content'] ?? null,
            ];

            return $this->model->create($postData);

        } catch (\PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage(), 500);
        } catch (\Exception $e) {
            throw new Exception("An unexpected error occurred: " . $e->getMessage(), 500);
        }
    }
}
