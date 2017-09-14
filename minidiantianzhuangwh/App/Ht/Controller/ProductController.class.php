<?php
namespace Ht\Controller;
use Think\Controller;
class ProductController extends PublicController{
	//***********************************************
    public static $Array;//这个给检查产品的字段用 
    public static $PRO_FENLEI; //这个给产品分类打勾用
	//**************************************************
	//**********************************************
	//说明：产品列表管理 推荐 修改 删除 列表 搜索
	//**********************************************
	public function index(){
		$aaa_pts_qx=1;
		$id=(int)$_GET['id'];
		$shop_id=(int)$_GET['shop_id'];

		//搜索变量
		$type=$this->htmlentities_u8($_GET['type']);
		$tuijian=$this->htmlentities_u8($_GET['tuijian']);
		$name=$this->htmlentities_u8($_GET['name']);
		//===============================
		// 产品列表信息 搜索
		//===============================
		//搜索
		$where="1=1 AND del<1";
		$tuijian!=='' ? $where.=" AND type=$tuijian" : null;
		$shop_id>0 ? $where.=" AND shop_id=$shop_id" : null;
		$name!='' ? $where.=" AND name like '%$name%'" : null;
		define('rows',20);
		$count=M('product')->where($where)->count();
		$rows=ceil($count/rows);
		$page=(int)$_GET['page'];
		$page<0?$page=0:'';
		$limit=$page*rows;
		$page_index=$this->page_index($count,$rows,$page);
		$productlist=M('product')->where($where)->order('addtime desc')->limit($limit,rows)->select();
		//dump($productlist);exit;
		foreach ($productlist as $k => $v) {
			$productlist[$k]['shangchang'] = M('shangchang')->where('id='.intval($v['shop_id']))->getField('name');
			$productlist[$k]['cname'] = M('pro_cat')->where('id='.intval($v['cid']))->getField('name');
		}

		//==========================
		// 将GET到的数据再输出
		//==========================
		$this->assign('id',$id);
		$this->assign('tuijian',$tuijian);
		$this->assign('name',$name);
		$this->assign('type',$type);
		$this->assign('shop_id',$shop_id);
		$this->assign('page',$page);
		//=============
		// 将变量输出
		//=============	
		$this->assign('productlist',$productlist);
		$this->assign('page_index',$page_index);
		$this->display();
	}
	//**********************************************
	//说明：产品 添加修改
	//注意：cid 分类id  shop_id店铺id
	//**********************************************
	public function add(){	

		$id=(int)$_GET['id'];
		$page=(int)$_GET['page'];
		$name=$_GET['name'];
		$type=$_GET['type'];

		if($_POST['submit']==true){
		try{	
			//如果不是管理员则查询商家会员的店铺ID
			$id = intval($_POST['pro_id']);
			$array=array(
				'name'=>$_POST['name'] ,
				'shop_id'=> intval($_POST['shop_id']) ,//所属店铺
				'cid'=> intval($_POST['cid']) ,			//产品分类ID
				'sort'=>(int)$_POST['sort'] , 
				'price'=>(float)$_POST['price'] , 
				'price_yh'=>(float)$_POST['price_yh'] ,
				'updatetime'=>time(),
				'content'=>$_POST['content'] , 
				'renqi' => intval($_POST['renqi']),
			);
			  
			//判断产品详情页图片是否有设置宽度，去掉重复的100%
			if(strpos($array['content'],'width="100%"')){
				$array['content']=str_replace(' width="100%"','',$array['content']);
			}
			//为img标签添加一个width
			$array['content']=str_replace('alt=""','alt="" width="100%"',$array['content']);
		  
			//上传产品小图
			if (!empty($_FILES["photo_x"]["tmp_name"])) {
					//文件上传
					$info = $this->upload_images($_FILES["photo_x"],array('jpg','png','jpeg'),"product/".date(Ymd));
				    if(!is_array($info)) {// 上传错误提示错误信息
				        $this->error($info);
				        exit();
				    }else{// 上传成功 获取上传文件信息
					    $array['photo_x'] = 'UploadFiles/'.$info['savepath'].$info['savename'];
					    $xt = M('product')->where('id='.intval($id))->field('photo_x')->find();
					    if ($id && $xt['photo_x']) {
					    	$img_url = "Data/".$xt['photo_x'];
							if(file_exists($img_url)) {
								@unlink($img_url);
							}
					    }
				    }
			}

			//上传产品大图
			if (!empty($_FILES["photo_d"]["tmp_name"])) {
					//文件上传
					$info = $this->upload_images($_FILES["photo_d"],array('jpg','png','jpeg'),"product/".date(Ymd));
				    if(!is_array($info)) {// 上传错误提示错误信息
				        $this->error($info);
				        exit();
				    }else{// 上传成功 获取上传文件信息
					    $array['photo_d'] = 'UploadFiles/'.$info['savepath'].$info['savename'];
					    $dt = M('product')->where('id='.intval($id))->field('photo_d')->find();
					    if ($id && $dt['photo_d']) {
					    	$img_url2 = "Data/".$dt['photo_d'];
							if(file_exists($img_url2)) {
								@unlink($img_url2);
							}
					    }
				    }
			}
			
			//执行添加
			if(intval($id)>0){
				//将空数据排除掉，防止将原有数据空置
				foreach ($array as $k => $v) {
					if(empty($v)){
					  	unset($v);
					}
				}

				$sql = M('product')->where('id='.intval($id))->save($array);
			}else{
				$array['addtime']=time();
				$sql = M('product')->add($array);
				$id=$sql;
			}

			//规格操作
			if($sql){//name="guige_name[]
				$this->success('操作成功.');
				exit();
			}else{
				throw new \Exception('操作失败.');
			}
			  
			}catch(\Exception $e){
				echo "<script>alert('".$e->getMessage()."');location='{:U('index')}?shop_id=".$shop_id."';</script>";
			}
		}

		//=========================
		// 查询所有一级产品分类
		//=========================
		$cate_list = M('pro_cat')->where('del=0')->field('id,name')->select();
		$this->assign('cate_list',$cate_list);

		//=========================
		// 查询产品信息
		//=========================
		$pro_allinfo= $id>0 ? M('product')->where('id='.$id)->find() : "";
		//商场信息
		$shangchang= $pro_allinfo ? M('shangchang')->where('id='.intval($pro_allinfo['shop_id']))->find() : "";

		//==========================
		// 将GET到的数据再输出
		//==========================
		$this->assign('id',$id);
		$this->assign('name',$name);
		$this->assign('type',$type);
		$this->assign('shop_id',$shop_id);
		$this->assign('page',$page);
		//=============
		// 将变量输出
		//=============	
		$this->assign('pro_allinfo',$pro_allinfo);
		$this->assign('shangchang',$shangchang);
		$this->display();

	}

