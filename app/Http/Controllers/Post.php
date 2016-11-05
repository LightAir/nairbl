<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Transformers\PostTransformer;

use Illuminate\Http\{
    Request, Response
};

use Illuminate\Http\Exception\HttpResponseException;
use League\Fractal\{
    Pagination\IlluminatePaginatorAdapter, Resource\Collection, Resource\Item
};

/**
 * Class Post
 * @package App\Http\Controllers
 */
class Post extends Controller
{

    /**
     * Return posts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function post()
    {
        $paginator = Posts::paginate(getenv('PPP'));
        $posts = $paginator->getCollection();

        $resource = new Collection($posts, new PostTransformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $this->render($resource);
    }

    /**
     * Return one news by slug.
     *
     * @param string $slug
     *
     * @return mixed
     */
    public function getPostBySlug($slug)
    {
        $post = Posts::where('slug', $slug)->first();

        if (!$post) {
            return success(false, 'post not found');
        }

        $resource = new Item($post, new PostTransformer);

        return $this->render($resource);
    }

    /**
     * Create post
     *
     * @param Request $request
     *
     * @return array|mixed|string
     */
    public function addPost(Request $request)
    {

        try {
            $this->validate($request, [
                'title' => 'required|max:535',
                'text' => 'required'
            ]);
        } catch (HttpResponseException $e) {
            return success(false, 'Invalid post create');
        }

        //todo add tags

        $slug = $request->input('slug')??slugGenerate($request->input('title'));

        Posts::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'text' => $request->input('text'),
            'is_published' => checkState($request->input('isPublished'), getenv('IS_PUBLISHED')),
            'is_commentable' => checkState($request->input('isCommentable'), getenv('IS_COMMENTABLE')),
            'is_visible' => checkState($request->input('isVisible'), getenv('IS_VISIBLE')),
            'is_favourite' => checkState($request->input('isFavourite'), 0)
        ]);

        return response()->json([
            'success' => [
                'message' => 'ok',
                'slug' => $slug,
            ]
        ],
            Response::HTTP_OK,
            $headers = []
        );
    }

    /**
     * @param $slug
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePost($slug, Request $request)
    {

        // fieldName => check?
        $fields = [
            'title' => null,
            'text' => null,
            'isPublished' => true,
            'isCommentable' => true,
            'isVisible' => true,
            'isFavourite' => true
        ];

        $data = $this->fieldsCheck($fields, $request->toArray());

        // todo add tags

        if ($request->input('newSlug')) {
            try {
                $this->validate($request, [
                    'newSlug' => 'required|alpha_dash|max:255'
                ]);
            } catch (HttpResponseException $e) {
                return success(false, 'Invalid post create');
            }

            $data['slug'] = $request->input('newSlug');
        }

        Posts::where('slug', $slug)->update($data);

        return success();
    }

    /**
     * Delete post
     *
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePost($slug)
    {
        $state = Posts::where('slug', $slug)->delete();

        return success($state);
    }
}
