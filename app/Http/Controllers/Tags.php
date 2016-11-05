<?php

namespace App\Http\Controllers;

use App\Models\Keywords;
use App\Transformers\KeywordsTransformer;
use App\Transformers\ShortKeywordsTransformer;
use League\Fractal\Resource\Collection;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;

/**
 * Class Keywords
 * @package App\Http\Controllers
 */
class Tags extends Controller
{
    /**
     * Return tags.
     *
     * @return mixed
     */
    public function getTags(Request $request)
    {

        if (!$tags = Keywords::all()) {
            return success(false, 'tags not found');
        }

        if (null !== $request->input('include')) {
            $this->fractal->parseIncludes($request->input('include'));
        }

        if (null !== $request->input('short')) {
            return $this->render(new Collection($tags, new ShortKeywordsTransformer()));
        }

        return $this->render(new Collection($tags, new KeywordsTransformer()));
    }

    /**
     * Return posts by tag.
     *
     * @param $name
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostsByTag($name, Request $request)
    {
        $tag = Keywords::where('keyword', $name)->first();

        if (!$tag) {
            return success(false, 'tags not found');
        }

        $this->fractal->parseIncludes('posts');

        return $this->render(new Item($tag, new KeywordsTransformer()));
    }

    /**
     * Delete tag
     *
     * @param $name
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTag($name)
    {
        $tag = Keywords::where('keyword', $name)->first();

        if (!$tag) {
            return success(false, 'tags not found');
        }

        if ($tag->posts->toArray()) {
            return success(false, 'this tag can not be removed');
        }

        return success($tag->delete());
    }
}