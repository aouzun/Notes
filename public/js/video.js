
function addField(){

	div0 = document.createElement('div');
	div0.setAttribute('class','form-group');


	div1 = document.createElement('div');
	div1.setAttribute('class','col-md-10');
	inp1 = document.createElement('input');
	inp1.setAttribute('class','form-control');
	inp1.setAttribute('type','text');
	inp1.setAttribute('name','link[]');
	inp1.setAttribute('required','required');
	div1.appendChild(inp1);



/*
	div2 = document.createElement('div');
	div2.setAttribute('class','col-md-5');
	inp2 = document.createElement('input');
	inp2.setAttribute('class','form-control');
	inp2.setAttribute('type','text');
	inp2.setAttribute('name','title');

	div2.appendChild(inp2);
*/

	div3 = document.createElement('div');
	div3.setAttribute('class','col-md-1');
	
	/*inp = document.createElement('input');
	inp.setAttribute('type','button');
	inp.setAttribute('onclick','deleteField();');

	div3.appendChild(inp)*/

	$('.videos').append(div0,div1,div3);

}



function validate_url(){
	var links = document.getElementsByName('link[]');

	var flag = true;

	links.forEach(function(item,index){
		var ret_val = validateYouTubeUrl(item.value);
		if(ret_val == false){
			flag = false;
			return;
		}
	});
	if(!flag){
		window.alert('invalid links');
	}
	return flag;
}


function validateYouTubeUrl(url) {
    if (url != undefined || url != '') {        
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length == 11) {
			//$('#videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=1&enablejsapi=1');
			return true;
        } else {
            return false;
        }
    }
    return false;
}

