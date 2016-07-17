<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeDataBase extends Migration
{
  /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       Schema::create('keywords', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('parent_keyword_id')->default(0);
           $table->string('keyword', 255);
           $table->string('route', 255);
           $table->boolean('is_favourite')->default(0);
       });

       Schema::create('posts', function (Blueprint $table) {
           $table->increments('id');
           $table->string('title', 535)->default('');
           $table->string('slug', 535)->default('');
           $table->longText('text')->default('');
           $table->boolean('is_published')->default(0);
           $table->boolean('is_commentable')->default(0);
           $table->boolean('is_visible')->default(1);
           $table->boolean('is_favourite')->default(0);
           $table->nullableTimestamps();
       });

       // index for post
       Schema::table('posts', function(Blueprint $table)
       {
           $table->index('slug');
           $table->index('created_at');
           $table->index('is_visible');
           $table->index(array('is_visible', 'created_at'));
       });

       Schema::create('posts_keywords', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('post_id');
           $table->integer('keyword_id');
       });

       Schema::create('settings', function (Blueprint $table) {
           $table->increments('id');
           $table->string('group', 255);
           $table->string('setting_key', 255);
           $table->longText('setting');
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {

       Schema::dropIfExists('keywords');
       Schema::dropIfExists('posts');
       Schema::dropIfExists('posts_keywords');
       Schema::dropIfExists('settings');
   }
}
