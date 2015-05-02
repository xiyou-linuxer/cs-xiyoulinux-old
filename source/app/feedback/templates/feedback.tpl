<{extends file="../../../templates/frame.tpl"}>

<{block name="content"}> 

    <div class="col-sm-8 portlet" id="bug-editor-view">
    
        <div class="panel-heading">
        
            <div class="panel-title">
  
                <h4 class="text-left">意见反馈</h4>
            
            </div>
            
        </div> <!--END PANEL HEADING-->
  
        <form class="form">
        
            <ul class="list-group list-bottom-no-margin">
                
                <li class="list-group-item">
                    
                    <div class="input-group">
                        
                        <span class="input-group-addon"><div class="label-title"><strong>标题</strong></div></span>
                        
                        <input type="text" id="bug-title" class="form-control bug-title" placeholder="请输入标题" autocomplete="off"></input>
                    </div>
                    
                </li>
                
                <li class="list-group-item">
                
                    <textarea  class="form-control textarea-custom" id="bug-content" rows=10  placeholder="请输入bug描述" autocomplete="off"></textarea>
                
                </li>
		    
                <li class="list-group-item">
                    
                    <textarea  class="form-control textarea-custom" id="bug-method" rows=10  placeholder="请输入bug复现方法" autocomplete="off"></textarea>
                    
                </li>

                <li class="list-group-item text-right">
                
                    <button class="btn btn-success" type="submit" id="btn-send-bug">提交</button>
          
                </li>
    
            </ul> <!--END PANEL BODY-->
        
        </form>
    
    </div><!--END MAIL EDITOR-->

    <div class="col-sm-4 portlet ui-sortable">
        
        <div class="panel-heading">
            
            <div class="panel-title">
                
                <div class="row">
                    
                    <div class="col-md-5">
                        
                        <h4 class="text-left">问题列表</h4>
                    
                    </div>
                    
                    <div class="col-md-7">
                        
                        <form class="navbar-form" role="search" action="<{$SITE_DOMAIN}>/app/feedback/feedback.php" method="get">
                 
                            <div class="form-group">
                        
                                <div class="input-group">
                                
                                    <span class="input-group-btn">
                        
                                        <button type="submit" id="bt_search" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
                        
                                    </span>
                        
                                    <input name="search_bug" id="search_bug" class="form-control input-sm no-border rounded" placeholder="搜bug" type="text">
                        
                                </div>
                        
                            </div>
                        
                        </form>

                    </div>
                    
                </div>
          
            </div>
  
        </div>

	      <{if $GET_SEARCH != ''}>
        <section class="panel panel-default portlet-item bug-list-panel">
            
            <header class="panel-heading">
                
                <ul class="nav nav-pills pull-right">
                    
                    <li>
                        
                        <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                    
                    </li>
                
                </ul>
                
                关于“<{$GET_SEARCH}>”的bug：
            </header>
            
            <section class="panel-body" style="overflow-y:auto">
		        
                <{section name=times loop=$search_bug}>
                <article class="media">
            
                    <div class="media-body">
                      
                        <{if $commited_bug[times].status eq "0"}><span class="label label-info">新发布</span><{/if}>
                      
                        <{if $commited_bug[times].status eq "1"}><span class="label label-danger">修复中</span><{/if}>
                        
                        <{if $commited_bug[times].status eq "2"}><span class="label label-success">已修复</span><{/if}>
                        
                        <{if $commited_bug[times].status eq "3"}><span class="label label-default">已关闭</span><{/if}>

                        <a href="<{$site_domain}>/app/feedback/bug_info.php?bug_name=<{$search_bug[times].bugid}>" class="h5"><{$search_bug[times].name}></a>
                    
                    </div>
                      
                </article>
                <{/section}>
            
                <div class="line pull-in"></div>
            
            </section>

        </section>
	      <{/if}>

        <section class="panel panel-info portlet-item bug-list-panel">
            
            <header class="panel-heading">
                
                <ul class="nav nav-pills pull-right">
                    
                    <li>
                    
                        <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                    
                    </li>
                
                </ul>
		            待修改的bug
            </header>
            
            <section class="panel-body" style="overflow-y:auto">

    		        <{section name=times loop=$waited_bug}>
                <article class="media">
                    
                    <div class="media-body">                        
                        
                        <a href="<{$SITE_DOMAIN}>/app/feedback/bug_info.php?bug_name=<{$waited_bug[times].bugid}>" class="h5"><{$waited_bug[times].name}></a>
                
                    </div>
                
                </article>
                
                <div class="line pull-in"></div>
    		        <{/section}>
        
            </section>

        </section>

	      <section  class="panel panel-success portlet-item bug-list-panel">
            
            <header class="panel-heading">
              
                <ul class="nav nav-pills pull-right">
                    <li>
                
                        <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                  
                    </li>
                  
                </ul>
		            
                已修改的bug

            </header>
            
            <section class="panel-body" style="overflow-y:auto">

		            <{section name=times loop=$fixed_bug}>
                <article class="media">
                    
                    <div class="media-body">                        
                      
                        <a href="<{$SITE_DOMAIN}>/app/feedback/bug_info.php?bug_name=<{$fixed_bug[times].bugid}>" class="h5"><{$fixed_bug[times].name}></a>
                    
                    </div>
                
                </article>
                
                <div class="line pull-in"></div>
		            <{/section}>

            </section>
        
        </section>
	     
        <section class="panel panel-default portlet-item bug-list-panel">
                
            <header class="panel-heading">
            
                <ul class="nav nav-pills pull-right">
                
                    <li>
                  
                        <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                  
                    </li>
                  
                </ul>
                
                  我提交的bug
            
            </header>
        
            <section class="panel-body" style="overflow-y:auto">

		            <{section name=times loop=$commited_bug}>
                <article class="media">
                    
                    <div class="media-body">

                        <{if $commited_bug[times].status eq "0"}><span class="label label-info">新发布</span><{/if}>
                      
                        <{if $commited_bug[times].status eq "1"}><span class="label label-danger">修复中</span><{/if}>
                        
                        <{if $commited_bug[times].status eq "2"}><span class="label label-success">已修复</span><{/if}>
                        
                        <{if $commited_bug[times].status eq "3"}><span class="label label-default">已关闭</span><{/if}>		

                        <a href="<{$SITE_DOMAIN}>/app/feedback/bug_info.php?bug_name=<{$commited_bug[times].bugid}>" class="h5"><{$commited_bug[times].name}></a>

                    </div>
                </article>
                
                <div class="line pull-in"></div>
		            <{/section}>

            </section>
        
        </section>

    </div>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="tips-modal" tabindex="-1" role="dialog" aria-labelledby="tips-modal-title" aria-hidden="true">
                
        <div class="modal-dialog">
                  
            <div class="modal-content">
                    
                <div class="modal-header">
                      
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
                </div>
                
                <div class="modal-body text-center">
			
                    <h5 class="modal-title text-center" id="tips-modal-content"></h5>
		            
                </div>

                <div class="modal-footer">
                
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="btn-modal-close">关闭</button>
                
                </div>
            
            </div><!-- /.modal-content -->
        
        </div><!-- /.modal -->
    
    </div>

<{/block}>

<{block name="scripts" append}>

    <script type="text/javascript">
        
        $(document).ready(function() {

            $('.bug-list-panel .panel-body').each(function(i, elem) {
                var height = ($(elem).height() > 200) ? 200 : $(elem).height() + 30;
                $(elem).height(height);
            });

            $('#btn-send-bug').click(function () {
                if($('#bug-content').val()=="" || $('#bug-method').val()=="" || $('#bug-title').val()=="") {
                    $('#tips-modal-content').html("标题、bug描述或bug复现方法不能为空!");
                    $('#tips-modal').modal({keyboard:true});
                    return false;
                } else {
                    var param = {
                        bugcontent: $('#bug-content').val(),
                        bugmethod: $('#bug-method').val(),
                        bugtitle: $('#bug-title').val()
                    };
                    $.post('<{$site_domain}>/app/feedback/commit_bug.php', param, function(data) {
                        $('#tips-modal-content').html(data);
                        $('#tips-modal').modal({keyboard:true});
                    });

                    return false;
                }
			
                return false;
            });
        });
    </script>

<{/block}>