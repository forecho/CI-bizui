
<div id="main">
	<div style="clear:both"></div>
	
	<div class="tags_box">
		<div class="tags_tab">
			<?php foreach($selclass as $row_class):?>
			<a href="welcome/tags/<?php echo $row_class['cname'];?>"><h2><?php echo $row_class['cname'];?>品牌</h2></a>
			<?php endforeach;?>
		</div>
		<?php foreach($selbrands as $row_brands):?>
		<div class="tag_link">
			<a href="welcome/product/<?php echo $row_brands['bname'];?>"><img src="images/brands/<?php echo $row_brands['bimg'];?>" alt="" /></a>
			<h4><a href=""><?php echo $row_brands['bname'];?></a></h4>
		</div>
		<?php endforeach;?>
		<!-- <div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/295_.jpg" alt="" />
			<h4><a href="">摩托罗拉</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/143_.jpg" alt="" />
			<h4><a href="">LG</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/33080_.jpg" alt="" />
			<h4><a href="">HTC</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/544_.jpg" alt="" />
			<h4><a href="">Apple（苹果）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/1069_.jpg" alt="" />
			<h4><a href="">索尼移动</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/642_.jpg" alt="" /></a>
			<h4><a href="">中兴</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1795_.jpg" alt="" /></a>
			<h4><a href="">步步高</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/300_.jpg" alt="" /></a>
			<h4><a href="">夏普</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1763_.jpg" alt="" /></a>
			<h4><a href="">联想</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/613_.jpg" alt="" /></a>
			<h4><a href="">华为</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1673_.jpg" alt="" /></a>
			<h4><a href="">OPPO</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1632_.jpg" alt="" /></a>
			<h4><a href="">金立</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1606_.jpg" alt="" /></a>
			<h4><a href="">酷派</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="images/pinpai/xiaomi.jpg" alt="" /></a>
			<h4><a href="">小米</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1434_.jpg" alt="" /></a>
			<h4><a href="">魅族</a></h4>
		</div>
		
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/160_.jpg">
			<h4><a href="">联想</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/160_.jpg">
			<h4><a href="">联想ThinkPad</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/227_.jpg" alt="" />
			<h4><a href="">ASUS（华硕）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/218_.jpg" alt="" />
			<h4><a href="">Acer宏碁</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/21_.jpg" alt="" />
			<h4><a href="">DELL（戴尔）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/223_.jpg" alt="" />
			<h4><a href="">HP（惠普）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/167_.jpg" alt="" />
			<h4><a href="">SONY（索尼）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/1191_.jpg" alt="" />
			<h4><a href="">HASEE（神舟）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/98_.jpg" alt="" />
			<h4><a href="">三星</a></h4>
		</div>
		
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/297_.jpg" alt="" /></a>
			<h4><a href="">诺基亚</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/295_.jpg" alt="" />
			<h4><a href="">摩托罗拉</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/143_.jpg" alt="" />
			<h4><a href="">LG</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/33080_.jpg" alt="" />
			<h4><a href="">HTC</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/544_.jpg" alt="" />
			<h4><a href="">Apple（苹果）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/1069_.jpg" alt="" />
			<h4><a href="">索尼移动</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/642_.jpg" alt="" /></a>
			<h4><a href="">中兴</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1795_.jpg" alt="" /></a>
			<h4><a href="">步步高</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/300_.jpg" alt="" /></a>
			<h4><a href="">夏普</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1763_.jpg" alt="" /></a>
			<h4><a href="">联想</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/613_.jpg" alt="" /></a>
			<h4><a href="">华为</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1673_.jpg" alt="" /></a>
			<h4><a href="">OPPO</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1632_.jpg" alt="" /></a>
			<h4><a href="">金立</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1606_.jpg" alt="" /></a>
			<h4><a href="">酷派</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="images/pinpai/xiaomi.jpg" alt="" /></a>
			<h4><a href="">小米</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1434_.jpg" alt="" /></a>
			<h4><a href="">魅族</a></h4>
		</div>
			
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/297_.jpg" alt="" /></a>
			<h4><a href="">诺基亚</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/295_.jpg" alt="" />
			<h4><a href="">摩托罗拉</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/143_.jpg" alt="" />
			<h4><a href="">LG</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/33080_.jpg" alt="" />
			<h4><a href="">HTC</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/544_.jpg" alt="" />
			<h4><a href="">Apple（苹果）</a></h4>
		</div>
		<div class="tag_link">
			<img src="http://2.zol-img.com.cn/manu_photo/1069_.jpg" alt="" />
			<h4><a href="">索尼移动</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/642_.jpg" alt="" /></a>
			<h4><a href="">中兴</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1795_.jpg" alt="" /></a>
			<h4><a href="">步步高</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/300_.jpg" alt="" /></a>
			<h4><a href="">夏普</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1763_.jpg" alt="" /></a>
			<h4><a href="">联想</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/613_.jpg" alt="" /></a>
			<h4><a href="">华为</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1673_.jpg" alt="" /></a>
			<h4><a href="">OPPO就</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1632_.jpg" alt="" /></a>
			<h4><a href="">金立</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1606_.jpg" alt="" /></a>
			<h4><a href="">酷派</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="images/pinpai/xiaomi.jpg" alt="" /></a>
			<h4><a href="">小米</a></h4>
		</div>
		<div class="tag_link">
			<a href=""><img src="http://2.zol-img.com.cn/manu_photo/1434_.jpg" alt="" /></a>
			<h4><a href="">魅族</a></h4>
		</div> -->
		
		
	
	</div>
	
	
	
<!-- 	<div id='container' style="position: relative;">
	    重复的数据块
		<div class="ks-waterfall">
			<h4>诺基亚</h4>
		</div>
		<div class="ks-waterfall">
			<h4>诺基亚</h4>
		</div>
		<div class="ks-waterfall">
			<h4>诺基亚</h4>
		</div>
		<div class="ks-waterfall">
			<h4>诺基亚</h4>
		</div>
		
	    </div>
	    </div> -->
<!-- 	<script type="tpl" id="tpl">
		<div class="pin ks-waterfall" data-id="{{id}}">
			<a href="#" class="image">
				<img height="{{height}}" alt="{{title}}" src="http://farm{{farm}}.static.flickr.com/{{server}}/{{id}}_{{secret}}_m.jpg" />
			</a>
			<p class="description">{{title}}</p>
		</div>
	</script> -->
	
	
</div>

</div>
<script type="text/javascript">
KISSY.use("waterfall", function (S, Waterfall) {
    new Waterfall({
        container: "#container",    //节点容器
        minColCount: 2,             //最小列数
        colWidth: 190               //每列的宽度
    });
});
</script>
</body>
</html>