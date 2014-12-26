<{include file="header.tpl"}>
<{include file="header_nav.tpl"}>
<{include file="aside.tpl"}>
<section class="vbox stretch">	
<div class="alert alert-success" role="alert" >
	<p>"<{$search}>"搜索结果如下：</p>
	</div>
          <div >
            <div class="col-sm-9 portlet">
              <section class="panel panel-default">
                <header class="panel-heading">
                  相关信息
                  <span class="badge bg-info">
                       <{$quesnum}>
                  </span>
                </header>
                  <ul class="list-group alt">
                    <{section name =times loop = $quesArray }>
                    <li class="list-group-item">
                      <div class="media">
                     <span class="pull-left thumb-sm"><img src="<{$quesArray[times].picture}>" alt="" class="img-circle"></span>
                           <div class="col-sm-9">
                            <a href="<{$quesArray[times].href}>"><strong class="block"><{$quesArray[times].title}></strong></a>
                            <a href="<{$quesArray[times].writerhref}>"><small><{$quesArray[times].writer}></small></a>
                          </div>
                          <div class="col-sm-10">
                            <small><p align="left"><{$quesArray[times].answer}></p></small>
                        <p align="right">
                           <small><{$quesArray[times].time}></small>
                         </p>
                        </div>
                       </div>
                    </li>

                   <{/section}>
               </ul>
              </section>
            </div>
            <div class="col-sm-3 portlet">
              <section class="panel panel-default">
                <header class="panel-heading">
                  相关成员
                  <span class="badge bg-info">
                        <{$mannum}>
                  </span>
                </header>
                <ul class="list-group alt">
                  <{section name =times loop = $manArray }>
                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="<{$manArray[times].picture}>" alt="" class="img-circle"></span>
                      <div class="pull-right <{$manArray[times].type}>  m-t-sm">
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="<{$manArray[times].manhref}>"><{$manArray[times].manname}></a></div>
                        <small class="text-muted"><{$manArray[times].inf}></small>
                      </div>
                    </div>
                  </li>
                  <{/section}>
                 </ul>
              </section>
            </div>
          </div>
</section>
<{include file="chat.tpl"}>
<{include file="script.tpl"}>
<{include file="footer.tpl"}>