function addField(){

	div0 = document.createElement('div');
	div0.setAttribute('class','form-group');


	div1 = document.createElement('div');
	div1.setAttribute('class','col-md-10');
	inp1 = document.createElement('input');
	inp1.setAttribute('class','form-control');
	inp1.setAttribute('type','text');
	inp1.setAttribute('name','link[]');

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
	



	$('.videos').append(div0,div1,div3);

}


function submitClicked(){
	var links = document.getElementsByName('link[]');
	// Get youtube id's and append video name to titles
	
	links.forEach(function(item,index){
		console.log(item.value);
	});
}