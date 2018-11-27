

var condition = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendMessage;
	this.getState = getStateOfChat;
  this.loadChat = loadChat;
}

//obtain current state of chat from JSON file
function getStateOfChat(){
	if(!condition){
		 condition = true;
		 $.ajax({
			   type: "POST",
			   url: "process.php",
			   data: {
			   			'function': 'getState',
						'file': file
						},
			   dataType: "json",

			   success: function(data){
				   state = data.state;
				   condition = false;
			   },
			});
	}
}

//Update the state of the chat with the new messages in JSON file
function updateChat(){
	 if(!condition){
		 condition = true;
	     $.ajax({
			   type: "POST",
			   url: "process.php",
			   data: {
			   			'function': 'update',
						'state': state,
						'file': file
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                        }
				   }
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   condition = false;
				   state = data.state;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

function loadChat(){


  if(!condition){
    condition = true;
      $.ajax({
        type: "POST",
        url: "process.php",
        data: {
             'function': 'update',
           'state': state,
           'file': file
           },
        dataType: "json",
        success: function(data){
          if(data.text){
           for (var i = 0; i < data.text.length; i++) {
                           $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                       }
          }
          document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
          condition = false;
          state = data.state;
        },
     });
  }
  else {
    setTimeout(updateChat, 1500);
  }
}
//Send new message by calling the update function to check the JSON for new entry
function sendMessage(message, nickname)
{
    updateChat();
     $.ajax({
		   type: "POST",
		   url: "process.php",
		   data: {
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat();
		   },
		});
}
