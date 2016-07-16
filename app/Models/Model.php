<?php

namespace App\Models;


/**
 *
 */
class Model
{

  /**
   * return table name
   *
   * @return string
   */
  private static function getTableName()
  {
    $name = (new \ReflectionClass(get_called_class()))->getShortName();
    $word = preg_split('/(?<=[a-z])(?=[A-Z])/', $name);
    return strtolower(implode('_', $word));
  }

  /**
   * Return data from database by args
   *
   * @param  array  $args  key-value array
   * @param  int $offset
   * @param  int $limit
   *
   * @return mixed
   */
  public static function find($args = [], $offset = 0, $limit = 0)
  {
  
    $table = \DB::table(self::getTableName());

    foreach ($args as $key => $value) {
      $table->where($key, '=', $value);
    }

    if($offset) $table->offset($offset);
    if($limit) $table->limit($limit);

    return $table->get();
  }
}
