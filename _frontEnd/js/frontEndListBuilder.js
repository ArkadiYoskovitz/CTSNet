// ===================================================
// Refresh news feed - GET data function
// ===================================================
function refreshNews() {
	$.mobile.loading( "show" );
	$.ajax({
		url	: 'http://appctsnet.info/api/article/news',
	        type	: 'GET',
	        dataType: 'json',
	        async	: true,
	        success	: function (result) {
			siteNewsSummary.parseJSONP(result);
	        	$.mobile.loading( "hide" );
		},
	        error	: function (request,error) {
	        	alert('Network error has occurred please try again!');
	        	$.mobile.loading( "hide" );
		}
	});
};
// ===================================================
// Refresh news feed - Parser 
// ===================================================
var siteNewsSummary = {  
    parseJSONP:function(result){  
    	var data = result['data']
        $('#artical-listing-main').empty();        
        $.each(data, function(i, section) {
		$('#artical-listing-main').append(
		'<li data-role="list-divider" data-theme="b" class="customListDividor"><a class="categoryTransition" href="#'+i+'">'+i+'</a></li>');
	        $.each(section, function(i, row) {
		        var srclink;
		        if(!row['image_path']) {
		        	 srclink="images/noimage.png";
		        } else {
		        	 srclink = row['image_path'];
		        }
			$('#artical-listing-main').append(
			'<li><a class="articleTransition" href="#'+row['id']+'"><img src="'+srclink+'" class="ui-li-thumb"><h2>' + row['title'] + 
			'</h2><p>' + row['summary'] + '</p><p class="ui-li-aside">'+ stringToDate(row['date_last_modification']) +'</p></a></li>');
	        });
	});
        $('#artical-listing-main').listview('refresh');
        bindArticleViewTransitionEvent();
        bindCategoryViewTransitionEvent();
    }
}
// ===================================================
// Articles by categoryID - GET data function
// ===================================================
function loadArticlesForCategory(categoryID) {
	$.ajax({
		url	: 'http://appctsnet.info/api/article/search?category='+ categoryID,
	        type	: 'GET',
	        dataType: 'json',
	        async	: true,
	        success	: function (result) {
	        	categoryView.parseJSONP(result);
		},
	        error	: function (request,error) {
	        	alert('Network error has occurred please try again!');
		}
	});
};
// ===================================================
// Articles by categoryID - Parser 
// ===================================================
var categoryView = {  
    parseJSONP:function(result){  
    	var data = result['data'];
    	var articles = data['article'];
        $('#artical-listing').empty();        
        $.each(data, function(i, section) {
		$('#artical-listing').append(
			'<li data-role="list-divider" data-theme="b" class="customListDividor">'+localStorage.getItem('useCategory')+'</li>');
	        $.each(section, function(i, row) {
	        	var srclink = (!row['image_path']) ? "images/noimage.png" : row['image_path'];
			$('#artical-listing').append(
			'<li><a class="articleTransition" href="#'+row['id']+'"><img src="'+srclink+'" class="ui-li-thumb"><h2>' + row['title'] + 
			'</h2><p>' + row['summary'] + '</p><p class="ui-li-aside">'+ stringToDate(row['date_last_modification']) +'</p></a></li>');
	        });
	});
        $('#artical-listing').listview('refresh');
        $('#pageByCategoryTitle').text( localStorage.getItem('useCategory') );
        bindArticleViewTransitionEvent();
    }
}
// ==============================================================
// Comments view for Article - by Article ID - GET data function
// ==============================================================
function loadCommentsViewByArticleID(articleID) {
	$.ajax({
		url	: 'http://appctsnet.info/api/article/'+ articleID + '/comments',
	        type	: 'GET',
	        dataType: 'json',
	        async	: true,
	        success	: function (result) {
	        	commentsView.parseJSONP(result);
		},
	        error	: function (request,error) {
	        	alert('Network error has occurred please try again!');
		}
	});
};
// ===================================================
// Comments view for Article - by Article ID - Parser 
// ===================================================
var commentsView = {
    parseJSONP:function(result) {
    	var comments = result['data']['comments'];
    	var avatar;
    	$('#comments-listing').empty();
    	$.each(comments, function(index, comment) {
		avatar = comment['userNameLast'] + ' ' + comment['userNameFirst'];
		$('#comments-listing').append(
			'<li data-icon="false"><p class="comment"><b class="avatar">'+avatar+'</b>&nbsp;said => ' + 
			comment['comment_content'] + '&nbsp;</p></li>');
    	});
    	$('#comments-listing').listview('refresh');
    	$('#pageCommentsTitle').text(  comments[0]['article_title'] );
    }
}
// ===================================================
// Articles For User - GET data function
// ===================================================
function loadArticlesForUser(user) {
	var userinfo = jQuery.parseJSON( user );
	var userID = '' + userinfo['id'];

	$.ajax({
		url	: 'http://appctsnet.info/api/article/search?user_id='+ userID,
	        type	: 'GET',
	        dataType: 'json',
	        async	: true,
	        success	: function (result) {
	        	manageArticlesView.parseJSONP(result);
		},
	        error	: function (request,error) {
	        	alert('Network error has occurred please try again!');
		}
	});
};
// ===================================================
// Articles For User - Parser 
// ===================================================
var manageArticlesView = {  
    parseJSONP:function(result){  
    	var data = result['data'];
    	var articles = data['article'];
        $('#my-articales-listing').empty();        
        $.each(articles, function(i, row) {
		$('#my-articales-listing').append('<li><p><a class="articleDelete" href="#'+row['id']+
				'">Delete</a>&nbsp;<a class="articleEdit" href="#'+row['id']+'">Edit</a>&nbsp;<b>' + row['title'] + '</b></p></li>');
	});
        $('#my-articales-listing').listview('refresh');
        bindArticlesManageDeleteEvent();
	bindArticlesManageEditEvent();
    }
}