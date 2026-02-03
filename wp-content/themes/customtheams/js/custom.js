jQuery(document).ready(function ($) {
    $(".language-container a").click(function () {
        $(".language-result").toggleClass("display-none");
    });

    $(".slideshow-container").click(function () {
        $(".language-result").addClass("display-none");
    });
    $(".navigation").click(function () {
        $(".language-result").addClass("display-none");
    });

    $(".logo-section").click(function () {
        $(".language-result").addClass("display-none");
    });
    $(".navbar-toggle").click(function () {
        $(".menu-mobile-nav").toggleClass("mobile-nav-hide");
        $("body").toggleClass("body-scroll-stop");
    });

    // Инициализация всех счетчиков на странице
});
jQuery(document).on("ready", function ($) {
    jQuery('.handle-counter').each(function () {
        const $counter = jQuery(this);
        const $value = $counter.find('.counter-value');
        const $plusBtn = $counter.find('.counter-plus');
        const $minusBtn = $counter.find('.counter-minus');
        // Получаем настройки из data-атрибутов или используем значения по умолчанию
        const min = parseInt($counter.data('min')) || 0;
        const max = parseInt($counter.data('max')) || Infinity;
        const step = parseInt($counter.data('step')) || 1;
        let currentValue = 0;
        // Обновляем отображаемое значение
        function updateValue() {
            $value.val(currentValue);
        }
        // Обработчик для кнопки "+"
        $plusBtn.on("click", function () {
            console.log(currentValue);
            if (currentValue + step <= max) {
                currentValue += step;
                updateValue();
            }
        });
        // Обработчик для кнопки "-"
        $minusBtn.on("click", function () {
            if (currentValue - step >= min) {
                currentValue -= step;
                updateValue();
            }
        });
        // Инициализация начального значения
        updateValue();
    });
});

jQuery(document).on('click', '.close.popup_closed_btn', function (e) {
    e.preventDefault();
    jQuery('.boxquickview').html('');
    jQuery('body').removeClass('modal-open').removeAttr('style');

})
jQuery(document).on("click", "#sendAjaxreauest", function (e) {
    e.preventDefault();
    valDAta = 0;
    var products = [];
    jQuery('.counter-value').each(function () {
        const $counter = jQuery(this);
        if ($counter.val() != 0) {
            products.push({
                product_id: jQuery(this).data('name'),
                quantity: jQuery(this).val()
            });
        }
    });
    jQuery.ajax({
        type: 'POST',
        url: wc_add_to_cart_params.ajax_url,
        data: {
            action: 'woocommerce_bulk_add_to_cart',
            products: products
        },
        success: function (response) {
            console.log(response)
            if (response.error) {
                jQuery(".notification-bar.sdiv").addClass('error').html(response.message).show();
            } else {
                jQuery(".notification-bar.sdiv").addClass('success').show();
                // Обновляем счетчик корзины
                // if (response.fragments) {
                //     $.each(response.fragments, function(key, value) {
                //         $(key).replaceWith(value);
                //     });
                // }
            }

            // button.prop('disabled', false).text('Добавить выбранные товары');
            setTimeout(function () { jQuery(".notification-bar.sdiv").fadeOut(); }, 3000);
        },
        error: function () {
            // message.addClass('error').html('Ошибка сервера').show();
            // button.prop('disabled', false).text('Добавить выбранные товары');
            // setTimeout(function() { message.fadeOut(); }, 3000);
        }
    });
});



function setQty(pid,action,product_variant_id,ptype)
{
    e.preventDefault();
    alert("123");
	var ptype = ptype;
	
	if(ptype == '' || ptype == undefined){
		ptype = 'small';
	}
	
	var totalproduct = $('#totalproduct').val();
	totalproduct = parseInt(totalproduct); 
	
	
	
	
	var inputBoxID = "qty"+pid+"_"+product_variant_id;
	var currQty = (document.getElementById(inputBoxID).value)*1;
	newQty = currQty;
	if(action=='add')
	{
		var newQty = currQty+1;
		totalproduct = parseInt(totalproduct)+1; 
		
	} 
	else if(action=='remove')
	{
		var newQty = currQty-1;
		totalproduct = parseInt(totalproduct)-1; 
		
		
	}
	
	var productID = pid;
	var action = action;
	var quantity = newQty;
	
	if(quantity && quantity != '' && quantity != '0')
	{
		quantity = parseInt(quantity);
	}
	
	if(productID==undefined)
	{
		alert('something went wrong. Try again later.');
	}
	
	if(product_variant_id==undefined)
	{
		alert('something went wrong. Try again later.');
	}
	var dataString = '&productID='+ productID + '&quantity='+ quantity + '&product_variant_id='+ product_variant_id + '&action='+ action + '&ptype='+ ptype;
			
    jQuery.ajax({
        type: 'POST',
        url: wc_add_to_cart_params.ajax_url,
        data: {
            action: 'woocommerce_bulk_add_to_cart',
            products: products
        },
        success: function (response) {
            console.log(response)
            if (response.error) {
                jQuery(".notification-bar.sdiv").addClass('error').html(response.message).show();
            } else {
                jQuery(".notification-bar.sdiv").addClass('success').show();
                // Обновляем счетчик корзины
                // if (response.fragments) {
                //     $.each(response.fragments, function(key, value) {
                //         $(key).replaceWith(value);
                //     });
                // }
            }

            // button.prop('disabled', false).text('Добавить выбранные товары');
            setTimeout(function () { jQuery(".notification-bar.sdiv").fadeOut(); }, 3000);
        },
        error: function () {
            // message.addClass('error').html('Ошибка сервера').show();
            // button.prop('disabled', false).text('Добавить выбранные товары');
            // setTimeout(function() { message.fadeOut(); }, 3000);
        }
    });
		return false;
}