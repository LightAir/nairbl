<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Keywords;

/**
 * General controller.
 */
class Api extends Controller
{
    /**
     * Return some information.
     */
    public function about()
    {
        $settings = collect($this->getSettingsByGroup())->keyBy('setting_key')->all();

        // TODO cache data to Redis
        $result = [
            'title' => $settings['title']->setting,
            'siteName' => $settings['siteName']->setting,
            'siteHelp' => $settings['siteHelp']->setting,
            // TODO add blog author name
            'tags' => Keywords::find(['is_favourite' => 1]),
        ];

        return response()->json($result);
    }

    /**
     * Return news.
     *
     * @param int $offset
     *
     * @return mixed
     */
    public function news($offset)
    {
        $npp = env('NPP', 10);
        $result = [];

        $data = Posts::find([], $offset ?: 0, $npp);

        foreach ($data as $key => $value) {
            $text = substr($value->text, 0, env('NEWS_LENGTH', 1000));

            if ($value->is_published && $value->is_visible) {
                $result[$key]['title'] = $value->title;
                $result[$key]['slug'] = $value->slug;
                $result[$key]['text'] = $text;
                $result[$key]['commentable'] = (bool) $value->is_commentable;
                $result[$key]['favourite'] = (bool) $value->is_favourite;
                $result[$key]['date'] = date('Y M d H:i:s', strtotime($value->created_at));
            }
        }

        return response()->json($result);
    }

    /**
     * Return one news by slug.
     *
     * @param string $slug
     *
     * @return mixed
     */
    public function getNewsBySlug($slug)
    {
        if (!$data = Posts::findFirst(['slug' => $slug])) {
            abort(404);
        }

        // TODO add modifer
        return response()->json($data);
    }

    /**
     * Return tags.
     *
     * TODO move to model
     *
     * @return mixed
     */
    public function getTags()
    {
        $favorite = [];
        $regular = [];
        // TODO add alone tags
        //$alone = [];

        // TODO add to cache
        $tags = Keywords::find();

        foreach ($tags as $key => $value) {
            if ($value->is_favourite) {
                $favorite[] = $value;
            } else {
                $regular[] = $value;
            }
        }

        return response()->json([
          'favorite' => $favorite,
          'regular' => $regular,
          //'alone' => $alone,
        ]);
    }

    /**
     * Return posts by tag.
     *
     * @param string $tag
     *
     * @return mixed
     */
    public function getPostsByTag($tag)
    {
        return response()->json(Keywords::getPostByTag($tag));
    }
}
