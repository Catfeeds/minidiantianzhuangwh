<?php
namespace Api\Controller;
use Think\Controller;
class ApplyController extends PublicController {

    //*****************************
    //  提交维修申请
    //*****************************
    public function sendApply(){
        $uid=intval($_REQUEST['uid']);
        if (!$uid) {
            echo json_encode(array('status'=>0,'err'=>'网络异常！'));
            exit();
        }
        $data = array();
        $data['uid'] = $uid;
        $data['yezhu'] = $_REQUEST['yezhu'];
        $data['wuye'] = $_REQUEST['wuye'];
        $data['project_name'] = $_REQUEST['project_name'];
        $data['name'] = $_REQUEST['name'];
        $data['phone'] = $_REQUEST['phone'];
        $data['danwei'] = $_REQUEST['danwei'];
        $data['brand'] = $_REQUEST['brand'];
        $data['spec'] = $_REQUEST['spec'];
        $data['heavier'] = $_REQUEST['heavier'];
        $data['speed'] = $_REQUEST['speed'];
        $data['floor'] = $_REQUEST['floor'];
        $data['num'] = intval($_REQUEST['num']);
        $data['addtime'] = $_REQUEST['addtime'];
        $data['master_name'] = $_REQUEST['master_name'];
        $data['master_num'] = $_REQUEST['master_num'];
        $data['master_phone'] = $_REQUEST['master_phone'];
        $data['special'] = $_REQUEST['special'];
        $data['old_weihu'] = $_REQUEST['old_weihu'];
        $data['endtime'] = $_REQUEST['endtime'];
        $data['content'] = $_REQUEST['content'];
        $data['hege'] = $_REQUEST['hege'];
        $data['register'] = $_REQUEST['register'];
        $data['yuanli'] = $_REQUEST['yuanli'];
        $data['shuoming'] = $_REQUEST['shuoming'];
        $data['component'] = $_REQUEST['component'];
        $data['supervision'] = $_REQUEST['supervision'];
        $data['regular'] = $_REQUEST['regular'];
        $data['plan'] = $_REQUEST['plan'];
        $data['save'] = $_REQUEST['save'];
        $data['qita'] = $_REQUEST['qita'];
        $data['apply_time'] = time();
        $res = M('apply')->add($data);
        if($res){
            echo json_encode(array('status'=>1,'err'=>'申请成功！'));
        exit();
        }else{
            echo json_encode(array('status'=>0,'err'=>'申请失败！'));
            exit();
        }
        
    }

     //*****************************
    //  提交维修申请更改
    //*****************************
    public function updataApply(){
        $uid=intval($_REQUEST['uid']);
        $apply_id = intval($_REQUEST['apply_id']);
        if (!$uid) {
            echo json_encode(array('status'=>0,'err'=>'网络异常！'));
            exit();
        }

        $data = array();
        $data['uid'] = $uid;
        $data['yezhu'] = $_REQUEST['yezhu'];
        $data['wuye'] = $_REQUEST['wuye'];
        $data['project_name'] = $_REQUEST['project_name'];
        $data['name'] = $_REQUEST['name'];
        $data['phone'] = $_REQUEST['phone'];
        $data['danwei'] = $_REQUEST['danwei'];
        $data['brand'] = $_REQUEST['brand'];
        $data['spec'] = $_REQUEST['spec'];
        $data['heavier'] = $_REQUEST['heavier'];
        $data['speed'] = $_REQUEST['speed'];
        $data['floor'] = $_REQUEST['floor'];
        $data['num'] = intval($_REQUEST['num']);
        if($_REQUEST['addtime'] != '' && $_REQUEST['addtime'] != 'undefined'){
            $data['addtime'] = $_REQUEST['addtime'];
        }
        $data['master_name'] = $_REQUEST['master_name'];
        $data['master_num'] = $_REQUEST['master_num'];
        $data['master_phone'] = $_REQUEST['master_phone'];
        $data['special'] = $_REQUEST['special'];
        $data['old_weihu'] = $_REQUEST['old_weihu'];
        if($_REQUEST['endtime'] != '' && $_REQUEST['endtime'] != 'undefined'){
            $data['endtime'] = $_REQUEST['endtime'];
        }
        $data['content'] = $_REQUEST['content'];
        $data['hege'] = $_REQUEST['hege'];
        $data['register'] = $_REQUEST['register'];
        $data['yuanli'] = $_REQUEST['yuanli'];
        $data['shuoming'] = $_REQUEST['shuoming'];
        $data['component'] = $_REQUEST['component'];
        $data['supervision'] = $_REQUEST['supervision'];
        $data['regular'] = $_REQUEST['regular'];
        $data['plan'] = $_REQUEST['plan'];
        $data['save'] = $_REQUEST['save'];
        $data['qita'] = $_REQUEST['qita'];
        $res = M('apply')->where('id='.$apply_id)->save($data);
        if($res){
            echo json_encode(array('status'=>1,'err'=>'更改成功！'));
            exit();
        }else{
            echo json_encode(array('status'=>0,'err'=>'更改失败！'));
            exit();
        }
        
    }

    public function del(){
        $uid=intval($_REQUEST['uid']);
        $apply_id = intval($_REQUEST['apply_id']);
        if (!$uid) {
            echo json_encode(array('status'=>0,'err'=>'网络异常！'));
            exit();
        }
        $res = M('apply')->where('id='.$apply_id)->delete();
       if($res){
            echo json_encode(array('status'=>1,'err'=>'删除成功！'));
            exit();
        }else{
            echo json_encode(array('status'=>0,'err'=>'数据异常！'));
            exit();
        }
    }
    
}