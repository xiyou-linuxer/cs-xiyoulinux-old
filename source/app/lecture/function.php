<?php
    require(dirname(dirname(dirname(__FILE__))) . '/config.php');
    require(dirname(__FILE__) . "/includes/lecture.class.php");
    
    $func = $_GET['func'];
    if ($func == 'aside_html') echo aside_html();
	if ($func == 'cal_num') echo cal_num();

    function cal_num()
    {
        $lecture_inc = new LectureClass();
        $num = count($lecture_inc->get_recent_list());
        
        if ($lecture_inc->get_recent_list() == false) return 0;
        return $num;
    }

    function aside_html()
    {
        $lecture_inc = new LectureClass();
        $recent = $lecture_inc->get_recent_list();
        if ($recent == false)
            return '
    			<h4 class="font-thin">本期讲座</h4>
    			<section class="panel panel-default">
                    <section class="panel-body text-center" style="padding-top:50px; padding-bottom:50px">
    				    <strong>近期无讲座</strong>
                    </section>
    			</section>
            ';
        else {
            $taglist = json_decode($recent[0]["tag"]);
            $taghtml = "";
            foreach ($taglist->tag as $tag) {
                $taghtml .= '<label class="label label-info" style="margin-right: 5px;">'.$tag.'</label>';
            }
            return '
                <h4 class="font-thin">本期讲座</h4>
    			<section class="panel panel-default">
                    <section class="panel-body">
                        <h3 style="margin-top: 5px">'.$recent[0]["title"].'</h3>
                        <hr>
                        <ul style="list-style:none; margin:0; padding:0">
                            <li style="padding-bottom: 10px;">
                                <i class="fa fa-user" style="width: 2em; text-align:center; margin-right: 10px"></i>
                                <span>'.$recent[0]["lecture_author"].'</span>
                            </li>
                            <li style="padding-bottom: 10px;">
                                <i class="fa fa-clock-o" style="width: 2em; text-align:center; margin-right: 10px"></i>
                                <span>'.$recent[0]["time"].'</span>
                            </li>
                            <li style="padding-bottom: 10px;">
                                <i class="fa fa-map-marker" style="width: 2em; text-align:center; margin-right: 10px"></i>
                                <span>'.$recent[0]["location"].'</span>
                            </li>
                            <li style="padding-bottom: 15px;">
                                <i class="fa fa-tags" style="width: 2em; text-align:center; margin-right: 10px"></i>
                                <span>'.$taghtml.'</span>
                            </li>
                            <li class="text-right">
                                <a href="app/lecture/index.php?lid='.$recent[0]["lid"].'">查看详情&gt;&gt;</a>
                            </li>
                        </ul>
                    </section>
    			</section>
            ';
        }
    }
?>
