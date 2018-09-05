<?php
namespace app\index\controller;
use think\Db;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        //赋值给模板变量
        $name = 'xiaoxiaonan';
        $email = 'xxn1996.com';
        $this->assign('name',$name);
        $this->assign('email',$email);
        // $this->assign([
        //     'name' => $name,
        //     'email' => $email
        // ]);
        return $this->fetch('test');//可以跨模块
    }

    public function test()
    {
        echo 'baocun';
        echo 'xin';
      die;
    }
    public function db()
    {
      //插入记录
      // $state = Db::table('data')->insert(['name'=>'xxx','status'=>'1']);
      // $result = Db::table('data')->where('name',0)->update(['name'=>'xxn']);
      $result = Db::table('data')->where('name','xxn')->field('name,status')->limit(3)->select();
      var_dump($result);
    }
}
