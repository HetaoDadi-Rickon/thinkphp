<?php

namespace app\index\controller;
use app\index\model\User as UserModel;

use think\Controller;

class User extends Controller
{
    public function index()
    {
        return '测试';
    }
    // 新增数据
    public function add()
    {
        // $user = new UserModel();
        // $user->name = 'xxn';
        // $user->email = '123@163.com';
        // $user->birthday = '19960511';
        // if ($user->save()) {
        //     return '用户新增成功';
        // } else {
        //     return '用户新增失败';
        // }
        $user['name'] = 'test';
        $user['email'] = 'test.com';
        $user['birthday'] = '19960511';
        if ($result = UserModel::create($user)) {
            return '数据插入成功';
        } else {
            return '数据插入失败';
        }
    }
    //批量新增数据
    public function addList()
    {
        $user = new UserModel();
        $list = [
          ['name' => '张三','email' => '646@163.com', 'birthday' => '19960544'],
          ['name' => '李四','email' => '646@163.com', 'birthday' => '19960544'],
        ];
        if ($user->saveAll($list)) {
            return '用户批量新增成功';
        } else {
            return '用户批量新增失败';
        }
    }
    //更新数据
    public function update()
    {
        // $user = UserModel::get(1);
        // // var_dump($user);
        // $user->name = '安迪';
        // $user->email = 'xxn996';
        // if ($user->save()) {
        //     return '更新数据成功';
        // } else {
        //     return '更新数据失败';
        // }
        // $user->save(['name'=>'cesjo','email'=>'456']);

        // $user = new UserModel();
        // $list = [
        //   ['id'=>2,'name'=>'蒋欣'],
        //   ['id'=>1,'name'=>'钟汉良'],
        //
        // ];
        // $user->saveAll($list);
        //数据库函数方法
        // $user = new UserModel();
        // $user -> update(['id'=>1,'name'=>'xiaoxiaonan']);
        //静态方法
    }
    //查询数据
    public function select()
    {
      // $user = UserModel::get(['name'=>'xiaoxiaonan']);
      // return $user->name;

        // $user = new UserModel();
        // $result = $user->where('name','xiaoxiaonan')->find();
        // echo $result->birthday;

        //获取多个数据
        // $list = UserModel::all();
        // var_dump($list);
        // foreach ($list as $v) {
        //     echo $v->name;
        // }

        //实例化模型后调用查询方法
        // $user = new UserModel();
        // $result = $user->where('id','1')->limit(1)->select();
        // foreach ($result as $key => $value) {
        //     echo $value['name'];
        // }
        //聚合函数调用
        $user = new UserModel();
        echo $user->where('id','1')->count();
    }
}
