<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minidiantianzhuangwh/Public/ht/css/main.css?11" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minidiantianzhuangwh/Public/ht/js/jquery.js"></script>
<script type="text/javascript" src="/minidiantianzhuangwh/Public/ht/js/action.js"></script>
<script type="text/javascript" src="/minidiantianzhuangwh/Public/plugins/xheditor/xheditor-1.2.1.min.js"></script>
<script type="text/javascript" src="/minidiantianzhuangwh/Public/plugins/xheditor/xheditor_lang/zh-cn.js"></script>
<style>
  .d1{
    width:300px;
  }
</style>
<style type="text/css">  
table.altrowstable {  
    font-family: verdana,arial,sans-serif;  
    font-size:11px;  
    color:#333333;  
    border-width: 1px;  
    border-color: #a9c6c9;  
    border-collapse: collapse;  
}  
table.altrowstable th {  
    border-width: 1px;  
    padding: 6px;  
    border-style: solid;  
    border-color: #a9c6c9;  
}  
table.altrowstable td {  
    border-width: 1px;  
    padding: 6px;  
    border-style: solid;  
    border-color: #a9c6c9; 
    text-align: center; 
}  
.oddrowcolor{  
    background-color:#d4e3e5;  
}  
.evenrowcolor{  
    background-color:#c3dde0;  
}  
</style>  
</head>
<body>

<div class="aaa_pts_show_1">【 申请详情 】</div>

<div class="aaa_pts_show_2">
    <div>
       <div class="aaa_pts_4"><a href="<?php echo U('Apply/index');?>">维修管理</a></div>
    </div>

    <div class="aaa_pts_3">
    
      <table class="altrowstable" id="alternatecolor">  
        <tr>  
            <th>业主单位</th>
            <th>物业单位</th> 
            <th>项目名称</th>
            <th>联系人</th>
            <th>联系电话</th>
            <th>所属单位</th>
            <th>电梯品牌/厂家</th>
            <th>型号规格</th>
            <th>载重</th>
            <th>速度</th>
            
        </tr>  
        <tr>  
            <td><?php echo ($apply["yezhu"]); ?></td>
            <td><?php echo ($apply["wuye"]); ?></td>
            <td><?php echo ($apply["project_name"]); ?></td>
            <td><?php echo ($apply["name"]); ?></td>   
            <td><?php echo ($apply["phone"]); ?></td>   
            <td><?php echo ($apply["danwei"]); ?></td>   
            <td><?php echo ($apply["brand"]); ?></td>   
            <td><?php echo ($apply["spec"]); ?></td>   
            <td><?php echo ($apply["heavier"]); ?> kg</td>   
            <td><?php echo ($apply["speed"]); ?> m/s</td>   
           
        </tr>   
        <tr>  
            <th>层/站/门</th>
            <th>数量</th>
            <th>投用时间</th>
            <th>电梯安全管理员姓名</th>
            <th>安全管理员证件号码</th> 
            <th>安全管理员手机号码</th>
            <th>电梯维保特别要求</th>
            <th>原维保单位</th>
            <th>原维护截止期限</th>
            <th>梯况简要描述</th>
        </tr>  
         <tr>  
            <td><?php echo ($apply["floor"]); ?></td>   
            <td><?php echo ($apply["num"]); ?></td>   
            <td><?php echo ($apply["addtime"]); ?></td>   
            <td><?php echo ($apply["master_name"]); ?></td>
            <td><?php echo ($apply["master_num"]); ?></td>
            <td><?php echo ($apply["master_phone"]); ?></td>
            <td><?php echo ($apply["special"]); ?></td>   
            <td><?php echo ($apply["old_weihu"]); ?></td>   
            <td><?php echo ($apply["endtime"]); ?></td>    
            <td><?php echo ($apply["content"]); ?></td>    
        </tr>   
        <tr>  
            <th>电梯出厂合格证</th>
            <th>电梯注册使用登记证</th>
            <th>电气原理图</th>
            <th>安装使用维护说明书</th>
            <th>安全部件型式试验报告及调试证书</th> 
            <th>监督检验报告及检验合格标志</th>
            <th>定期检验报告及检验合格标志</th>
            <th>电梯井道土建布置图</th>
            <th>特种设备管理制度、应急救援预案等</th>
            <th>其他</th>
        </tr>  
         <tr>  
            <?php if($apply['hege'] == 1): ?><td>有</td>
              <?php elseif($apply['hege'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>
            <?php if($apply['register'] == 1): ?><td>有</td>
              <?php elseif($apply['register'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>  
            <?php if($apply['yuanli'] == 1): ?><td>有</td>
              <?php elseif($apply['yuanli'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>
            <?php if($apply['shuoming'] == 1): ?><td>有</td>
              <?php elseif($apply['shuoming'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>
            <?php if($apply['component'] == 1): ?><td>有</td>
              <?php elseif($apply['component'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>
           <?php if($apply['supervision'] == 1): ?><td>有</td>
              <?php elseif($apply['supervision'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>
            <?php if($apply['regular'] == 1): ?><td>有</td>
              <?php elseif($apply['regular'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?> 
           <?php if($apply['plan'] == 1): ?><td>有</td>
              <?php elseif($apply['plan'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>
           <?php if($apply['save'] == 1): ?><td>有</td>
              <?php elseif($apply['save'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>   
           <?php if($apply['qita'] == 1): ?><td>有</td>
              <?php elseif($apply['qita'] == 0): ?><td>无</td>
              <?php else: ?> <td>其他</td><?php endif; ?>   
        </tr>   
      </table>
    </div>
    
   
</div>
</body>
</html>
<script type="text/javascript">  
function altRows(id){  
    if(document.getElementsByTagName){    
          
        var table = document.getElementById(id);    
        var rows = table.getElementsByTagName("tr");   
           
        for(i = 0; i < rows.length; i++){            
            if(i % 2 == 0){  
                rows[i].className = "evenrowcolor";  
            }else{  
                rows[i].className = "oddrowcolor";  
            }        
        }  
    }  
}  
  
window.onload=function(){  
    altRows('alternatecolor');  
}  
</script>