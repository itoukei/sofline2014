function SubmitControl(){
	var list = document.getElementsByTagName("input");
	for(var i=0; i<list.length; i++){
		list[i].onkeypress = function (event){
			return onTextBoxKeyPress(event);
		};
	}
	return list;
}
function onTextBoxKeyPress(e){
	e = e || window.event;
	if (e.keyCode == 13) return false;
}