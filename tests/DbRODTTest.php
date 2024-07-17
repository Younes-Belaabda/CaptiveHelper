<?php

    declare(strict_types=1);

    use PHPUnit\Framework\TestCase;

    final class DbRODTTest extends TestCase
    {
       public function testInsert(){
        $value = \App\Database\DB::insert('RecapOfTheDay' , ['agent' , 'type' , 'center' , 'count'] , "
        'VICTOR' , 'OHM' , 'CAPTIVE' , 2
        ");

        $this->assertTrue($value == 1);
       }

       public function testFetch(){
        $values = \App\Database\DB::all('RecapOfTheDay');

        $this->assertNotEquals($values , []);
       }

       public function testExist(){
        $values = \App\Database\DB::exist('RecapOfTheDay' , ['agent' , 'type' , 'center'] , [
         "'VICTOR'" , "'OHM'" , "'CAPTIVE'"
        ]);

        $this->assertEquals($values , [
         ['id' => 1]
        ]);
       }

       public function testUpdate(){
        $value = \App\Database\DB::update('RecapOfTheDay' , 4 , ['count'] , [21]);

        $this->assertSame($value , 1);
       }
    }