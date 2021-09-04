<?php
namespace App\Repositories;


class UserRepository
{
    protected $name;
   public function __construct(String $str)
   {
       $this->name = $str;
   }

   public function name()
   {
    return $this->name;
    }
}
