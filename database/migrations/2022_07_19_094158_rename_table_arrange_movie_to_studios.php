<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTableArrangeMovieToStudios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('studios', function (Blueprint $table) {
        //     $table->renameIndex('');
        // });

        DB::statement('ALTER TABLE `laravel-wetix`.`arrange_movie` DROP INDEX `arrange_movie_theater_id_foreign`, ADD INDEX `studios_theater_id_foreign` (`theater_id`) USING BTREE');
        DB::statement('ALTER TABLE `laravel-wetix`.`arrange_movie` DROP INDEX `arrange_movie_movie_id_foreign`, ADD INDEX `studios_movie_id_foreign` (`movie_id`) USING BTREE');

        Schema::rename('arrange_movie', 'studios');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `laravel-wetix`.`arrange_movie` DROP INDEX `studios_theater_id_foreign`, ADD INDEX `arrange_movie_theater_id_foreign` (`theater_id`) USING BTREE');
        DB::statement('ALTER TABLE `laravel-wetix`.`arrange_movie` DROP INDEX `studios_movie_id_foreign`, ADD INDEX `arrange_movie_movie_id_foreign` (`movie_id`) USING BTREE');

       Schema::rename('studio', 'arrange_movie');
    }
}
