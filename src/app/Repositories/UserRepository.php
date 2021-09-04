<?php
//namespace 忘れでnot found
namespace App\Repositories;

use Illuminate\Foundation\Application;

class UserRepository
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct()
   {

   }

   public function count()
   {
       return 100;
   }

}

app()->bind(UserRepository::class,function(Application $app){
    return new UserRepository();
});
