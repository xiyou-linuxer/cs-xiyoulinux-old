<?php

$func = $_GET['func'];

if ($func == 'cal_num') echo cal_num();
if ($func == 'aside_html') echo aside_html();

function cal_num()
{
	return 1;
}

function aside_html()
{
	return '
<h4 class="font-thin">内测反馈</h4>

<section class="panel panel-default">

      <div class="table-responsive">

            <table class="table table-striped b-t b-light">

                  <thead>

                        <tr>

                              <th class="th-sortable" data-toggle="class">项目</th>

                              <th>开始日期</th>

                              <th>
                                    <i class="icon-like"></i>
                              </th>

                        </tr>

                        <tr>

                              <td>XY Cloud</td>

                              <td>2010-05-17</td>

                              <td>243</td>

                        </tr>

                        <tr>

                              <td>XY ftp</td>

                              <td>2011-03-21</td>

                              <td>46</td>

                        </tr>

                        <tr>

                              <td>XY kernel</td>

                              <td>2012-08-21</td>

                              <td>41</td>

                        </tr>

                  </thead>

            </table>

      </div>

</section>
';
}
?>
