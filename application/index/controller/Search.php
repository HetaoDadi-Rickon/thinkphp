<?php
/**
 * Created by PhpStorm.
 * User: 13248
 * Date: 2018/9/5
 * Time: 22:53
 */
namespace app\index\controller;
use think\Db;
use think\Controller;

class Search
{
    public  function index()
    {
        echo 'test';
    }
    //热搜词
    public function getHotSearch(){
        $limit = input('request.limit',10,'intval');
        $account_body_id = input('request.account_body_id',0,'intval');
        $account_body_id = '1';
        if (!$account_body_id) {
            $result = array('status' => 0, 'msg' => '参数不全', 'data' => array());
            $this->outputData($result);
        }
        //获取人模信息
        $sex = Db::table('Account_body')->where("`account_body_id`={$account_body_id}")->value('sex');
        $sexs = array('0');
        if ($sex) {
            $sexs[] = $sex;
        }
        //todo 时间戳
        $now = time();
        $map = array(
            'is_show' => 1,
            'type' => 1,
            'start_time' => array('lt', $now),
            'end_time' => array('gt', $now),
            'sex' => array('in', $sexs),
        );
        $result = Db::table('item_recommend_word')->field('keyword')->where($map)->order('orderno ASC')->select();
        //查找合适
        $limit = min($limit, count($result));
        $list = array();
        if ($result) {
            $tmp = array_rand($result, $limit);
            if (!is_array($tmp)) {
                $list[] = $result[0]['keyword'];
            } else {
                foreach ($tmp as $v) {
                    $list[] = $result[$v]['keyword'];
                }
            }
        }
        $data = array(
            'list' => $list,
        );
        $result = array('status'=>1,'msg'=>'数据获取成功','data'=>$data);
        var_dump($result);
    }
    //历史搜索词
    public function getHistorySearch(){
//        $mem_id = $this->mid;
        $mem_id = 1;
        $account_body_id = input('request.account_body_id',0,'intval');
        $account_body_id = 1;
        $limit = input('request.limit',10,'intval');
        if (!$account_body_id) {
            $result = array('status' => 0, 'msg' => '参数不全', 'data' => array());
            $this->outputData($result);
        }
        $map = array(
            'account_body_id' => $account_body_id,
            'account_id' => $mem_id,
        );
        $list = Db::table('account_search_log')->field('keyword')->where($map)->order('pubdate DESC')->limit($limit)->select();
        $data = array(
            'list' => $list,
        );
        $result = array('status'=>1,'msg'=>'数据获取成功','data'=>$data);
       var_dump($result);
    }
    //猜你喜欢
    public function getGuessSearch(){
//        $mem_id = $this->mid;
        $mem_id = '1';
        $account_body_id = input('request.account_body_id',0,'intval');
        $account_body_id = '1';
        $limit = input('request.limit',10,'intval');
        if (!$account_body_id) {
            $result = array('status' => 0, 'msg' => '参数不全', 'data' => array());
            $this->outputData($result);
        }
        $arr = array(
            1 => array('连衣裙','牛仔裤','短裙','修身裤','Mini短裤','条纹中袖T恤','微喇牛仔裤','女跑步','无袖连衣裙','雪纺','打底衫','连衣裙','女装新款','黑色印花T恤','外套','牛仔短裤','针织衬衫','羊毛围巾'),
            2 => array('POLO衫','直筒裤','运动休闲','T恤衫','男跑步','针织衫','休闲','夏装','牛仔裤','男功能T','牛仔裤','衬衫','休闲裤','薄西装','男士皮鞋','男士短袖衬衫','男士领带',),
        );
        $sex = Db::table('Account_body')->where("`account_body_id`={$account_body_id}")->value('sex');
        $list = array();
        if ($sex == 1) {#男
            $tmp = array_rand($arr[2], $limit);
            if (!is_array($tmp)) {
                $list[] = $arr[2][0];
            } else {
                foreach ($tmp as $v) {
                    $list[] = $arr[2][$v];
                }
            }
        } else {
            $tmp = array_rand($arr[1], $limit);
            if (!is_array($tmp)) {
                $list[] = $arr[1][0];
            } else {
                foreach ($tmp as $v) {
                    $list[] = $arr[1][$v];
                }
            }
        }
        $data = array(
            'list' => $list,
        );
        $result = array('status'=>1,'msg'=>'数据获取成功','data'=>$data);
        var_dump($result);
//        $this->outputData($result);
    }
}