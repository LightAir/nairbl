<?php

if (! function_exists('bcrypt')) {
    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->make($value, $options);
    }
}

if (! function_exists('slugGenerate')) {

    /**
     * rus -> lat converter
     *
     * @param $title
     * @return mixed
     */
    function slugGenerate($title)
    {
        $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');

        $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');

        $str = str_replace($rus, $lat, $title); // переводим на английский
        $str = str_replace('-', '', $str); // удаляем все исходные "-"
        $slag = preg_replace('/[^A-Za-z0-9-]+/', '_', $str); // заменяет все символы и пробелы на "_"
        return $slag;
    }
}

if (! function_exists('checkState')) {

    /**
     * Check state
     *
     * @param mixed $state
     * @param mixed $default
     *
     * @return mixed
     */
    function checkState($state = null, $default = false)
    {
        if(!$state){
            return $default;
        }

        if ($state === 'on'){
            return true;
        }

        return false;
    }
}

if (! function_exists('success')) {

    /**
     * Return response
     *
     * @param bool $state
     * @param string $error
     *
     * @return \Illuminate\Http\JsonResponse
     */
    function success($state = true, $error = 'error')
    {

        if ($state){
            return response()->json([
                'success' => [
                    'message' => 'ok',
                    'status_code' => \Illuminate\Http\Response::HTTP_OK
                ]],
                \Illuminate\Http\Response::HTTP_OK,
                $headers = []
            );
        }

        return response()->json([
            'error' => [
                'message' => $error,
                'status_code' => \Illuminate\Http\Response::HTTP_NOT_FOUND
            ]],
            \Illuminate\Http\Response::HTTP_NOT_FOUND,
            $headers = []
        );
    }
}

