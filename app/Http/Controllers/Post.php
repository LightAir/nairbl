<?php

namespace App\Http\Controllers;

use App\Models\Keywords;
use App\Models\KeywordsPosts;
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
     * Get tags and transform them
     *
     * @param Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    private function getTags(Request $request)
    {
        return collect(array_map(function ($data) {
            return slugGenerate(trim(strtolower($data)));
        },
            explode(',', $request->input('tags'))
        ));
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

        // future need refactoring this

        try {
            $this->validate($request, [
                'title' => 'required|max:535',
                'text' => 'required'
            ]);
        } catch (HttpResponseException $e) {
            return success(false, 'Invalid post create');
        }

        $tagCollect = $this->getTags($request);

        // find differences between exist keyword and new
        $tagsDiff = $tagCollect->diff(Keywords::whereIn('route', $tagCollect)->get()->map(function ($item, $key) {
            return $item->route;
        }));

        // build keywords array
        $keywords = $tagsDiff->map(function ($item, $key) {
            return [
                'keyword' => ucfirst($item),
                'route' => $item,
                'is_favourite' => 0,
            ];
        });

        \DB::beginTransaction();

        // insert new keywords
        Keywords::insert($keywords->toArray());

        $slug = $request->input('slug')??slugGenerate($request->input('title'));

        // insert post
        $post = Posts::create([
            'title' => $request->input('title'),
            'slug' => $slug,
            'text' => $request->input('text'),
            'is_published' => checkState($request->input('isPublished'), getenv('IS_PUBLISHED')),
            'is_commentable' => checkState($request->input('isCommentable'), getenv('IS_COMMENTABLE')),
            'is_visible' => checkState($request->input('isVisible'), getenv('IS_VISIBLE')),
            'is_favourite' => checkState($request->input('isFavourite'), 0)
        ]);

        $postId = $post->id;


        // search all inserting keywords
        $kw = Keywords::whereIn('route', $tagCollect)->get();

        // build array
        $tagsId = $kw->map(function ($item, $key) use ($postId) {
            return [
                'posts_id' => $postId,
                'keywords_id' => $item->id
            ];
        });

        // insert relation keyword-post
        KeywordsPosts::insert($tagsId->toArray());

        \DB::commit();

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

        // future need refactoring this

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

        //todo add update tags

        //        $oldTags = (Posts::where('slug', $slug)->first())->keywords;
        //        dd($oldTags);
        //
        //        $tagsCollection = $this->getTags($request);

        // find new tags (keywords)
        // find differences between exist keyword and new
        //        $tagsDiff = $tagsCollection->diff(Keywords::whereIn('route', $tagsCollection)->get()->map(function ($item, $key) {
        //            return $item->route;
        //        }));
        //
        //        $this->getKeywords($slug);
        //
        //        dd($tagsDiff);

        // build keywords array
        //        $keywords = $tagsDiff->map(function ($item, $key) {
        //            return [
        //                'keyword' => ucfirst($item),
        //                'route' => $item,
        //                'is_favourite' => 0,
        //            ];
        //        });

        // insert new tags to keyword table

        // find difference between old and new tags

        // delete old relations keywords <-> posts

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
