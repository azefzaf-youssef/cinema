<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('BDD', function () {

    Schema::disableForeignKeyConstraints();
    Schema::dropIfExists('illustration');
    Schema::dropIfExists('langue');
    Schema::dropIfExists('traduction');
    Schema::dropIfExists('categories');
    Schema::dropIfExists('users');
    Schema::enableForeignKeyConstraints();

    Schema::create('illustration', function (Blueprint $table) {

        $table->increments('id');
        $table->unsignedInteger('id_langue');
        $table->unsignedInteger('id_domaine');
        $table->unsignedInteger('id_user');
        $table->string('titre')->unique();
        $table->string('path_illustration');
        $table->timestamps();
        $table->softDeletes();

    });

    Schema::create('langue', function (Blueprint $table) {

        $table->increments('id');
        $table->longText('langue');
        $table->timestamps();
        $table->softDeletes();

    });

    DB::table('langue')->insert([
        'langue' => 'Anglais',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Mandarin',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Hindi',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Espagnol',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Arabe',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Bengali',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Français',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Russe',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Portugais',
    ]);

    DB::table('langue')->insert([
        'langue' => 'Ourdou',
    ]);

    Schema::create('traduction', function (Blueprint $table) {

        $table->increments('id');
        $table->unsignedInteger('id_langue');
        $table->unsignedInteger('id_user');
        $table->unsignedInteger('id_illustration');
        $table->longText('composants_json');
        $table->tinyInteger('default')->default(0);
        $table->timestamps();
        $table->softDeletes();

    });

    Schema::create('domaines', function (Blueprint $table) {

        $table->increments('id');
        $table->longText('domaine');
        $table->timestamps();
        $table->softDeletes();

    });

    DB::table('domaines')->insert([
        'domaine' => 'Arts',
    ]);

    DB::table('domaines')->insert([
        'domaine' => 'Sciences',
    ]);

    DB::table('domaines')->insert([
        'domaine' => 'Économie',
    ]);

    DB::table('domaines')->insert([
        'domaine' => 'Sciences humaines',
    ]);

    DB::table('domaines')->insert([
        'domaine' => 'Biologie',
    ]);

    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->tinyInteger('is_admin')->default(0);
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });

    $admin = new User();
    $admin->id = 1;
    $admin->name = "administrateur";
    $admin->email = "administrateur@univ-rouen.com";
    $admin->password = Hash::make("123456");
    $admin->is_admin = true;
    $admin->save();

    $user_khaled = new User();
    $user_khaled->id = 2;
    $user_khaled->name = "khaled";
    $user_khaled->email = "khaled@univ-rouen.com";
    $user_khaled->password = Hash::make("123456");
    $user_khaled->is_admin = false;
    $user_khaled->save();

    $user_youssef = new User();
    $user_youssef->id = 3;
    $user_youssef->name = "youssef";
    $user_youssef->email = "youssef@univ-rouen.com";
    $user_youssef->password = Hash::make("123456");
    $user_youssef->is_admin = false;
    $user_youssef->save();


    DB::table('illustration')->insert([

        "id"=>1,
        "id_langue" => 1,
        "id_domaine" => 5,
        "id_user" => 2,
        "titre" => "Humain heart",
        "path_illustration" => "storage/illustrattion/23-12-25/4235xnHOV4ScorVSI4OJOjMj8YAGcyvU7R7pHqhY.jpg",
    ]);

    DB::table('illustration')->insert([

        "id"=>2,
        "id_langue" => 7,
        "id_domaine" => 2,
        "id_user" => 3,
        "titre" => "Disque dur",
        "path_illustration" => "storage/illustrattion/23-12-25/byXydfLpDV7HseFRKg6scpolpdG30Drsi8GTSn9L.png",
    ]);


    DB::table('traduction')->insert([

        "id_langue" => 1,
        "id_user" => 2,
        "id_illustration" => 1,
        "composants_json" => '[{"eventClientX":670,"eventClientY":369,"XX":270,"YY":206.73333740234375,"rect":{"x":400,"y":162.26666259765625,"width":640,"height":640,"top":162.26666259765625,"right":1040,"bottom":802.2666625976562,"left":400},"id":1,"description":"Aorta"},{"eventClientX":548,"eventClientY":456,"XX":148,"YY":293.73333740234375,"rect":{"x":400,"y":162.26666259765625,"width":640,"height":640,"top":162.26666259765625,"right":1040,"bottom":802.2666625976562,"left":400},"id":2,"description":"right atrium"},{"eventClientX":818,"eventClientY":292,"XX":418,"YY":314.73333740234375,"rect":{"x":400,"y":-22.73333740234375,"width":640,"height":640,"top":-22.73333740234375,"right":1040,"bottom":617.2666625976562,"left":400},"id":4,"description":"right atrium,"},{"eventClientX":793,"eventClientY":494,"XX":393,"YY":516.7333374023438,"rect":{"x":400,"y":-22.73333740234375,"width":640,"height":640,"top":-22.73333740234375,"right":1040,"bottom":617.2666625976562,"left":400},"id":5,"description":"right ventricle"},{"eventClientX":651,"eventClientY":502,"XX":251,"YY":524.7333374023438,"rect":{"x":400,"y":-22.73333740234375,"width":640,"height":640,"top":-22.73333740234375,"right":1040,"bottom":617.2666625976562,"left":400},"id":6,"description":"left ventricle"},{"eventClientX":586,"eventClientY":393,"XX":186,"YY":415.73333740234375,"rect":{"x":400,"y":-22.73333740234375,"width":640,"height":640,"top":-22.73333740234375,"right":1040,"bottom":617.2666625976562,"left":400},"id":7,"description":"tricuspid"}]',
        "default" => 1,

    ]);

    DB::table('traduction')->insert([

        "id_langue" => 7,
        "id_user" => 3,
        "id_illustration" => 2,
        "composants_json" => '[{"eventClientX":794,"eventClientY":270,"XX":394,"YY":298.23333740234375,"rect":{"x":400,"y":-28.23333740234375,"width":640,"height":687.7666625976562,"top":-28.23333740234375,"right":1040,"bottom":659.5333251953125,"left":400},"id":1,"description":"Tête "},{"eventClientX":686,"eventClientY":217,"XX":286,"YY":245.23333740234375,"rect":{"x":400,"y":-28.23333740234375,"width":640,"height":687.7666625976562,"top":-28.23333740234375,"right":1040,"bottom":659.5333251953125,"left":400},"id":2,"description":"Axe "},{"eventClientX":545,"eventClientY":300,"XX":145,"YY":328.23333740234375,"rect":{"x":400,"y":-28.23333740234375,"width":640,"height":687.7666625976562,"top":-28.23333740234375,"right":1040,"bottom":659.5333251953125,"left":400},"id":3,"description":"Plateau\n "},{"eventClientX":765,"eventClientY":416,"XX":365,"YY":444.23333740234375,"rect":{"x":400,"y":-28.23333740234375,"width":640,"height":687.7666625976562,"top":-28.23333740234375,"right":1040,"bottom":659.5333251953125,"left":400},"id":4,"description":"Bras"}]',
        "default" => 1,

    ]);
});



