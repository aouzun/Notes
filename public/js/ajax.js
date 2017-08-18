function sendFollowRequest(user_id,choice,id){
	if(user_id > 0){
		$.ajax({
			type : 'POST',
			url : '/follow',
			data : {'user_id' : user_id,'_token' : $("#token").val(),'choice' : choice, 'id' : id},
			success : function(response){

				var string = $('#followbutton').html();
				console.log(string);
				$('#followbutton').html(string === 'Follow' ? 'Unfollow' : 'Follow');
			},
			error: (error) => {console.log(JSON.stringify(error)); }
		});
	}
	
}