<{extends file="frame.tpl"}>

<{block name="stylesheet" append}>
  <style type="text/css">
  .pull-right i{
    color:#a9a9a9;
  }
  .comment-picture{
    position: absolute;
  }
  .comment-picture img{
    border-radius: 50%;
  }
  .comment-inform{
    margin-left: 40px;
  }
  .comment-inform a{
    color: #66CC66;
  }
  .comment-inform p{
    color: #bbbbbb;
  }
  .comment-text{
    margin-top: -5px;
  }
  .comment-content:first-child{
    margin-top: 0px;
  }
  .comment-content{
    margin-top: 10px;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-bottom-color: #eeeeee;
  }
  .comment-content:last-child{
    border-bottom-width: 0px;
  }
  </style>
<{/block}>

<{block name="content"}>
  <!-- 最新动态内容 index_content.html -->
  <div class="row">
    <div class="col-sm-8">
      <!--  第二部分  -->
      <h4 class="font-thin">最新动态</h4>

      <section class="comment-list block">
        <{section name=n loop=$activity_list}>
        <!--  comment-item-id-1  -->
        <article class="comment-item" mid="<{$activity_list[n].mid}>">
          <a class="pull-left thumb-sm avatar">
            <img src="<{$activity_list[n].avatar}>" alt="...">
          </a>
          <span class="arrow left"></span>
          <!--主体内容  -->
          <section class="comment-body panel panel-default">
            <header class="panel-heading">
              <a href="<{$activity_list[n].profile}>">
                <{$activity_list[n].name}>
              </a>

              <label class="label <{$activity_list[n].actioncolor}> m-l-xs">
                <{$activity_list[n].actiontext}>
              </label>

              <span class="text-muted m-l-sm pull-right">
                <i class="fa fa-clock-o"></i>
                <{$activity_list[n].time}>
              </span>
            </header>

            <div class="panel-body">
              <h4>
                <a href="<{$activity_list[n].href}>">
                  <{$activity_list[n].mdescribe}>
                </a>
              </h4>
              <blockpanel-bodyquote>
                <p><{$activity_list[n].message}></p>
              </blockquote>
              <div class="pull-right">
                <i class="fa fa-thumbs-up"></i>
                <i class="fa fa-comments" style="margin-left:10px;" 
                data-action="comment" data-actid="<{$activity_list[n].mid}>"></i>
              </div>
            </div>
            <div class="panel-footer">
              <{section name=m loop=$activity_list[n].comments}>
              <div class="comment-content">
                <div class="comment-picture">
                  <a href="/profile.php?uid=<{$activity_list[n].comments[m].author_id}>">
                    <img width="30px" height="30px" src="<{$activity_list[n].comments[m].author_avatar}>">
                  </a> 
                </div>
                <div class="comment-inform">
                  <a href="/profile.php?uid=<{$activity_list[n].comments[m].author_id}>">
                    <strong><{$activity_list[n].comments[m].author_name}></strong>
                  </a>
                  <p>
                    <small><{$activity_list[n].comments[m].create_at}></small>
                  </p>
                </div>
                <div class="comment-text">
                  <P style="margin-left:40px;"><{$activity_list[n].comments[m].content}>
                  </P>
                </div>
              </div>
              <{/section}>
            </div>
            <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" 
            aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">想说点什么呢</h4>
                  </div>
                  <div class="modal-body">
                    <input id="commentActId" type="hidden">
                    <textarea id="commentContent" cols="90" rows="6"></textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button id="commentPublish" type="button" class="btn btn-primary" data-dismiss="modal">发表</button>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </article>
        <{/section}>
      </section>
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
    $('#bjax-target').scroll(function() {
      var viewH = $(this).height();
      var contentH = $(this).get(0).scrollHeight;
      var scrollTop = $(this).scrollTop();

      if ((contentH - viewH - scrollTop <= 100) ||
        (contentH - viewH < scrollTop)) {
        ++times;
        if (times === 1) {
          var mid = $(".comment-item:last").attr("mid");

          $.ajax({
            type: "post",
            data: {"mid": mid},
            url: "<{$site_domain}>/server/refresh.server.php",
            uccess: function (data) {
              if (data.substr(0,5) !== 'false') {
                $(".comment-item:last").after(data);
                $(".comment-item:last").hide();
                $(".comment-item:last").prev().hide();
                $(".comment-item:last").prev().prev().hide();

                $(".comment-item:last").slideDown();
                $(".comment-item:last").prev().slideDown();
                $(".comment-item:last").prev().prev().slideDown
              }

              times = 0;
            }
          });
        }
      } 
    });
    //get mini aside data
    $('.mini-aside').each(function () {
      var elem = $(this);
      var func_url = '<{$site_domain}>' + 
        $(this).data('funcurl') + '?func=aside_html';

      $.get(func_url, function (data) {
        elem.html(data);
      });
    });

    $('[data-action="comment"]').click(function () {
      var $actId = $(this).data('actid');

      $('#commentActId').val($actId);
      $('#commentModal').modal();
    });

    $('#commentPublish').click(function () {
      var $actId = $('#commentActId').val();
      var $content = $('#commentContent').val();

      if (!$content) {
        alert('评论信息不能为空！');
        return false;
      }

      $.post('<{$site_domain}>/server/activity.server.php', {
        action: 'new_comment',
        content: $content,
        act_id: $actId
      }, function (res) {
        res = JSON.parse(res);
        alert(res.msg);
        location.reload();
      });
    });
  </script>
<{/block}>