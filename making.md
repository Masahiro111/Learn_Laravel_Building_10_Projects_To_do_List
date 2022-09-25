# Laravel 9 To do List - Learn Laravel Building 10 Projects


## Laravel のインストール

Laravel のインストーラからインスト―ル。以下のコマンドを入力

```
laravel new project_name --git
```

インストール後にプロジェクトルートへ移動

```
cd project_name
```

env ファイルを編集してデータベース環境を整える。
そのあと、以下のコマンドで初期値のマイグレート処理をする

```
php artisan migrate
```

## Laravel Breeze のインストール

Laravel Breeze のインストールのコマンドを以下のように入力

```command
composer require laravel/breeze --dev

php artisan breeze:install

php artisan migrate:fresh

npm install

npm run dev
```

`php artisan breeze:install` を入力すると、npm が実行されて css や js ファイルが生成される。
なので `npm install` と `npm run dev` は入力しなくてもよい。

## Todo リストのコントローラーを作成

リソースフルな `To do リスト` コントローラーを作成。以下のコマンドを入力

```
php artisan make:controller TodosController -r
```

続けて、モデルとマイグレーションファイルを作成する。以下のコマンドを入力

```
php artisan make:model Todo -m
```

作成された `database\migrations\2022_09_25_090744_create_todos_table.php` を以下のように編集

```diff
    // ...

    return new class extends Migration
    {
        public function up()
        {
            Schema::create('todos', function (Blueprint $table) {
                $table->id();
+               $table->string('titile');
+               $table->mediumText('content');
+               $table->string('due');
                $table->timestamps();
            });
        }
    };
```

ルートを編集する。`routes\web.php` を以下のように編集

```diff
    // ...

-   Route::get('/', function () {
-       return view('welcome');
-   });

+   Route::get('/', [TodosController::class, 'index']);
+
+   Route::resource('todos', TodosController::class);
+
+   Route::get('/dashboard', function () {
+       return view('dashboard');
+   })->middleware(['auth'])->name('dashboard');
+
+   require __DIR__ . '/auth.php';
```

シーダーファイルの作成。以下コマンドを入力

```
php artisan make:seeder TodoSeed
```

作成された `database\seeders\TodoSeed.php` を以下のように編集

```diff
    // ...

    class TodoSeed extends Seeder
    {
        public function run()
        {
            Todo::query()
                ->create([
                    'titile' => 'Title One',
                    'content' => 'Content One',
                    'due' => 'Mondays',
                ]);

            Todo::query()
                ->create([
                    'titile' => 'Title Two',
                    'content' => 'Content Two',
                    'due' => 'Tuesdays',
                ]);
        }
    }
```

シーダーファイルを実行するため `database\seeders\DatabaseSeeder.php` を編集

```diff
    // ...

    class DatabaseSeeder extends Seeder
    {
        public function run()
        {
+           $this->call(TodoSeed::class);
        }
    }
```

以下のコマンドを入力して、マイグレートの実行

```
php artisan migrate:refresh --seed
```
