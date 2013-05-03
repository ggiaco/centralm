$j(function(){
	//Homepage Banner	
	$j(".bannerNav li").mouseenter(function(){
		//Remove active, add active state to selected li
		$j(".bannerNav li a").removeClass("active");
		$j(this).find("a").addClass("active");		
		
		var cName = $j(this).attr("class");					
		$j(".bannerWrapper li").hide().removeClass("active");
			$j(".bannerWrapper li."+cName).fadeIn();		
	});
});

$j(function(){
	//Show/Hide Featured
	$j("a.hide").click(function(){
		var hClass = $j(this).hasClass("hide");
		if(hClass){
			$j(this).removeClass("hide");
			$j("ul.featuredCat").slideUp();
				$j(".pager").css("marginTop","15px");
		}else{
			$j(this).addClass("hide");
			$j("ul.featuredCat").slideDown();		
			$j(".pager").css("marginTop","0");	
		}
	});		
});

$j(function(){
	//Show all categories
	$j("li.topLi").mouseenter(function(){
		$j("li.topLi > ul").stop(true,true).slideDown('fast');
	}).mouseleave(function(){
		$j("li.topLi > ul").stop(true,true).slideUp('fast');
	});		
});

$j(function(){
	//Product View Tabs	
	$j(".box-collateral").hide().first().addClass("active").show();
		
	$j("ul.pTabs li a").click(function(){
		$j("ul.pTabs li a").removeClass("active");
		
		var tab = $j(this).attr("class");
		$j(this).addClass("active");
		
		$j(".box-collateral").hide();		
		$j("."+tab).show();		
	});
});

$j(function(){
	// Product View "Be the first to review
	$j('a.reviewForm').click(function(){
		$j("ul.pTabs li a").removeClass("active");
			$j(".box-reviews").addClass("active");
		$j(".box-collateral").hide();
			$j("#customer-reviews").show();		
	});
});



$j(function(){
	//Fancybox Main Image	
	if($j("a.zoom").length > 0){
	$j("a.zoom").fancybox({
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic'
	});	
	//Fancybox More Views Gallery
	$j("a[rel=gallery]").fancybox({
		'transitionIn'		: 'elastic',
		'transitionOut'		: 'elastic',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});
	}
});
