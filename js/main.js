window.onload = function(){
if(document.querySelector('.swiper-container')){
	var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      loop: true,
      // autoplay: true,
    });}
	const burger = document.querySelector('.header__burger');
	const drawer = document.querySelector('.drawer');
	const drawerInner = document.querySelector('.drawer__inner');
	const body = document.querySelector('body');

	function openDrawer(){
		burger.classList.toggle('active');
		drawer.classList.toggle('active');
		drawerInner.classList.toggle('active');
		body.classList.toggle('active');
	}
	function closeDrawer(){
		burger.classList.remove('active');
		drawer.classList.remove('active');
		drawerInner.classList.remove('active');
		body.classList.remove('active');
	}
	burger.addEventListener('click', openDrawer, false);

	const drawerNavs = document.querySelectorAll('.drawer__nav');
	for (let drawerNav of drawerNavs) {
  		drawerNav.addEventListener('click', closeDrawer, false);
	};

    $("#searchInput").keyup(function() {
        var name = $('#searchInput').val();
        if (name === "") {
            $("#searchResult").html("");
        }
        else {
            $.ajax({
                type: "GET", 
                url: "../php/search.php", 
                data: {
                    search: name 
                },
                success: function(response) {                 
                    $("#searchResult").html(response).show();
                }
            });
        }
    });

     $('.products__button-buy').click(function () {
        var id = $(this).attr('id'); 
            $.ajax({
            type: "POST", 
            url: '../php/AddToCart.php',
            data: {id_product: id},
            success: function(data) {
                // $('.header__cart-quanity').html(data);
                }
            });
        });
     $('.cart__item-quantity').change(function () { 
        var quan = $(this).val(); 
        if (quan<1){ quan = 1; $(this).val(1); } 
        var id = $(this).parent().attr('id'); 
            $.ajax({
            type: "POST",
            url: '../php/cartAmount.php',
            data: {quan_product: quan, id_product: id},
            success: function(data) {
                    $('.cart__item-priceAll').html = data * $('.cart__item-priceOne').html;
                     location.reload();
                }
            });
    });

    $('.cart__item-button').click(function () { 
        var id = $(this).parent().attr('id'); 
            $.ajax({
            type: "POST",
            url: '../php/deleteFromCart.php',
            data: {id_product: id},
            success: function() {
                 location.reload();
                }
            });
        });
}