	//***************************
	//说明：产品 设置推荐
	//***************************
	public function set_tj(){
		$pro_id = intval($_REQUEST['pro_id']);
		$tj_update=M('product')->field('shop_id,type')->where('id='.intval($pro_id).' AND del=0')->find();
		if (!$tj_update) {
			$this->error('产品不存在或已下架删除！');
			exit();
		}

		$shopinfo = M('shangchang')->where('id='.intval($tj_update['shop_id']))->find();
		//查status,不符合条件不给通过
		if(intval($shopinfo['status']) != 1) { 
		    $this->error('商家未通过审核，产品不能设置推荐.');
		    exit;
		}

		//查推荐type
		//dump($tj_update);
		$data = array();
		$data['type'] = $tj_update['type']==1 ? 0 : 1;
		$up = M('product')->where('id='.intval($pro_id))->save($data);
		if ($up) {
			$this->redirect('index',array('page'=>intval($_REQUEST['page'])));
			exit();
		}else{
		    $this->error('操作失败！');
			exit();
		}
	}

	//***************************
	//说明：产品 删除
	//***************************
	public function del()
	{
		$id = intval($_REQUEST['did']);
		$info = M('product')->where('id='.intval($id))->find();
		if (!$info) {
			$this->error('产品信息错误.'.__LINE__);
			exit();
		}

		if (intval($info['del'])==1) {
			$this->success('操作成功！.'.__LINE__);
			exit();
		}

		$data=array();
		$data['del'] = $info['del'] == '1' ?  0 : 1;
		$data['del_time'] = time();
		$up = M('product')->where('id='.intval($id))->save($data);
		if ($up) {
			$this->redirect('index',array('page'=>intval($_REQUEST['page'])));
			exit();
		}else{
			$this->error('操作失败.');
			exit();
		}
	}	

	//**************************************
  	// 说明：产品字段检测
  	//**************************************
	public function check(){
		try 
		{
			
			if(self::$Array['name']==''){
				throw new \Exception('产品名字不能为空！');
			}
			
			if(self::$Array['shop_id']==''){
				throw new \Exception('请选择所属店铺！');
			}
			
			return 1;
			
		}
		catch(\Exception $e)
		{
			$this->error_message=$e->getMessage();
			return false;
		}
    }

}