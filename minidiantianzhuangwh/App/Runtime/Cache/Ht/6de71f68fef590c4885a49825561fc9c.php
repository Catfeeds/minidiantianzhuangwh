<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minidiantianzhuangwh/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minidiantianzhuangwh/Public/ht/js/jquery.js"></script>
<script type="text/javascript" src="/minidiantianzhuangwh/Public/ht/js/action.js"></script>
</head>
<body>

<div class="aaa_pts_show_1">【 维修管理 】</div>

<div class="aaa_pts_show_2">
    <div>
       <div class="aaa_pts_4"><a href="<?php echo U('Apply/index');?>">维修管理</a></div>
    </div>
    <div class="aaa_pts_3">
      
      <div class="pro_4 bord_1">
         <div class="pro_5">业主单位：<input type="text" class="inp_1 inp_6" id="yezhu" value="<?php echo ($yezhu); ?>"></div>
         <div class="pro_5">
               维修状态：
               <select class="inp_1 inp_6" id="status">
			      <option value="">全部状态</option>
                  <option value="1" <?php echo $status=='1' ? 'selected="selected"' : NULL ?>>已处理</option>
                  <option value="0" <?php echo $status=='0' ? 'selected="selected"' : NULL ?>>未处理</option>
	           </select>
         </div>  
         <div class="pro_6"><input type="button" class="aaa_pts_web_3" value="搜 索" style="margin:0;" onclick="product_option(0);"></div>
      </div>
      
      <table class="pro_3">
         <tr class="tr_1">
           <td>ID</td>
           <td>业主单位</td>
           <td>物业单位</td>
           <td>联系人</td>
           <td>联系电话</td>
           <td>所属单位</td>
           <td>申请时间</td>
           <td>状态</td>
           <td>操作</td>
         </tr>
         <tbody id="news_option">
         <!-- 遍历 -->
          <?php if(is_array($apply)): $i = 0; $__LIST__ = $apply;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
             <td><?php echo ($v["id"]); ?></td>
             <td><?php echo ($v["yezhu"]); ?></td>
             <td><?php echo ($v["wuye"]); ?></td>
             <td><?php echo ($v["name"]); ?></td>
             <td><?php echo ($v["phone"]); ?></td>
             <td><?php echo ($v["danwei"]); ?></td>
             <td><?php echo (date("Y-m-d",$v["apply_time"])); ?></td>
             <?php if($v["status"] == 1): ?><td><label style="color:green;">已处理</label></td>
             <?php else: ?>
             <td><label style="color:green;">未处理</label></td><?php endif; ?>
            <td>
              <a href="<?php echo U('set_status');?>?id=<?php echo ($v["id"]); ?>&page=<?php echo ($page); ?>&yezhu=<?php echo ($yezhu); ?>&status=<?php echo ($status); ?>">已/未处理</a> |
              <a href="<?php echo U('Apply/detail');?>?id=<?php echo ($v["id"]); ?>&page=<?php echo ($page); ?>&yezhu=<?php echo ($yezhu); ?>&status=<?php echo ($status); ?>">详情</a> |
              <a onclick="del_id_urls(<?php echo ($v["id"]); ?>)">删除</a>
             </td>
           </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
         <!-- 遍历 -->
         </tbody>
         <tr>
            <td colspan="10" class="td_2">
                  <?php echo ($page_index); ?>  
             </td>
         </tr>
      </table>      
    </div>
    
</div>
<script>
function product_option(page){
	
  var obj={
	   "yezhu":$("#yezhu").val(),
	   "status":$("#status").val()
	  }
	  //alert(obj);exit();
  var url='?page='+page;
  $.each(obj,function(a,b){
	  url+='&'+a+'='+b;
	 });
  location=url;
}

function del_id_urls (id) {
  if (confirm('您确定要删除吗？')) {
    location.href="<?php echo U('del');?>?id="+id;
  };
}
</script>
</body>
</html>