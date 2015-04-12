<?php

require_once('bug.class.php');

$func = $_GET['func'];

if ($func == 'cal_num') echo cal_num();
if ($func == 'aside_html') echo aside_html();

function cal_num()
{
	return 1;
}

function aside_html()
{
      $bug = new Bug();

	$str = '
<h4 class="font-thin">最新反馈</h4>
<section class="panel panel-default">
      <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                  <!--<thead>
                        <tr>
                              <th>Bug</th>
                              <th>提交人</th>
                              <th>状态</th>
                        </tr>
                  </thead>-->
                  <tbody>
';
      $result_all = $bug->bug_status(2);
      foreach($result_all as $value_all)
      {
            if($value_all['status'] == 0) $str .= '                           <tr><td><span class="label label-info">新发布</span>&nbsp;';
            else if($value_all['status'] == 1) $str .= '                           <tr><td><span class="label label-danger">修复中</span>&nbsp;';
            else if($value_all['status'] == 2) $str .= '                           <tr><td><span class="label label-success">已修复</span>&nbsp;';
            else if($value_all['status'] == 3) $str .= '                           <tr><td><span class="label label-default">已关闭</span>&nbsp;';
            $str .= '<a href="/app/feedback/bug_info.php?bug_name='.$value_all['bugid'].'">'.$value_all['title'].'</a></td></tr>
';
      }
	$str .= '
                  </tbody>
            </table>
      </div>
</section>
';
      return $str;
}
?>