Artisan::command('BDD_CINEMA', function () {

    Schema::disableForeignKeyConstraints();
    Schema::dropIfExists('movies');
    Schema::dropIfExists('categories');
    Schema::dropIfExists('user_tickets');
    Schema::dropIfExists('users');
    Schema::enableForeignKeyConstraints();

    Schema::create('movies', function (Blueprint $table) {

        $table->increments('id');
        $table->string('titre')->unique();
        $table->string('path_trailer');
        $table->longText('movie_description');
        $table->dateTime('time_to_start');
        $table->date('date_movie');
        $table->unsignedInteger('id_category');
        $table->timestamps();
        $table->softDeletes();

    });

    Schema::create('user_tickets', function (Blueprint $table) {

        $table->increments('id');
        $table->unsignedInteger('id_movie');
        $table->unsignedInteger('id_user');
        $table->unsignedInteger('nb_tickets');
        $table->timestamps();
        $table->softDeletes();

    });



    Schema::create('categories', function (Blueprint $table) {

        $table->increments('id');
        $table->longText('category');
        $table->timestamps();
        $table->softDeletes();

    });

    DB::table('categories')->insert([
        'category' => 'Comedy',
    ]);

    DB::table('categories')->insert([
        'category' => 'Drama',
    ]);

    DB::table('categories')->insert([
        'category' => 'Romance',
    ]);

    DB::table('categories')->insert([
        'category' => 'Science fiction',
    ]);

    DB::table('categories')->insert([
        'category' => 'Documentary',
    ]);


    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->tinyInteger('is_admin')->default(0);
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });

    $admin = new User();
    $admin->id = 1;
    $admin->name = "administrateur";
    $admin->email = "administrateur@univ-rouen.com";
    $admin->password = Hash::make("123456");
    $admin->is_admin = true;
    $admin->save();

    $user_khaled = new User();
    $user_khaled->id = 2;
    $user_khaled->name = "Anouar";
    $user_khaled->email = "Anouar@univ-hassan-2.com";
    $user_khaled->password = Hash::make("123456");
    $user_khaled->is_admin = false;
    $user_khaled->save();

    $user_youssef = new User();
    $user_youssef->id = 3;
    $user_youssef->name = "youssef";
    $user_youssef->email = "youssef@univ-rouen.com";
    $user_youssef->password = Hash::make("123456");
    $user_youssef->is_admin = false;
    $user_youssef->save();


});
