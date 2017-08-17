var map = new Map();
count = 0
function foo(){
	var fileUploader = document.getElementById('fileuploader').files;
	var files = document.getElementById('filesBlock');

	for(var i = 0;i < fileUploader.length;++i){
		var res = map.get(fileUploader[i]);
		if(res == undefined || res == -1){
			map.set(fileUploader[i], 1);
			element = createElements(fileUploader[i].name);
			files.appendChild(element);
		}
	}
}


function createElements(filename){

	var div1 = document.createElement('div');
	div1.setAttribute('class','form-group row');

	var div2 = document.createElement('div');
	div2.setAttribute('class',"col-md-12");

	var inp1 = document.createElement('input');
	inp1.setAttribute('type','text');
	inp1.setAttribute('class','form-control');
	inp1.setAttribute('id','files' + count)
	inp1.setAttribute('readonly','readonly');
	inp1.setAttribute('name','file' + count);
	inp1.setAttribute('value',filename);

	div2.appendChild(inp1);

	/*var div3 = document.createElement('div');
	div3.setAttribute('class','col-md-2');

	var inp2 = document.createElement('button');
	
	inp2.setAttribute('class','btn btn-primary'),
	inp2.setAttribute('onclick','deleteParent(this);');
	inp2.setAttribute('type','reset');
	inp2.setAttribute('value','delete');
	inp2.setAttribute('href','#');
	var text = document.createTextNode('delete');
	inp2.appendChild(text);

	div3.appendChild(inp2);*/

	div1.appendChild(div2);
	/*div1.appendChild(div3);*/
	++count;
	return div1;
}

function deleteParent(button){
	var elem = button.parentElement.parentElement;
	map.forEach(function(x,y){
		console.log(elem.firstChild.firstChild.value);
		if(x.name == elem.firstChild.firstChild.value){
			map.set(x,-1);
		}
	});
	elem.parentNode.removeChild(elem);

	console.log(map);

}