<?php

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the index page.
     *
     * @param null $id
     * @return string
     */
    public function index(/** @noinspection PhpUnusedParameterInspection */ $id = null)
    {
        $db = database();
        /** @noinspection SqlDialectInspection */
        $db->query("select t1.* 
      from table1 as t1 
      left join (select * from table
      ) as t1 on t1.id=t2.id
      where t1.id > 5
      order by t1.id
      ");

//    $d = 4;
//    $a = $d / 0;
        return 'Hallo Welt!!!';
    }
}