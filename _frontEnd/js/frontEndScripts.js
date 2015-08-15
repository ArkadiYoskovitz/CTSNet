// ===================================================
// Helper Functions - Date formatter
// ===================================================
function stringToDate(dateString) {
	var date = new Date(dateString.replace(/-/g,"/"));
	if (!isNaN(date) && isFinite(date) ) {
		return date.getDate() + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear();
	} else {
		return '';
	}
};
function stringToTime(dateString) {
	var date = new Date(dateString.replace(/-/g,"/"));
	if (!isNaN(date) && isFinite(date) ) {
		return date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
	} else {
		return '';
	}
};
function curentTimeString() {
	var dt = new Date();
	var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	return time;
};
// ===================================================
// Helper Functions - Clear form
// ===================================================
function clearArticleForm() {
	$('#articalEditTitle').val('');
	$('#articalEditSummary').val('');
	$('#previewing').attr('src', 'images/noimage.png');
	$('#articalEditImage').val('');
	$('#articalEditHeader').val('');
	$('#articalEditBody').val('');
	$('#articalEditConclusion').val('');
	$('#articalEditCategory').val('');
};
// ===================================================
// Helper Functions - urlHistory
// ===================================================
var urlHistory = {
    // Array of pages that are visited during a single page load.
    // Each has a url and optional transition, title, and pageUrl
    // (which represents the file path, in cases where URL is obscured, such as dialogs)
    stack: [],
    // maintain an index number for the active page in the stack
    activeIndex: 0,
    // get active
    getActive: function () {
        return urlHistory.stack[urlHistory.activeIndex];
    },
    getPrev: function () {
        return urlHistory.stack[urlHistory.activeIndex - 1];
    },
    getNext: function () {
        return urlHistory.stack[urlHistory.activeIndex + 1];
    },
    // addNew is used whenever a new page is added
    addNew: function (url, transition, title, pageUrl, role) {
        // if theres forward history, wipe it
        if (urlHistory.getNext()) {
            urlHistory.clearForward();
        }
        urlHistory.stack.push({
            url: url,
            transition: transition,
            title: title,
            pageUrl: pageUrl,
            role: role
        });
        urlHistory.activeIndex = urlHistory.stack.length - 1;
    },
    //wipe urls ahead of active index
    clearForward: function () {
        urlHistory.stack = urlHistory.stack.slice(0, urlHistory.activeIndex + 1);
    }
};
// ===================================================
// Conditional events
// ===================================================
$(document).on('pageinit', function() {
	bindRefreshClickEvent();
	bindImageHide();
	bindInitSignInState();
	bindImagePreview();
});
// ===================================================
// Bind function
// ===================================================
function bindArticleViewTransitionEvent() {
	$('.articleTransition').bind( "click", function(e) {
		localStorage.setItem( 'useArticleID', e.currentTarget.hash.replace('#','') );
		$.mobile.pageContainer.pagecontainer("change", "#pageArticale");
	});
}
function bindCategoryViewTransitionEvent() {	
	$('.categoryTransition').bind( "click", function(e) {
		//useCategory = e.currentTarget.hash.replace('#','');
		localStorage.setItem( 'useCategory', e.currentTarget.hash.replace('#','') );
		$.mobile.pageContainer.pagecontainer("change", "#pageByCategory");
	});
}
function bindRefreshClickEvent() {
	$('#refreshFeed').bind( "click", function(event, ui) {
		refreshNews();
	});
}
function bindImageHide() {
	$("img").each(function(){
		(!this.src || $(this).prop("src")) && $(this).hide();
	});
}
function bindInitSignInState() {
	$('.loginButton').bind( "click", function(e) {
		if(e.currentTarget.hash === '') {
			e.preventDefault();
			localStorage.removeItem('user');
			var a = $('.loginButton');
			$.each(a,function( index, value ) {
				$(value).text('SignIn'); value.hash='pageSignIN';
			});
	    		$(':mobile-pagecontainer').pagecontainer('change', '#pageLanding', { reload: false });
		}
	});
}
function bindImagePreview() {
	$('#articalEditImage').bind( "change", function(e) {
		$("#message").empty();
		var file = this.files[0];
		var imageFileType = file.type;
		var match= ["image/jpeg","image/png","image/jpg"];
					
		if(match.indexOf(imageFileType) == -1) {
			$('#previewing').attr('src','images/noimage.png');
			$("#message").html("<p id='error'>Please Select A valid Image File <span id='error_message'>"+
					   "<b>Note:&nbsp;</b>Only jpeg, jpg and png Images type allowed</span></p>");
			return false;
		} else {
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
		}
	});

	function imageIsLoaded(e) {
		$("#file").css("color","green");
		$('#previewing').attr('src', e.target.result);
		$('#previewing').attr('width', '250px');
		$('#previewing').attr('height', '250px');
	};
}
// Manage
function bindArticlesManageDeleteEvent() {
	$('.articleDelete').bind( "click", function(e) {
		localStorage.setItem( 'useArticleID', e.currentTarget.hash.replace('#','') );
	
		// call delete on server and reload page
		$.ajax({
			url	: 'http://appctsnet.info/api/article/'+ localStorage.getItem('useArticleID'),
			type	: 'DELETE',
			cache	: false,	
			contentType : false,
			processData : false,
			success: function(data, textStatus, jqXHR) {
				localStorage.removeItem( 'useArticleID' );
				loadArticlesForUser( localStorage.getItem('user') );
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('delete failed');
				document.title='error'; 
			}
		});
	});
}
function bindArticlesManageEditEvent() {
	$('.articleEdit').bind( "click", function(e) {
		localStorage.setItem( 'useArticleID', e.currentTarget.hash.replace('#','') );
		$.mobile.pageContainer.pagecontainer("change", "#pageArticaleEdit");
	});
}

