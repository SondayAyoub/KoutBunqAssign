/*************************************************
*         JS file { JQuery }                     *
*         using AJAX to send Requests            *
*************************************************/

      var kout = {}

      /** 
       * Send POST request to fetch for all messages.
       */
      kout.fetchConversation = function (){
         var old_scrollHeight = $("#chatContainer").prop("scrollHeight") - 20; //Get the scroll height
         $.ajax({
            url: 'webService/koutHandler.php',
            type: 'post',
            data: { method: 'getMessages' },
            success: function(response){
               $('#chatContainer').html(response); /*Insert the returned data (messages) in chatContainer div*/

               //Auto scroll
               var new_scrollHeight = $("#chatContainer").prop("scrollHeight") - 20;
               if(new_scrollHeight > old_scrollHeight){
                  $("#chatContainer").animate({scrollTop: new_scrollHeight}, "normal"); /* Scroll down to the bottm of the chatContainer div */
               }
            }
         });
      }

      /** 
       * Insert the message sent.
       */
      kout.insertMessage = function(message){
         if ($.trim(message).length != 0) {
            var old_scrollHeight = $("#chatContainer").attr("scrollHeight") - 20; //Get the scroll height
            $.ajax({
            url: 'webService/koutHandler.php',
            type: 'post',
            data: { method: 'insertMessage', message: message },
            success: function(response){
               //Fetch for all new messages added.
               kout.fetchConversation();
               kout.messageToSend.val('');
            }
         });
         }
      }

      /** 
       * simple authentication system.
       */
      kout.signIn = function(username){
         if (username.length != 0) {
            $.ajax({
               url: 'webService/koutHandler.php',
               type: 'POST',
               data: { method: 'signIn',  username: username },
               success: function(response){
                  console.log('Success!');
                  /* call the fetch function after successfully logged in. */
                  kout.fetchConversation();
               }
            });
         }
      }

      /** 
       * Bind a function when user hit the Return button
       * to send a message instead of returning to a new line
       */
      kout.messageToSend = $('#msgToSend');
      kout.messageToSend.bind('keydown', function(event){
         if (event.keyCode === 13 && event.shiftKey === false) {
            /* Call the insert service. */
            kout.insertMessage($(this).val());
            event.preventDefault();
         }
      });

      /** 
       * Submit the login form
       */
      $("#loginForm").submit(function(event){
         $username = $('#username').val();
         kout.signIn($username);
      });

      /** 
       * Logout after getting confirmation from the user
       */
      $("#signout").click(function(){
         var signout = confirm("Are you done talking ?");
         if(signout == true)
            {
               window.location = 'index.php?logout=true';
            }     
      });

      kout.interval = setInterval(kout.fetchConversation, 5000); // Set an interval timer to reload chat messages every 6000ms
      kout.fetchConversation();