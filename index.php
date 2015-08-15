<!DOCTYPE html>
<!--<html manifest="cache.manifest">-->
<html>
	<head>
		<title>Page title</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="_frontEnd/themes/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" type="text/css" href="_frontEnd/themes/jquery.mobile-1.4.5.min.css" />
		<link rel="stylesheet" type="text/css" href="_frontEnd/themes/jquery.mobile.structure-1.4.5.min.css" />
		<link rel="stylesheet" type="text/css" href="_frontEnd/themes/themeCTSNet.min.css" />
		<link rel="stylesheet" type="text/css" href="_frontEnd/themes/custom.css" />
		<script type="text/javascript" src="_frontEnd/js/jquery/jquery-1.11.1.min.js" ></script>
<!-- 	-->	<script type="text/javascript" src="_frontEnd/js/jquery/jquery.mobile-1.4.5.min.js" ></script> 			<!-- -->
<!--	--	<script type="text/javascript" src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" ></script>	!-- -->
		<script type="text/javascript" src="_frontEnd/js/jquery/jquery.validate.min.js" ></script>
		<script type="text/javascript" src="_frontEnd/js/frontEndValidation.js"	></script>
		<script type="text/javascript" src="_frontEnd/js/frontEndScripts.js" ></script>
	</head>
	<body>
		<!-- CTSNet landing page -->
		<div data-role="page" id="pageLanding">
			<div data-role="header" data-position="fixed">
				<a href="#" class="ui-btn-left ui-icon-edit ui-btn-icon-right" id="refreshFeed">Refresh</a>
				<h1 class="pageTitle">CTSNet Home</h1>
				<a class="loginButton" href="#pageSignIN" class="ui-btn-right ui-icon-edit ui-btn-icon-right" >SignIn</a>
			</div><!-- /header -->

			<div role="main" class="ui-content my-page">
				<ul id="artical-listing-main" data-role="listview" data-filter="true" data-inset="false">

				</ul>
				<br>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<div data-role="navbar" id="articleMenu" >
					<ul id="articleMenuElements" class="ui-grid-a">
						<li></li>
				    	</ul>
			  	</div>

			  	<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->

		<!-- CTSNet Artical by category page -->
		<div data-role="page" id="pageByCategory">
			<div data-role="header" data-position="fixed">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 id="pageByCategoryTitle" class="pageTitle">Artical of X Category</h1>
				<a href="#pageSignIN" class="loginButton ui-btn-right ui-icon-edit ui-btn-icon-right">Sign In</a>
			</div><!-- /header -->

			<div role="main" class="ui-content my-page">
				<ul id="artical-listing" data-role="listview"  data-filter="true" data-inset="false">
				</ul>
				<br/>
			</div><!-- /content -->
			
			<div data-role="footer" data-position="fixed">
			  	<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->
		
		<!-- CTSNet Manage articales page -->
		<div data-role="page" id="pageManageArticles">
			<div data-role="header" data-position="fixed">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 id="pageByCategoryTitle" class="pageTitle">Manage your articales</h1>
				<a href="#pageSignIN" class="loginButton ui-btn-right ui-icon-edit ui-btn-icon-right">Sign In</a>
			</div><!-- /header -->

			<div role="main" class="ui-content my-page">
				<ul id="my-articales-listing" data-role="listview"  data-filter="true" data-inset="false" data-icon="false">
					<li><p><a class="deleteAction" href="#" >delete</a>&nbsp;<a class="editAction"href="#">edit</a>&nbsp;<b>some stuff</b></p></li>
					<li><p><a class="deleteAction" href="#" >delete</a>&nbsp;<a class="editAction"href="#">edit</a>&nbsp;<b>some stuff</b></p></li>
				</ul>

				<br/>
			</div><!-- /content -->
			
			<div data-role="footer" data-position="fixed">
			  	<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->
		
		<!-- CTSNet Artical page -->
		<div data-role="page" id="pageArticale">
		
			<div data-role="header" data-position="fixed">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 id="viewArticalTitleSum" class="pageTitle">Artical Viewing</h1>
				<a href="#pageSignIN" class="loginButton ui-btn-right ui-icon-edit ui-btn-icon-right">Sign In</a>
			</div><!-- /header -->

			<div role="main" class="ui-content" >
				<h3 id="viewArticalTitle" class="articalElement">Artical Title</h3>
				<div id="imgWarp" class="ui-body-inherit ui-corner-all">
					<img id="viewArticalSummaryImage" src="">
				</div>
				<p id="viewArticalHeader" class="articalElement">Artical Header</p>
				<p id="viewArticalBody" class="articalElement">Artical body artical body</p>
				<p id="viewArticalConclusion" class="articalElement">Artical conclusion artical conclusion</p>
				<p class="articalElement">
					<h4 id="viewArticalMetaData" class="articalElement">Writer,Creation date,Last modification date</h4>
					<p class="articalElement">See what other people think, 
					<a id="viewCommentLink" href="#pageComments"> Comments </a></p>
				</p>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
			
		</div><!-- /page -->

		<!-- CTSNet Artical editing page -->
		<div data-role="page" id="pageArticaleEdit">

			<div data-role="header">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 class="pageTitle" id="pageArticaleEditTitle">Post an article</h1>
				<a href="#pageSignIN" class="loginButton ui-btn-right ui-icon-edit ui-btn-icon-right">Sign In</a>
			</div><!-- /header -->

			<div role="main" class="ui-content">
				<form id="ctsNet_Artical_Edit" action="#" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
            				<div data-role="fieldcontainer">
						<label for="articalEditTitle">Artical Title:</label>
	                    			<input type="text" name="articalEditTitle" id="articalEditTitle" placeholder="Title"/>
	                    		</div>
	                    		<div data-role="fieldcontainer">
						<label for="articalEditSummary">Artical Summary:</label>
						<textarea class="custom_textArea" rows="4" name="articalEditSummary" id="articalEditSummary"></textarea>
					</div>
	                    		<div data-role="fieldcontainer">
	                    			<div id="image_preview" class="ui-body-inherit ui-corner-all">
							<img id="previewing" src="images/noimage.png"/>
						</div>
						<div id="message" class="ui-body-inherit">
						</div>
						<label for="articalEditImage">Artical Image:</label>
						<input type="file" id="articalEditImage" name="articalEditImage"/>
	                    		</div>
	                    		<div data-role="fieldcontainer">
						<label for="articalEditHeader">Artical Header:</label>
						<textarea class="custom_textArea" rows="6" name="articalEditHeader" id="articalEditHeader"></textarea>
					</div>
	                    		<div data-role="fieldcontainer">
						<label for="articalEditBody">Artical Body:</label>
						<textarea class="custom_textArea" rows="10" name="articalEditBody" id="articalEditBody"></textarea>
					</div>
	                    		<div data-role="fieldcontainer">
						<label for="articalEditConclusion">Artical Conclusion:</label>
						<textarea class="custom_textArea" rows="6" name="articalEditConclusion" id="articalEditConclusion"></textarea>
					</div>
					<div data-role="fieldcontainer">
						<label for="articalEditCategory">Choose Artical Category:</label>
						<select name="articalEditCategory" id="articalEditCategory" data-theme="b">
							<option value="0">Select  a category</option>
							<option value="1">News</option>
							<option value="2">Tech</option>
							<option value="3">Cars</option>
							<option value="4">Sports</option>
						</select>
					</div>
                    			<input type="submit" value="Post artical"/>
                		</form>
			</div><!-- /content -->
			
			<div data-role="footer" data-position="fixed">
				<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->

		<!-- CTSNet Comments page -->
		<div data-role="page" id="pageComments">

			<div data-role="header">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 id="pageCommentsTitle" class="pageTitle">Page Comment</h1>
				<a href="#pageSignIN" class="loginButton ui-btn-right ui-icon-edit ui-btn-icon-right">Sign In</a>
			</div><!-- /header -->

			<div role="main" class="ui-content">
				<p class="articalElement">Have something to share? <a id="postCommentLink" href="#pageCommentEdit">Post a comment</a> </p>
				<br>
				<ul id="comments-listing" data-role="listview" data-inset="false" data-theme="a">
				
				</ul>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->
		
		<!-- CTSNet Comment Edit page -->
		<div data-role="page" id="pageCommentEdit">

			<div data-role="header">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 id="commentEditHeader" class="pageTitle">Write new comment</h1>
				<a href="#pageSignIN" class="loginButton ui-btn-right ui-icon-edit ui-btn-icon-right">Sign In</a>
			</div><!-- /header -->

			<div role="main" class="ui-content">
				<form id="ctsNet_Comment_Edit" action="#" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
                    			<div data-role="fieldcontainer">
						<label for="commentEditText">Comment Body:</label>
						<textarea class="custom_textArea" rows="10" name="commentEditText" id="commentEditText"></textarea>
					</div>
                    			<input type="submit" value="Post comment"/>
                		</form>
                		<p>Do not have an account? <a id="signInLink" href="#pageSignUP" data-transition="flip">Create one today!</a></p>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->

		<!-- CTSNet sign in page -->
		<div data-role="page" id="pageSignIN">

			<div data-role="header">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 class="pageTitle">Welcome back</h1>
			</div><!-- /header -->

			<div role="main" class="ui-content">
				<form id="ctsNet_login" action="#" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
            				<div data-role="fieldcontainer">
						<label for="signinEmail">E-mail:</label>
	                    			<input type="email" name="signinEmail" id="signinEmail" placeholder="john.appleseed@cts.com"/>
	                    		</div>
            				<div data-role="fieldcontainer">
	                    			<label for="signinPassword">Password:</label>
	                    			<input type="password" name="signinPassword" id="signinPassword"/>
	                    		</div>
            				<div data-role="fieldcontainer">
                        			<input type="checkbox" name="signinRememberPassword" id="signinRememberPassword"/>
                       				<label for="signinRememberPassword"> Remember my Password </label>
					</div>
                    			<input type="submit" value="SIGN IN"/>
                		</form>
                		<p>Do not have an account? <a id="signInLink" href="#pageSignUP" data-transition="flip">Create one today!</a></p>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->

		<!-- CTSNet signup page -->
		<div data-role="page" id="pageSignUP">

			<div data-role="header">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 class="pageTitle">Signup to CTSNet</h1>
				<a href="#pageSignIN" class="loginButton ui-btn-right ui-icon-edit ui-btn-icon-right">Sign In</a>
			</div><!-- /header -->

			<div role="main" class="ui-content">
				<form id="ctsNet_register" action="#" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
					<div data-role="fieldcontainer">
						<label for="signupNameFirst">First Name</label>
		                    		<input type="text" name="signupNameFirst" id="signupNameFirst" placeholder="John" />
		                    	</div>
            				<div data-role="fieldcontainer">
		                   		<label for="signupNameLast">Last Name</label>
		                    		<input type="text" name="signupNameLast" id="signupNameLast" placeholder="Appleseed" />
		                    	</div>
            				<div data-role="fieldcontainer">
		                    		<label for="signupEmail">E-mail:</label>
		                    		<input type="email" name="signupEmail" id="signupEmail" placeholder="john.appleseed@cts.com" />
		                    	</div>
            				<div data-role="fieldcontainer">
			                    	<label for="signupPassword">Password:</label>
			                    	<input type="password" name="signupPassword" id="signupPassword" />
		                    	</div>
            				<div data-role="fieldcontainer">
		        	            	<label for="signupPasswordConfirm">Password:</label>
		                	    	<input type="password" name="signupPasswordConfirm" id="signupPasswordConfirm" />
		                    	</div>
					<div data-role="fieldcontainer">
		                    		<fieldset data-role="controlgroup">
	                        			<label for="signupAgreecheck"> I agree to the terms of use</label>
	                        			<input type="checkbox" name="signupAgreecheck" id="signupAgreecheck" />
	                    			</fieldset>
	                    		</div>
                    			<input type="submit" value="Register" />
                    			<p><a href="#pageTermsOfUse" data-transition="flip">Terms of use</a></p>
                		</form>
			</div><!-- /content -->
			
			<div data-role="footer" data-position="fixed">
				<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->
		
		<!-- CTSNet mailConfirm page -->
		<div data-role="page" id="pageMailConfirm">
			<div data-role="header" data-position="fixed">
				<h1 class="pageTitle">Welcome to CTSNet</h1>
			</div><!-- /header -->

			<div role="main" class="ui-content my-page">
				<div class="mailMessage" id="mailConfirmSuccess">
					<p>Thank you for confirming your registration</p>
				</div>
				<div class="mailMessage" id="mailConfirmDone">
					<p>You have already confirmed your registration!</p>
				</div>
				<div class="mailMessage" id="mailConfirmFailed">
					<p>Could not confirm your registration, please register again</p>
				</div>
				<p><a href="index.html" rel="external">Back to CTSNet</a></p>
			</div><!-- /content -->
			
			<div data-role="footer" data-position="fixed">
			  	<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->
		
		<!-- CTSNet Terms of use page -->
		<div data-role="page" id="pageTermsOfUse">

			<div data-role="header">
				<a href="#" class="ui-btn-left" data-rel="back" data-icon="back">Back</a>
				<h1 class="pageTitle">Terms of use</h1>
			</div><!-- /header -->

			<div role="main" class="ui-content">
			
				<h2>The MIT License (MIT)</h2>
				<p>
				Permission is hereby granted, free of charge, to any person obtaining a copy
				of this software and associated documentation files (the "Software"), to deal
				in the Software without restriction, including without limitation the rights
				to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
				copies of the Software, and to permit persons to whom the Software is
				furnished to do so, subject to the following conditions:
				</p><p>
				The above copyright notice and this permission notice shall be included in all
				copies or substantial portions of the Software.
				</p><p>
				THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
				IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
				FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
				AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
				LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
				OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
				SOFTWARE.</p>
				
				<p><a href="#" data-rel="back">Back</a></p>
			</div><!-- /content -->
			
			<div data-role="footer" data-position="fixed">
				<h4>CTSNet. Copyright &copy; 2015 Arkadi Yoskovitz &amp; Amir Brot All rights reserved</h4>
			</div><!-- /footer -->
		</div><!-- /page -->
	</body>
</html>