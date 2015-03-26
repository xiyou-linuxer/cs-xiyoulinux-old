<?php
    $func = $_GET['func'];
    if ($func == 'aside_html') echo aside_html();

    function aside_html()
    {
        include_once('./preprocess.php');
        if ($status[$Current_Status] == 0) $width = 0;
        else $width = $current * 100 / $status[$Current_Status];
        return '
			<h4 class="font-thin">纳新进度</h4>
			<section class="panel panel-default">
				<div style="padding:20px; padding-bottom:0;">
					<h5 class="text-center">本轮已完成：'.$current.' / '.$status[$Current_Status].'</h5>
					<div class="progress progress-striped active">
						<div class="progress-bar progress-bar-success" role="progressbar" style="width: '.$width.'%">
						</div>
					</div>
				</div>
				<hr>
				<div style="padding:20px; padding-top:0;">
					<ul class="row" style="list-style: none; margin:0; padding:0;">
						<li class="col-md-3 text-center" style="padding:0">
							<a href="app/join/record.php"><h3 class="count text-dark">'.$status[1].'</h3> 报名 /<br/>一面</a>
						</li>
						<li class="col-md-3 text-center" style="padding:0">
							<h3 class="count text-info">'.$status[0].'</h3> 加面
						</li>
						<li class="col-md-3 text-center" style="padding:0">
							<h3 class="count text-primary">'.$status[2].'</h3> 二面
						</li>
						<li class="col-md-3 text-center" style="padding:0">
							<h3 class="count text-success">'.$status[3].'</h3> 三面
						</li>
					</ul>
				</div>
			</section>
        ';
    }
?>
