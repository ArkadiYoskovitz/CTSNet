// ===================================================
// Article view by ID - GET data function
// ===================================================
function loadArticleView(articleID) {
	$.ajax({
		url	: 'http://appctsnet.info/api/article/'+ articleID,
	        type	: 'GET',
	        dataType: 'json',
	        async	: true,
	        success	: function (result) {
	        	articleView.parseJSONP(result);
		},
	        error	: function (request,error) {
	        	alert('Network error has occurred please try again!');
		}
	});
};
// ===================================================
// Article view by ID - Parser 
// ===================================================
var articleView = {  
    parseJSONP:function(result){  
    	var article = result['data']['article'];
    	var metaDataString = '';
	metaDataString += 'Writer		: ' + article['userNameLast'	  	] + ' ' + article['userNameFirst'] + '<br>';
	metaDataString += 'Last modification 	: ' + article['date_last_modification'	] + '<br>';
    	$('#viewArticalTitleSum').text(article['title']);
    	$('#viewArticalTitle'	).text(article['title']);
    	$('#viewArticalMetaData').html(metaDataString);
	if(article['image_path']) {
    		$('#viewArticalSummaryImage').attr("src",article['image_path']);
    	} else {
    	    	$('#viewArticalSummaryImage').attr("src","images/noimage.png");
    	}
	$('#viewArticalHeader'	).text(article['header']);
    	$('#viewArticalBody'	).text(article['body']);
    	$('#viewArticalConclusion').text(article['conclusion']);    	    	    	    	    	
    }
}
// ===================================================
// Load Article edit view by ID - GET data function
// ===================================================
function loadArticleForm(articleID) {
	$.ajax({
		url	: 'http://appctsnet.info/api/article/'+ articleID,
	        type	: 'GET',
	        dataType: 'json',
	        async	: true,
	        success	: function (result) {
	        	articleViewEdit.parseJSONP(result);
		},
	        error	: function (request,error) {
	        	alert('Network error has occurred please try again!');
		}
	});
};
// ===================================================
// Load Article edit view by ID - Parser 
// ===================================================
var articleViewEdit = {  
    parseJSONP:function(result){  
    	var article = result['data']['article'];
	
	$('#articalEditTitle').val( article['title'] );
	$('#articalEditSummary').val( article['summary'] );
	$('#previewing').attr('src', 'images/noimage.png');
	$('#articalEditImage').val('');
	$('#articalEditHeader').val( article['header'] );
	$('#articalEditBody').val( article['body']);
	$('#articalEditConclusion').val( article['conclusion'] );
	$('#articalEditCategory').val( article['category'] );
    }
}