// ===================================================
// Bind events
// ===================================================
$(document).bind( "pagebeforeshow" , function(event,ui){ 
	var targetPage = ui.toPage[0].id;
	
	if((targetPage !== null) && (targetPage === 'pageLanding')) {
		refreshNews(); 
		localStorage.removeItem('useArticleID')
	}
	if((targetPage !== null) && (targetPage === 'pageByCategory')) {
		if((localStorage.getItem('useCategory') !== null) && (localStorage.getItem('useCategory') !== undefined)) {
			loadArticlesForCategory( localStorage.getItem('useCategory') );
		}
	}
	if((targetPage !== null) && (targetPage === 'pageManageArticles')) {
		if((localStorage.getItem('user') !== null) && (localStorage.getItem('user') !== undefined)) {
			loadArticlesForUser( localStorage.getItem('user') );
		}
	}
	if((targetPage !== null) && (targetPage === 'pageArticale')) {
		if((localStorage.getItem('useArticleID') !== null) && (localStorage.getItem('useArticleID') !== undefined)) {
			loadArticleView( localStorage.getItem('useArticleID') );
		}
	}
	if((targetPage !== null) && (targetPage === 'pageComments')) {
		if((localStorage.getItem('useArticleID') !== null) && (localStorage.getItem('useArticleID') !== undefined)) {
			loadCommentsViewByArticleID( localStorage.getItem('useArticleID') );
		}
	}
	if((targetPage !== null) && (targetPage === 'pageArticaleEdit')) {
		if((localStorage.getItem('user') !== null) && (localStorage.getItem('user') !== undefined)) {
			if((localStorage.getItem('useArticleID') !== null) && (localStorage.getItem('useArticleID') !== undefined)) {
				// edit an article
				console.log('EDIT AN ARTICLE');
				// load article into form
				loadArticleForm( localStorage.getItem('useArticleID') );
			} else {
				// write an article
				console.log('WRITE AN ARTICLE');
				// clear article into form
				clearArticleForm();
			}
		} else {
			$(':mobile-pagecontainer').pagecontainer('change', '#pageLanding', { reload: false });
		}
	}
	if((targetPage !== null) && (targetPage === 'pageMailConfirm')) {
/*		if((localStorage.getItem('user') !== null) && (localStorage.getItem('user') !== undefined)) {
			// call server and update UI;
			$.mobile.loading( "show" );
			$.ajax({
				url	: 'http://appctsnet.info/api/user/'+localStorage.getItem('user'),
			        type	: 'GET',
			        dataType: 'json',
			        async	: true,
			        success	: function (result) {
					//siteNewsSummary.parseJSONP(result);
					console.log(result);
			        	$.mobile.loading( "hide" );
				},
			        error	: function (request,error) {
			        	alert('Network error has occurred please try again!');
			        	$.mobile.loading( "hide" );
				}
			});
		}*/
	}
	if((targetPage !== null) && (localStorage.getItem('user') !== undefined) && (localStorage.getItem('user') !== null)) {
		var a = $('.loginButton');
		$.each(a,function( index, value ) {
			$(value).text('Sign Out'); value.hash='#';
		});
		$('#articleMenu').empty();
		$("#articleMenu").append('<ul id="articleMenuElements" class="ui-grid-a"></ul>');
		$("#articleMenuElements").append('<li class="ui-block-b">'+
						 '<a class="ui-link ui-btn" href="#pageManageArticles">Manage your articales</a></li>');
		$('#articleMenuElements').append('<li class="ui-block-b">'+
						 '<a class="ui-link ui-btn" href="#pageArticaleEdit">Post an articale</a></li>');
	    	$('#articleMenu').navbar();
	} else {
		var a = $('.loginButton');
		$.each(a,function( index, value ) {
			$(value).text('SignIn'); value.hash='pageSignIN';
		});
		$('#articleMenu').empty();
		$("#articleMenu").append('<ul id="articleMenuElements" class="ui-grid-a"></ul>');
		$('#articleMenuElements').append('<li></li>')
	    	$('#articleMenu').navbar();
	}
});
// ===================================================
/*
$(document).bind( "pagebeforeshow" , function(event,ui){
    console.log('AAAA');
    console.log($.mobile.urlHistory.stack);
});
***************************************************************************
$(document).on('pagechange', 'div:jqmData(role="page")', function(){
    console.log('BBBB');
    console.log($.mobile.urlHistory.stack);
});
*/