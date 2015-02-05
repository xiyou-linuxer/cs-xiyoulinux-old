<{extends file="../../../templates/frame.tpl"}>

<{block name="content"}>  
                
	<div class="panel panel-info" id="mail-reader-view">
		<div class="panel-heading">
			<div class="panel-title">
				<h4 class="text-center" id="mail-reader-title"><{$bug.title}></h4>
			</div>
		</div> 

		<ul class="list-group">
			<li class="list-group-item">
				<span>提交作者：<{$bug.author}></span>
				<span style="margin-left: 150px">bug状态：
					<{if $bug.status eq "0"}>新发布<{/if}>
					<{if $bug.status eq "1"}>修复中<{/if}>
					<{if $bug.status eq "2"}>已修复<{/if}>
					<{if $bug.status eq "3"}>已关闭<{/if}>
				</span>
				<span style="margin-left: 150px">bug修改时间：<{$bug.modifytime}></span>
			</li>
		</ul> 
		<article class="media">
			<h4><span style="margin-left: 15px;font-weight:700">bug描述:</span></h4>
			<div class="media-body">
				<h5><span style="margin-left: 45px"><{$bug.content}></span></h5>
			</div>
		</article>
		<div class="line pull-in"></div>
		<article class="media">
			<h4><span style="margin-left: 15px;font-weight:700">bug复现方法:</span></h4>
			<div class="media-body">
				<h5><span style="margin-left: 45px"><{$bug.method}></span></h5>
			</div>
		</article>
	</div>
<{/block}>
