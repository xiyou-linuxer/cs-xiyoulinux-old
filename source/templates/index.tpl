<{extends file="frame.tpl"}>

<{block name="content"}>

    <!-- 最新动态内容 index_content.html -->
    <div class="row">

        <div class="col-sm-8">

            <!--  第二部分  -->
            <div class="clo-sm-11">

                <h4 class="font-thin">最新动态</h4>

                <section class="comment-list block">

                    <{section name=activity_list loop=$activity_list}>
                    <!--  comment-item-id-1  -->
                    <article class="comment-item" mid="<{$activity_list[activity_list].mid}>">

                        <a class="pull-left thumb-sm avatar"><img src="<{$activity_list[activity_list].avatar}>" alt="..."></a>

                        <span class="arrow left"></span>

                        <section class="comment-body panel panel-default">

                            <header class="panel-heading">

                                <a href="<{$activity_list[activity_list].profile}>"><{$activity_list[activity_list].name}></a>

                                <label class="label <{$activity_list[activity_list].actioncolor}> m-l-xs"><{$activity_list[activity_list].actiontext}></label>

                                <span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i><{$activity_list[activity_list].time}></span>

                            </header>
                            
                            <div class="panel-body">
                                
                                <h4><a href="<{$activity_list[activity_list].href}>"><{$activity_list[activity_list].mdescribe}></a></h4>
                                
                                <div class="panel-body">
                                    
                                    <blockquote>
                                        
                                        <p><{$activity_list[activity_list].message}></p>
                                    
                                    </blockquote>
                                
                                </div>
                            
                            </div>
                        
                        </section>
                        
                    </article>
                    <{/section}>
                
                </section>
            
            </div>
        
        </div>

        <!-- mini_aside part  -->
        <div class="col-sm-4">

            <{section name = mini_aside_array loop = $mini_aside_array}>
            <div class="mini-aside" data-funcurl="<{$mini_aside_array[mini_aside_array]}>">
            </div>
            <{/section}>

        </div>

    </div>

<{/block}>

<{block name="scripts" append}>
    <script type="text/javascript">

        //dynamics fresh
        var times = 0;
        $('#bjax-target').scroll(function(){
            viewH = $(this).height();
            contentH = $(this).get(0).scrollHeight;
            scrollTop = $(this).scrollTop();
            if ((contentH - viewH - scrollTop <= 100) || (contentH - viewH < scrollTop)){
                ++times;
                if( times == 1 ){
                    var mid = $(".comment-item:last").attr("mid");
                    $.ajax({
                        type: "post",
                        data: {"mid": mid},
                        url: "<{#SiteDomain#}>/server/refresh.server.php",
                        success: function(data){
                            if( data.substr(0,5) != 'false'){
                                $(".comment-item:last").after(data);
                                $(".comment-item:last").hide();
                                $(".comment-item:last").prev().hide();
                                $(".comment-item:last").prev().prev().hide();                    
                                $(".comment-item:last").slideDown();
                                $(".comment-item:last").prev().slideDown();
                                $(".comment-item:last").prev().prev().slideDown();            
                            }
                            times = 0;
                        }
                    });
                }
            }    
        });

        //get mini aside data
        $('.mini-aside').each(function() {
            var elem = $(this);
            var func_url = '<{#SiteDomain#}>' + $(this).data('funcurl') + '?func=aside_html';
            $.get(func_url, function(data){
                elem.html(data);
            });
        });
    </script>
<{/block}>