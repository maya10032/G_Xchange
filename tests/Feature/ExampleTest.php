<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

   /**
    * A basic test example.
    */
    // サンプルの関数
    public function sample01(){
        return 'これはSample01です';
    }

    // サンプルの関数
    public function sample02( $x, $y ){
        $sum = $x + $y;
        return $sum;
    }
}
