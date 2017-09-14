<?php
namespace Ht\Controller;
use Think\Controller;
class ApplyController extends PublicController{
	//***********************************************
    public static $Array;//这个给检查产品的字段用 
    public static $PRO_FENLEI; //这个给产品分类打勾用
	//**************************************************
	//**********************************************
	//说明：产品列表管理 推荐 修改 删除 列表 搜索
	//**********************************************
	public function index(){
		$id=(int)$_GET['id'];

		//搜索变量
		$status=$this->htmlentities_u8($_GET['status']);
		$yezhu=$this->htmlentities_u8($_GET['yezhu']);
		//===============================
		// 产品列表信息 搜索
		//===============================
		//搜索
		$where="1=1";
		$yezhu!='' ? $where.=" AND yezhu like '%$yezhu%'" : null;
		$status!=='' ? $where.=" AND status=$status" : null;
		define('rows',20);
		$count=M('apply')->where($where)->count();
		$rows=ceil($count/rows);
		$page=(int)$_GET['page'];
		$page<0?$page=0:'';
		$limit=$page*rows;
		$page_index=$this->page_index($count,$rows,$page);
		$apply=M('apply')->where($where)->order('id desc')->limit($limit,rows)->select();

		//==========================
		// 将GET到的数据再输出
		//==========================
		$this->assign('id',$id);
		$this->assign('yezhu',$yezhu);
		$this->assign('status',$status);
		$this->assign('page',$page);
		//=============
		// 将变量输出
		//=============	
		$this->assign('apply',$apply);
		$this->assign('page_index',$page_index);
		$this->display();
	}
	//**********************************************
	//说明：修改状态
	//**********************************************
	public function set_status(){	

		$id=intval($_GET['id']);
		$status = M('apply')->where('id='.$id)->getField('status');
		$data['status'] = $status==1 ? 0 : 1;
		$res = M('apply')->where('id='.$id)->save($data);
		if($res){
			$this->success('操作成功！');
			exit();
		}else{
			$this->success('操作失败！');
			exit();
		}

	}

	//**********************************************
	//说明：申请详情
	//**********************************************
	public function detail(){
		$id = intval($_GET['id']);
		$apply = M('apply')->where('id='.$id)->find();
		$this->assign('apply',$apply);
		$this->display();
	}

	//***************************
	//说明：产品 删除
	//***************************
	public function del()
	{
		$id = intval($_REQUEST['id']);
		$info = M('apply')->where('id='.intval($id))->find();
		if (!$info) {
			$this->error('信息错误.'.__LINE__);
			exit();
		}

		$res = M('apply')->where('id='.intval($id))->delete();
		if($res){
			$this->success('删除成功！');
			exit();
		}else{
			$this->error('删除失败！');
		}
	}	

	

}