window.onload = function(){
	const paginator = document.querySelector(".paginator");
	const page = "";
	for (var i = 0; i < cnt_page; i++) {
 		 page += "<span data-page=" + i * cnt + "  id=\"page" + (i + 1) + "\">" + (i + 1) + "</span>";
	}
	paginator.innerHTML = page;
}