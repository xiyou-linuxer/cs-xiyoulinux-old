/**********************************

	* tabview
	* Copyright (c) yeso!
	* Date: 2010-07-28
	
说明：
	* 应用对象必须为舌签按钮的直接父元素，且父元素内不包含其他非按钮元素
	* example: $( ".menuWrapper_wrap" ).tabview({ contWrapperSelector:".content_wrap",toggleEvent:"mouseover" });
	* contWrapperSelector:内容块的直接父元素的 jq 选择器
	* toggleEvent:触发事件名
	* toggleStyle:切换方式。可取值："normal" "fade" "move" "move-fade" "move-animate"
	* direction:移动方向。可取值："left" "top" （toggleStyle为"move"或"move-fade" "move-animate"时有效）
	* aniMethod:动画方法（特殊效果需插件（如：easing）支持，toggleStyle为"move-animate"时有效）
	* aniSpeed:动画速度
	* menuActiveStyle:菜单选中样式名
**********************************/
/* 代码整理：懒人之家 lanrenzhijia.com */

;(function($){
	
$.fn.tabview = function(options) {

	var opts = $.extend({}, $.fn.tabview.defaults, options);
	
	return this.each(function(i) {
		var _this = $(this);
		var menuWrapper = _this.children(opts.menuWrapperSelector);
		var contWrapper = _this.children(opts.contWrapperSelector);
		if (!(contWrapper && menuWrapper)) return;
		
		var menus = menuWrapper.children(opts.menuSelector);

		if (opts.toggleStyle=="move" || opts.toggleStyle=="move-fade" || opts.toggleStyle=="move-animate") {
			var step = 0;
			if (opts.direction == "left") {
				step = contWrapper.children(opts.contSelector).outerWidth(true);
			} else {
				step = contWrapper.children(opts.contSelector).outerHeight(true);
			}
		}
		
		if(opts.toggleStyle == "move-animate") { var animateArgu = new Object();}

		menus[opts.toggleEvent] (function() {
			var index = menus.index($(this));
			$(this).addClass(opts.menuActiveStyle).siblings().removeClass(opts.menuActiveStyle);

			switch (opts.toggleStyle) {
				case "fade":
					if(!(contWrapper.children(opts.contSelector).eq(index).is(":animated"))) {
						contWrapper.children(opts.contSelector).eq(index).siblings().css("display", "none")
							.end().stop( true, true ).fadeIn(opts.aniSpeed);
					}
					break;
				case "move":
					contWrapper.children(opts.contSelector).css(opts.direction,-step*index+"px");
					break;
				case "move-fade":
					if (contWrapper.children(opts.contSelector).css(opts.direction)==-step*index+"px") break;
					contWrapper.children(opts.contSelector).stop(true).css("opacity",0).css(opts.direction,-step*index+"px").animate({"opacity":1},opts.aniSpeed);
					break;
				case "move-animate":
					animateArgu[opts.direction]=-step*index+"px";
					contWrapper.children(opts.contSelector).stop(true).animate(animateArgu,opts.aniSpeed,opts.aniMethod);
					break;
				default:
					contWrapper.children(opts.contSelector).eq(index).css("display", "block")
						.siblings().css("display","none");
			}
	
		});
		
		menus.eq(0)[opts.toggleEvent]();
		
	});
};	

$.fn.tabview.defaults={
	menuWrapperSelector : ".menu-wrapper",
	menuSelector : "*",
	contWrapperSelector : ".cont-wrapper",
	contSelector : "*",
	toggleEvent : "mouseover",
	toggleStyle : "normal",
	direction : "top",
	aniMethod : "swing",
	aniSpeed : "fast",
	menuActiveStyle : "active"
};

})(jQuery);