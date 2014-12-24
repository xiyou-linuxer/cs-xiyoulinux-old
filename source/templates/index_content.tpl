<{include file="header.tpl"}>
<{include file="header_nav.tpl"}>
<{include file="aside.tpl"}>

<!-- /.aside -->
<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable wrapper-lg" id="bjax-target">
<!-- 最新动态内容 index_content.html -->
	<div class="row">
		<div class="col-sm-8">
			<!--  第二部分  -->
			<div class="clo-sm-11">
				<h4 class="font-thin">最新动态</h4>
				<section class="comment-list block">
					<!--  comment-item-id-1  -->
					<{section name=times loop=$Dynamics_array}>
					<article class="comment-item" mid="<{$Dynamics_array[times].mid}>">
						<a class="pull-left thumb-sm avatar">
							<img src="<{$Dynamics_array[times].avatar}>" alt="..."></a>
						<span class="arrow left"></span>
						<section class="comment-body panel panel-default">
							<header class="panel-heading">
								<a href="<{$Dynamics_array[times].profile}>">
									<{$Dynamics_array[times].name}></a>
									<label class="label <{$Dynamics_array[times].actioncolor}> m-l-xs">
										<{$Dynamics_array[times].actiontext}></label>
										<span class="text-muted m-l-sm pull-right"> <i class="fa fa-clock-o"></i>
											<{$Dynamics_array[times].time}></span>
										</header>
										<div class="panel-body">
											<h4>
												<a href="<{$Dynamics_array[times].href}>"><{$Dynamics_array[times].mdescribe}></a></h4>
												<div class="panel-body">
													<blockpanel-bodyquote>
													<p><{$Dynamics_array[times].message}></p>
													</blockquote>
												</div>
										</div>
									</section>
					</article>
					<{/section}>
				</section>
			</div>
		</div>
<{include file="mini_aside.tpl"}>
<{include file="chat.tpl"}>
<{include file="script.tpl"}>
<{include file="footer.tpl"}>
