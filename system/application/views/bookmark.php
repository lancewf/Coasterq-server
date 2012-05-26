		<script type="text/javascript">
	      var api_key = "afec23131772cced4d65e080a2f8a22b";
	      var canvas_page = escape("http://apps.facebook.com/coasterq/bookmark/");
	      var session = null;
	      var canvas = false;
	      
	      // Called shortly after page loads, after FB.Facebook.init
	      function init() {
	        session = FB.Facebook.apiClient.get_session();
	        canvas = FB.Facebook.get_isInCanvas();
	        updateBookmarkPrompt();
	        // If the user was redirected to a login page after clicking
	        // the bookmark button, automatically prompt them on return
	        if (window.location.search.indexOf('addBookmark') >= 0) {
	          addBookmark();
	        }
	      }
	    
	      // Called when user clicks the 'Add Bookmark' button. Redirect to
	      // login first if user is in an iframe app but hasn't authorized
	      // the app yet.
	      function addBookmark() {
	        // In an iframe, but we don't have a session yet. Redirect
	        // to login page and open bookmark dialog upon return.
	        if (canvas && !session) {
	          redirect = 'http://www.facebook.com/login.php?api_key=' + api_key
	                                    + '&extern=1&fbconnect=1&v=1.0'
	                                    + '&next=' + canvas_page + escape("?addBookmark")
	                                    + '&cancel_url=' + canvas_page;
	          self.parent.location = redirect;
	        }
	        
	        // If the user is in a connect page or has a session already
	        // in an iframe app, show the bookmark dialog with javascript.
	        // If user is on a connect page, this call will open an
	        // iframe to prompt a login first if necessary.
	        else {
	          FB.Connect.showBookmarkDialog(updateBookmarkPrompt);
	        }
	      }
	      
	      // Replace the 'Add Bookmark' button with thank-you text if we
	      // see the user has already bookmarked the app
	      function updateBookmarkPrompt() {
	        if (session != null) {
	          FB.Facebook.apiClient.fql_query("SELECT bookmarked FROM permissions WHERE uid=" + session.uid,
	            function(rows) {
	              if (rows[0].bookmarked == 1) {
	                document.getElementById("bookmark").innerHTML = "<p style='font-size: 10pt;'>Thanks for bookmarking this app.</p>";
	              }
	            }
	          );
	        }
	      }
	    </script>
