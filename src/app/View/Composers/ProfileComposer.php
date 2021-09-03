<?php

namespace App\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * userリポジトリの実装
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * 新しいプロフィールコンポーザの生成
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // UserRepository $users
        // // 依存関係はサービスコンテナによって自動的に解決される
        // $this->users = $users;
    }

    /**
     * データをビューと結合
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', 'count');
        // $view->with('count', $this->users->count());
    }
}
