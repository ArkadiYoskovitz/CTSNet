// ===================================================
// Helper functions
// ===================================================
function json_encode (form) {
	var jsonObj = {}; 
	$.each($(form).serializeArray(), function() {
		jsonObj[this.name] = this.value;
	})	
	return JSON.stringify(jsonObj);
};
// ===================================================
// Bind events
// ===================================================
$(document).on('pageinit', function() {
	event_ctsNet_Artical_Edit();
	event_ctsNet_Comment_Edit();
	event_ctsNet_register();
	event_ctsNet_login();
});
// ===================================================
// Event Handler - ctsNet_Artical_Edit
// ===================================================
function event_ctsNet_Artical_Edit() {
	$('#ctsNet_Artical_Edit').validate({
		rules: {
			articalEditTitle	: { required: true	},
			articalEditSummary	: { required: true	},
			articalEditHeader	: { required: true	},
			articalEditBody		: { required: true	},
			articalEditConclusion	: { required: true	},
			articalEditCategory	: { required: true	},
		},
		messages: {
			articalEditTitle	: { required: "You must enter a title."			},
			articalEditSummary	: { required: "You must enter a summary text."		},
			articalEditHeader	: { required: "You must enter a header text."		},
			articalEditBody		: { required: "You must enter a body text."		},
			articalEditConclusion	: { required: "You must enter a conclusion text."	},
			articalEditCategory	: { required: "You must select a category."		}
		},
		errorPlacement: function (error, element) {
			error.appendTo(element.parent().prev());
		},
		submitHandler: function (form) {
			var state = localStorage.getItem('useArticleID');
			console.log(state);
			if(!state) {
				console.log('NEW ARTICLE');
				articleHandlerNew();
			} else {
				console.log('UPDATE ARTICLE');			
				articleHandlerUpdate();
			}
			return false;
		}
	});
};
// ===================================================
// Event Handler - publish new article
// ===================================================
function articleHandlerNew() {
	var userinfo = jQuery.parseJSON( localStorage.getItem('user') );
	var userID = '' + userinfo['id'];
	var helper = '<input type="text" name="article_writer_id" id="article_writer_id">';
	
	$('#ctsNet_Artical_Edit').append(helper);
	$('#article_writer_id').val( userID );
	
	var fData = new FormData( $('#ctsNet_Artical_Edit')[0] );
	$('#article_writer_id').remove();
	
	$.ajax({
		url	: 'http://appctsnet.info/api/article',
		type	: 'POST',
		data	: fData ,
		cache	: false,	
		contentType : false,
		processData : false,
		success: function(data, textStatus, jqXHR) {
			clearArticleForm();
			$('#article_writer_id').remove();
			$(':mobile-pagecontainer').pagecontainer('change', '#pageLanding', { reload: false });
		},
		error: function(jqXHR, textStatus, errorThrown) {
			alert('upload failed');
			document.title='error'; 
		}
	});
};
// ===================================================
// Event Handler - update exsisting article
// ===================================================
function articleHandlerUpdate() {
	
	var userinfo = jQuery.parseJSON( localStorage.getItem('user') );
	var userID = '' + userinfo['id'];
	var helper = '<input type="text" name="article_writer_id" id="article_writer_id">';
	
	$('#ctsNet_Artical_Edit').append(helper);
	$('#article_writer_id').val( userID );
	
	var fData = new FormData( $('#ctsNet_Artical_Edit')[0] );
	$('#article_writer_id').remove();
	
	$.ajax({
		url	: 'http://appctsnet.info/api/article/'+ localStorage.getItem('useArticleID'),
		type	: 'POST',
		data	: fData ,
		cache	: false,	
		contentType : false,
		processData : false,
		success: function(data, textStatus, jqXHR) {
			clearArticleForm();
			$(':mobile-pagecontainer').pagecontainer('change', '#pageManageArticles', { reload: false });
		},
		error: function(jqXHR, textStatus, errorThrown) {
			alert('upload failed');
			document.title='error'; 
		}
	});
};
// ===================================================
// Event Handler - ctsNet_Comment_Edit
// ===================================================
function event_ctsNet_Comment_Edit() {
	$('#ctsNet_Comment_Edit').validate({
		rules: {
			commentEditText	: { required: true }
		},
		messages: {
			commentEditText	: { required: "You must enter a comment text."	},
		},
		errorPlacement: function (error, element) {
		        error.appendTo(element.parent().prev());
		},
		submitHandler: function (form) {
			var input = {};
			input['comment_content'] = $('#commentEditText').val();
			if( localStorage.getItem('user') ) {
				var userinfo = jQuery.parseJSON( localStorage.getItem('user') );
				input['comment_writer_id'] = userinfo['id'];
			} else {
				input['comment_writer_id'] = null;
			}

			// Call server to upload 		
			$.ajax({
				url	: 'http://appctsnet.info/api/article/'+ localStorage.getItem('useArticleID') + '/comment',
				type	: 'PUT',
    				data	: JSON.stringify(input),
       				dataType: 'json',
	                       	processData : false,
				contentType : 'multipart/form-data; charset=UTF-8',
				error	: function (){ 
					document.title='error'; 
					}, 
				success	: function (data) {
					$('#commentEditText').val('');
				        $(':mobile-pagecontainer').pagecontainer('change', '#pageComments', { reload: false });
					}
				});

			return false;
		}
	});
};
// ===================================================
// Event Handler - ctsNet_register
// ===================================================
function event_ctsNet_register() {
	$('#ctsNet_register').validate({
		rules: {
			signupNameFirst		: { required: true },
			signupNameLast		: { required: true },
			signupEmail		: { required: true },
			signupPassword		: { required: true },
			signupPasswordConfirm	: { required: true },
			signupAgreecheck	: { required: true }
		},
		messages: {
			signupNameFirst		: { required: "Please enter your first name." 	   },
			signupNameLast		: { required: "Please enter your last name."	   },
			signupEmail		: { required: "Please enter your email."	   },
			signupPassword		: { required: "Please enter your password."	   },
			signupPasswordConfirm	: { required: "Please confirm your password."	   },
			signupAgreecheck	: { required: "You must agree to the terms of use" },
		},
		errorPlacement: function (error, element) {
			error.appendTo(element.parent().prev());
		},
		submitHandler: function (form) {
			if( $('#signupPassword').val() !== $('#signupPasswordConfirm').val() ) {
				alert('There were some errors in your submission. Please correct and try again.');
			} else {
				// Call server to upload 		
				$.ajax({
					url	: 'http://appctsnet.info/api/user/register',
					type	: 'POST',
	    				data	: json_encode(form),
	    				dataType: 'json',
	                        	processData : false,
					contentType : 'multipart/form-data; charset=UTF-8',
					error	: function (){ 
						document.title='error'; 
						}, 
					success	: function (data) {
							alert('Please confirm registration via email');
							localStorage.setItem( 'user', JSON.stringify( data['data'] ) );
							$('#signupNameFirst').val('');
							$('#signupNameLast').val('');
							$('#signupEmail').val('');
							$('#signupPassword').val('');
							$('#signupPasswordConfirm').val('');
							$('#signupAgreecheck').toggle(this.checked);
							$(':mobile-pagecontainer').pagecontainer('change', '#pageLanding', { reload: false });
						}
				});
			}
			return false;
		}
	});
};
// ===================================================
// Event Handler - ctsNet_login
// ===================================================
function event_ctsNet_login() {
	$('#ctsNet_login').validate({
		rules: {
			signinEmail		: { required: true },
			signinPassword		: { required: true }
		},
		messages: {
			signinEmail		: { required: "Please enter your email."	},
			signinPassword		: { required: "Please enter your password."	}
		},
		errorPlacement: function (error, element) {
			error.appendTo(element.parent().prev());
		},
		submitHandler: function (form) {

			// Call server to upload 		
			$.ajax({
				url	: 'http://appctsnet.info/api/user/login',
				type	: 'POST',
    				data	: json_encode(form),
    				dataType: 'json',
                        	processData : false,
				contentType : 'multipart/form-data; charset=UTF-8',
				error	: function (){ 
					document.title='error'; 
					}, 
				success	: function (data) {
						if (data['code'] == 404) {
							alert('Please registr again');
						} else if (data['code'] != 200) {
							alert('Please confirm registration via email');
						} else if ((data['data'] !== null) && (data['data'] !== undefined)) {
							// Save to local storage
							localStorage.setItem( 'user', JSON.stringify(data['data']) );
							$('#signinEmail').val('');
							$('#signinPassword').val('');
							$(':mobile-pagecontainer').pagecontainer('change', '#pageLanding', { reload: false });
						} else {
							alert('There were some errors in your submission. Please correct and try again.');
						}
					}
			});
			return false;
		}
	});
};