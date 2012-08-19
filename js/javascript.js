$(function(){
	$("#back-to-top").hide();
//当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失

	$(function () {
		$(window).scroll(function(){
			if ($(window).scrollTop()>500){
				$("#back-to-top").fadeIn(600);
		}
		else{
				$("#back-to-top").fadeOut(600);
			}
		});
	//当点击跳转链接后，回到页面顶部位置
		$("#back-to-top").click(function(){
			$('body,html').animate({scrollTop:0},600);
			return false;
		});
	});



	$("#search").val('搜索，就是这么简单').css('color','#999999');
	$("#search").focusin(function(){
		if($('#search').val() =='搜索，就是这么简单'){
			$('#search').val('').css('color','#000');
		}
	}).focusout(function(){
		if($('#search').val() ==''){
			$('#search').val('搜索，就是这么简单').css('color','#999999');
		}
	});
	$("#email").val('邮箱').css('color','#999999');
	$("#email").focusin(function(){
		if($('#email').val() =='邮箱'){
			$('#email').val('').css('color','#000');
		}
	}).focusout(function(){
		if($('#email').val() ==''){
			$('#email').val('邮箱').css('color','#999999');
		}
	});
	
	
	
	//评论
	var $category=$(".comments");
	$category.hide();
	var $toggleBtn=$(".comment a");
	$toggleBtn.click(function(){
	if($(this).parent(".comment").parent().next().is(":visible")){
		$(this).parent(".comment").parent().next().slideUp("slow");
	  	//$(this).css("background","url(images/button.gif) 0px 0px").text("展开");
	 }else{
		$(this).parent(".comment").parent().next().slideDown("slow");
	   	//$(this).css("background","url(images/button.gif) 0px 33px").text("收起");
	 }
	 return false;
	});
	//修改评论
	$(".edit_answer").hide();
	$(".content .edit").click(function(){
		$(this).parent().hide();
		$(this).parent().next(".edit_answer").show();
	});
	$(".cancel").click(function(){
		$(this).parent().parent().parent().hide();
		$(this).parent().parent().parent().prev(".content").show();
	});
	
	
	
	//参数
	var $cate=$("#parameter");
	$cate.hide();
	$(".sort span").click(function(){
	if($(this).parent().prev("#parameter").is(":visible")){
		$(this).parent().prev("#parameter").slideUp("slow");
		$('html,body').animate({scrollTop: '0px'}, 800);
		$(this).text("查看参数");
	 }else{
		$(this).parent().prev("#parameter").slideDown("slow");
	   	$(this).text("关闭参数");
	 }
	});
	
	$(".button_box a").click(function(){
		$(this).parent().parent().parent(".comments").hide();
		//$body.animate({scrollTop:0},400);//400毫秒滑动到顶部
		//alert($(this).parent().parent().parent(".comments").height());
		
	 });
	$('.button_box span').click(function(){
		$comheight = $(document).scrollTop() - $(this).parent().parent().parent().parent(".comments").height() ;
		$(this).parent().parent().parent().parent(".comments").hide();
		//$comheight = $(this).parent().parent().parent(".comments").height();
		//alert($comheight);
		$('html,body').animate({scrollTop: $comheight}, 800);
		
		return false;
	});
	
	
	
});



KISSY.use("waterfall,ajax,template,node,button", function(S, Waterfall, io, Template, Node, Button) {
    var $ = Node.all;

    var tpl = Template($('#tpl').html()),
        nextpage = 1,
        waterfall = new Waterfall.Loader({
        container:"#ColumnContainer",
        load:function(success, end) {
            $('#loadingPins').show();
            S.ajax({
                data:{
                    'method': 'flickr.photos.search',
                    'api_key': '5d93c2e473e39e9307e86d4a01381266',
                    'tags': 'rose',
                    'page': nextpage,
                    'per_page': 20,
                    'format': 'json'
                },
                url: 'http://api.flickr.com/services/rest/',
                dataType: "jsonp",
                jsonp: "jsoncallback",
                success: function(d) {
                    // 如果数据错误, 则立即结束
                    if (d.stat !== 'ok') {
                        alert('load data error!');
                        end();
                        return;
                    }
                    // 如果到最后一页了, 也结束加载
                    nextpage = d.photos.page + 1;
                    if (nextpage > d.photos.pages) {
                        end();
                        return;
                    }
                    // 拼装每页数据
                    var items = [];
                    S.each(d.photos.photo, function(item) {
                        item.height = Math.round(Math.random()*(300 - 180) + 180); // fake height
                        items.push(new S.Node(tpl.render(item)));
                    });
                    success(items);
                },
                complete: function() {
                    $('#loadingPins').hide();
                }
            });
        },
        minColCount:2,
        colWidth:228
    });

    // scrollTo
    $('#BackToTop').on('click', function(e) {
        e.halt();
        e.preventDefault();
        $(window).stop();
        $(window).animate({
            scrollTop:0
        },1,"easeOut");
    });

    var b1 = new Button({
        content: "停止加载",
        render: "#button_container",
        prefixCls: "goog-"
    });

    // 点击按钮后, 停止瀑布图效果
    b1.render();
    b1.on("click", function() {
        waterfall.destroy();
    });
});



