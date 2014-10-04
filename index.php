<?php include 'config.php' ?>
<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8" />
<title><?php echo $site_name?></title>

<link rel="canonical" href="<?php echo $site_url?>" />

<link rel="stylesheet" href="css/styles.css" />

<!-- JS -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/jquery.limit-1.2.source.js" type="text-javascript" ></script>

<!--For the logo -->
<script src="js/ajaxupload.js" type="text/javascript"></script>
<link href="css/slip.css" rel="stylesheet">

<!--Select dropdown-->
<script src="js/jquery.customSelect.min.js" type="text/javascript"></script>

<!-- Datepicker -->
<script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
<link href="css/datepicker.css" rel="stylesheet">


<!--ck-->
<script src="js/jqc.js"></script>

<!-- For the logo -->
<script>
$(document).ready(function(){

	//style country dropdown
	$('select.client-country,select.company-country').customSelect();
	//currency
	$('select.currency').customSelect();

	var thumb = $('img#thumb');	

	new AjaxUpload('imageUpload', {
		action: $('form#newHotnessForm').attr('action'),
		name: 'image',
		onSubmit: function(file, extension) {
			$('div.preview').addClass('loading').show();
			$('.logo').hide();
		},
		onComplete: function(file, response) {
			if (response=='Image Larger than 2Mb.'){
				alert(response);
				console.log(response);
			} else {
			thumb.load(function(){
				$('div.preview').removeClass('loading');
				thumb.unbind();
				
			});
			thumb.attr('src', response);
			}
		}
	});
	
		$(".preview").hover(function(){
			$('#x-icon').show();
		}, function(){
			$('#x-icon').hide();
		});
		
		$('#x-icon').on('click', function(){
			$('#thumb').attr('src','images/blank.png');
			$('.logo').show();
		});
		
		
});

</script>

</head>
<body itemscope itemtype="http://schema.org/Article">

<div id="site-top" style="margin:0 auto; width: 800px; height:80px; background: #333; border-top-left-radius: 5px; border-top-right-radius: 5px;" ><!--SITE TOP-->

<img style="margin-top:20px; margin-left:25px;" src="images/logo.png" alt="Logo" />

<div style="float:right; height:100px; width: 250px;" ><!--SOCIAL -->

	<div style="height:30px; width:100px; padding-top:30px; float:left;" >
		<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
		<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,gplus" data-yashareTheme="counter"></div> 
	</div>

</div><!-- END SOCIAL -->

</div><!-- END SITE TOP -->


<div id="big-wrapper" style="margin:0 auto; width: 720px; height:auto; padding: 60px 57px 60px 60px; background:white; box-shadow: 0px 3px 10px #1A1A1A; border-radius:5px;"><!--Sub-body-->


<div id="header">
<div class="title"><p>Инвойс</p></div>
<div class="invoice-number">
	<div class="desc"><p>Номер счета:</p></div>
	<div class="detail"><input type="text" class="inv-number" value="007" ></input></div>
</div>
<div class="date">
	<div class="desc"><p>Выставлен:</p></div>
	<div class="detail"><input type="text" class="inv-date" value="<?php echo date('m/d/Y') ?>" ></input></div>
</div>
<div class="due-date">
	<div class="desc"><p>Оплатить до:</p></div>
	<div class="detail"><input type="text" class="inv-due-date" value="<?php echo date('m/d/Y', strtotime(date('m/d/Y'). ' + 7 days')); ?>" ></input></div>
</div>
</div>


<div id="client-company-wrap"><!-- CLIENT COMPANY WRAP -->

	<div id="client" style="margin-top:55px;" ><!-- CLIENT INFO -->
	
	<p style="color:black;" ><b>Плательщик:</b></p>
	
	<div class="client-details">
	<!-- <p>Bill Gates,<br>Palo Alto,<br>Infinite Loop,<br>California, US.<br></p> -->
	<ul>
		<li class="client-data"><input type="text" name="client-name" class="client-name" value="" placeholder="Имя клианта" /></li>
		<li class="client-data">
		<!--<input type="text" name="client-address" value="Roman Ananyev" placeholder="Address" />-->
		<textarea name="client-address" class="client-address" placeholder="Адрес"></textarea>
		</li>
		<li class="client-data">
		<input type="text" name="client-city" class="client-city" value="" placeholder="Город" />
		<input type="text" name="client-state" class="client-state"   value="" placeholder="Область" />
		</li>
		<!-- <li class="client-data"><input type="text" name="client-country" value="" placeholder="Country" /></li> -->
		<li>
		<li>
		<select name="client-country" class="client-country">
		<option value="" disabled="disabled" selected >Страна...</option>
			<option value="Russia">Россия</option>
			<option value="AnotherWorld">Не Россия</option>
		</select>
		</li>
	</ul>
	</div><!-- END CLIENT INFO -->
	
	</div>

	<div id="company" style=""><!-- COMPANY INFO -->
	
	<!-- OLD <div class="logo"><img src="logo.jpg"></img></div> -->
	
	<div id="mainwrapper" style="margin-left:0;" > <!-- Logo -->

		<div class="preview-wrap">

		<div class="preview" style="z-index:20;" >
			<img style="z-index:1; /*added later*/ position:absolute;" id="x-icon" src="images/x.png"   height="16" width="16" >
			<img style="z-index:-1; /* hidden later position:absolute; */left:0px;top:0px;" id="thumb" src="" >
		</div>
		</div>
						
		<div class="logo blank blogo-trigger" style="z-index:19;" title="Upload your logo">
				<div class="placeholder-wrapper">
				<div class="placeholder">
					Логотип кмпании <i class="arrowicon"></i></div>
				</div>
				<div class="image"></div>
				<form id="newHotnessForm" action="php/process.php" method="post" enctype="multipart/form-data" >
				<input id="imageUpload" type="file" class="company-logo" name="logo">
				</form>
		</div>

	</div> <!-- END Logo -->
	
	<div class="company-details">
	<!-- <p>Borni Mice,<br>Seattle, Washington,<br>Infinite Loop,<br>California, US.<br></p> -->
	<ul>
		<li class="company-data"><input type="text" name="company-name" class="company-name" value="" placeholder="Название вашей организации" /></li>
		<li class="company-data">
		<textarea name="company-address" class="company-address" placeholder="Адрес компании"></textarea>
		</li>
		<li class="company-data">
		<input type="text" name="company-city" class="company-city" value="" placeholder="Город" />
		<input type="text" name="company-state" class="company-state"   value="" placeholder="Область" />
		</li>
		<li>
		<select name="company-country" class="company-country">
		<option value="" disabled="disabled" selected >Страна...</option>
			<option value="Russia">Россия</option>
			<option value="AnotherWorld">Не Россия</option>
		</select>
		</li>
	</ul>
	</div>
	</div><!-- END COMPANY INFO -->
	
</div><!-- END CLI COM WRAP  -->

<br><br><br>

<div id="list">

	<div id="item"><p>Название товара</p></div>
	<div id="qty"><p>Кол-во</p></div>
	<div id="price"><p>Стоимость</p></div>
	<div id="discount"><p>Скидка %</p></div>
	<div id="subtotal"><p>Итого</p></div>

</div>

<div id="invoice-items"> <!-- LIST OF INVOICE ITEMS-->
	<div class="cell white" data-divid="1" >
		<div class="new-row"></div>
		<div class="item-cell"><input type="text" value="Травка, чтобы курнуть" ></input></div>
		<div class="qty-cell"><input type="text" value="1" ></input></div>
		<div class="price-cell"><input type="text" value="500.00" ></input></div>
		<div class="discount-cell"><input type="text" value="0" ></input></div>
		<div class="subtotal-cell"><input type="text" value="0.00" ></input></div>
		<div class="remove-row"></div>
	</div>
	<div class="cell gray" data-divid="2" >
		<div class="new-row"></div>
		<div class="item-cell"><input type="text" value="Отключение 3DS и согласование всего мира по картам" ></input></div>
		<div class="qty-cell"><input type="text" value="1" ></input></div>
		<div class="price-cell"><input type="text" value="бесценно" ></input></div>
		<div class="discount-cell"><input type="text" value="0" ></input></div>
		<div class="subtotal-cell"><input type="text" value="0.00" ></input></div>
		<div class="remove-row"></div>
	</div>
</div><!-- END LIST OF INVOICE ITEMS -->

<div class="add-row-button"></div>


<div style="height:75px; width:auto;" ><!--Totals-->
<div id="totals" >
	<div style="height: 22px; width:inherit;" >
	<div class="left-item">Итого</div><div class="grand-subtotal"></div>
	</div>

	<div style="height: 22px; width:inherit;" >
	<div class="left-item">Налог %</div><div class="grand-vat"><input type="text" value="0" /></div>
	</div>

	<div class="grand-divider"></div>

	<div style="height: 22px; width:inherit;" >
	<div class="left-item" style="width:36px;">Всего</div><div style="float:left;" ><?php include('html/currencies.html'); ?></div><div class="grand-total" style="width:90px"></div>
	</div>
</div>
</div><!-- END Totals -->


<div id="notes-wrap"><!--Invoice Notes-->
<b>Примечание:</b></br>
<textarea name="notes" class="notes" placeholder="Оплати этот товар и будет збс! &#013;&#010"></textarea>
</div>


<div class="submibtn" style="width:185px; margin:50px auto 0 auto;" >
<button class="create-invoice btn-large btn-primary" >Захуячить счет!</button>
</div>

<script>
//$(document).ready(function(){

	//FUNCTIONS////////////////
	(function($){ 
    	 $.fn.extend({  
         limit: function(limit,element) {
			
			var interval, f;
			var self = $(this);
					
			$(this).focus(function(){
				interval = window.setInterval(substring,100);
			});
			
			$(this).blur(function(){
				clearInterval(interval);
				substring();
			});
			
			substringFunction = "function substring(){ var val = $(self).val();var length = val.length;if(length > limit){$(self).val($(self).val().substring(0,limit));}";
			if(typeof element != 'undefined')
				substringFunction += "if($(element).html() != limit-length){$(element).html((limit-length<=0)?'0':limit-length);}"
				
			substringFunction += "}";
			
			eval(substringFunction);
			
			
			
			substring();
			
        } 
	    }); 
	})(jQuery);
	
	//update inboice table row
	function update_row(row_id,qty,price,discount)
	{
		if (price ==0){
			discount=0;
			$('[data-divid="'+row_id+'"]').children('.discount-cell').find('input').val(0); //update discount
		}
		if (discount >=1){
			discount=0;
			$('[data-divid="'+row_id+'"]').children('.discount-cell').find('input').val(discount*100);	//update discount
		}

		
		if(qty <= 0){
			subtotal = 0; price=0; discount=0;
		} else {
			subtotal = (( price*qty )  - ( (price*qty) * discount )).toFixed(2); //row subtotal
		}
		
		$('[data-divid="'+row_id+'"]').children('.price-cell').find('input').val(price); //update row price
		
		$('[data-divid="'+row_id+'"]').children('.subtotal-cell').find('input').val(subtotal) ; //update row subtotal
	}

	function update_totals()
	{
	var grand_total = 0;
	var grand_subtotal = 0;
	var grand_vat = $('.grand-vat').find('input').val();
	if ( (grand_vat < 0) || (grand_vat > 90) ) { grand_vat=10; $('.grand-vat').find('input').val(10); }
	
	$('#invoice-items .cell').children('.subtotal-cell').each(function(){
		
		grand_subtotal += parseFloat( $(this).find('input').val() );
	});
	
	grand_total = (grand_subtotal * (grand_vat/100)) + (grand_subtotal);
	grand_total = grand_total.toFixed(2);
	
	grand_subtotal = grand_subtotal.toFixed(2);
	//update dom
	$('.grand-subtotal').text(grand_subtotal);
	$('.grand-total').text(grand_total);
	}
	
	function opposite_class(value)
	{
		if(value=='white'){
		   value ='gray';
		   return value;
		}
		else if(value=='gray') {
		   value ='white';
		   return value;
		}
	}
	
	function select_all_input()
	{
		$(".cell input[type=text]").one('click', function(){
    		// Select field contents
    		this.select();
		});
	}
	
	function plus_minus_hover()//add-remove row on mouse hover
	{
		$('.cell').hover(function(){
			var cell_id = $(this).data('divid');
			var c_id_select = '[data-divid="'+cell_id+'"]';
			//$('.new-row,.remove-row').css('display', 'block');
			$(c_id_select+' .new-row').css('display', 'block');
			$(c_id_select+' .remove-row').css('display', 'block');
		}, function(){
			$('.new-row,.remove-row').hide();
		});
	}
	
	function last_row_id()
	{
		var last_row=0;
		$('#invoice-items').children().each(function(){
			var row = $(this).data('divid'); //actual row row
			if (row > last_row) { last_row = row; }
		});
		return last_row;
	}
	
	function minus_remove_row()//remove row functionalty
	{
		$('#invoice-items').on('click','.remove-row', function(){
		var remove_parent_div_id = $(this).parent().data('divid');
		//if first row don't remove the row
		if (remove_parent_div_id==1){return false};
		$('[data-divid="'+remove_parent_div_id+'"]').remove();
		
		reset_row_colors();//reset row colors
		update_totals();//update totals
		});
	}
	
	function reset_row_colors()
	{	
		var last_value='';
		$('#invoice-items').children().each(function(){
			//console.log($(this).attr('class'));
			cl_name = $(this).attr('class');
			cl      = cl_name.split(' ');
			cl      = cl[1];
			if (cl==last_value) { cl=opposite_class(last_value); } else {cl=cl;};
			last_value = cl;
			//update dom
			$(this).attr('class','cell '+cl);
		});
		
	}
	//max rows you can create
	function max_rows()
	{
		var row_cnt =0;
		$('#invoice-items').children().each(function(){
			++row_cnt;
		});
		
		if( row_cnt >= 14 )
		{
			return false;
		}
	}
	
	function grab_invoice_data()
	{

		//details
		invoice_data.details.number   = $('.inv-number').val();
		invoice_data.details.date     = $('.inv-date').val();
		invoice_data.details.due_date = $('.inv-due-date').val();
		
		//client
		invoice_data.client.name       = $('.client-name').val();
		invoice_data.client.address    = encodeURIComponent($('.client-address').val());
		invoice_data.client.city	   = $('.client-city').val();
		invoice_data.client.state      = $('.client-state').val();
		invoice_data.client.country    = $('.client-country').val();
		
		//company
		invoice_data.company.logo       = $('#thumb').attr('src');
		invoice_data.company.name       = $('.company-name').val();
		invoice_data.company.address    = encodeURIComponent($('.company-address').val());
		invoice_data.company.city       = $('.company-city').val();
		invoice_data.company.state      = $('.company-state').val();
		invoice_data.company.country    = $('.company-country').val();
		

		//invoice_data.items
		$('#invoice-items').children().each(function(){
		
			//vars//
			var row_id = $(this).data('divid');
			var row_name = "".concat("row_",row_id);
			
			var row_item_name  = $(this).children('.item-cell').find('input').val(),
				row_item_qty   = $(this).children('.qty-cell').find('input').val(),
				row_item_price = $(this).children('.price-cell').find('input').val(),
				row_item_discount = $(this).children('.discount-cell').find('input').val(),
				row_item_subtotal = $(this).children('.subtotal-cell').find('input').val();
			///////
			
			//create json object for row
			invoice_data.items["row_"+row_id] = {"item_name":"", "qty":"", "price":"", "discount":"", "subtotal":""};
			
			//fill json row item details
			invoice_data.items["row_"+row_id].item_name = row_item_name;
			invoice_data.items["row_"+row_id].qty       = row_item_qty;
			invoice_data.items["row_"+row_id].price     = row_item_price;
			invoice_data.items["row_"+row_id].discount  = row_item_discount;
			invoice_data.items["row_"+row_id].subtotal  = row_item_subtotal;
			
		});
		
		//totals
		invoice_data.totals.grand_subtotal = $('.grand-subtotal').text();
		invoice_data.totals.vat            = $('.grand-vat').find('input').val();
		invoice_data.totals.grand_total    = $('.grand-total').text();
		
		//currency
		invoice_data.totals.currency       = $('.currency').val();
		//extra
		invoice_data.extra.notes = encodeURIComponent($('textarea.notes').val());
	}
	


	//$.download('path', 'data' [, 'post'])
	$.download = function(url, data, method)
	{
		//url and data options required
		if(url && data) {
			var form = $('<form />', { action: url, method: (method || 'get') });
			$.each(data, function(key, value) {
				var input = $('<input />', {
					type: 'hidden',
					name: key,
					value: value
				}).appendTo(form);
			});
		return form.appendTo('body').submit().remove();
		}
	throw new Error('$.download(url, data) - url or data invalid');
	};
	
	//END FUNCTIONS///////////

	
	//declare initial variables
	var subtotal=0;
	var inv_created=0;
	var	inv_number = $('.inv-number').val(), inv_date = $('.inv-date').val(), inv_due_date=$('.inv-due-date').val();
	
	//initial invoice data scheme
	var invoice_data = {

		"details":{
		
				"number":"16555482",
				"date":"13-06-2013",
				"due_date":"13-07-2013"
		},
		"client":{
				"name" : "",
				"address" : "",
				"city" : "",
				"state" : "",
				"country" : ""
			
		},
		"company":{
		
				"logo" : "",
				"name" : "",
				"address" : "",
				"city" : "",
				"state" : "",
				"country" : ""
			
		},
		"items":{
			
		},
		"totals":{
				"grand_subtotal":"",
				"vat":"",
				"grand_total":"",
				"currency":""
		},
		"extra":{
				"notes":""
		}
		
	};
		

	$('.create-invoice').on('click',function()
	{
		grab_invoice_data();
		// Declare a variable
		var jsonObj = invoice_data;
		 
		// Lets convert our JSON object
		var postData = JSON.stringify(jsonObj);
		 
		// Lets put our stringified json into a variable for posting
		var postArray = {json:postData};
		
		$.download("php/json.php", postArray, 'post');
		//if cookie exists
		var i_n = $('.inv-number').val();
		$.cookie('lid', ++i_n, { expires: 365 } ); 
		//invoices created
		if( $.cookie('ic') ){
		var ck_inv_created = ($.cookie('ic'));
		$.cookie('ic', (++ck_inv_created));
		} else {
		$.cookie('ic', ++inv_created);
		}
		
	})

	
	$('#invoice-items').children().each(function()
	{
		//vars
		var qty_cell = Number($(this).children('.qty-cell').find('input').val()),
			price_cell = Number($(this).children('.price-cell').find('input').val()).toFixed(2),
			discount_cell_first = Number($(this).children('.discount-cell').find('input').val());
		
		//price cell
		$(this).children('.price-cell').find('input').val(price_cell);
		
		// discount cell
		if ((discount_cell_first >=100)|| (discount_cell_first <0 )) {
		discount_cell_first=0;
		$(this).children('.discount-cell').find('input').val(discount_cell_first);
		};
		discount_cell = Number( discount_cell_first / 100);
		
		//subtotal cell
		subtotal = (price_cell*qty_cell)  - ( (price_cell*qty_cell) * discount_cell );
		subtotal = subtotal.toFixed(2);
		
		
		$(this).children('.subtotal-cell').find('input').val(subtotal);
	});
	
	//update values in real time
	$('#invoice-items').on('change','.cell input[type=text]', function()
	{
		var row_id = $(this).parents().eq(1).data('divid');//parents two level up
		var qty = Number($('[data-divid="'+row_id+'"]').children('.qty-cell').find('input').val()),
			price = Number($('[data-divid="'+row_id+'"]').children('.price-cell').find('input').val()).toFixed(2),
			discount = Number( $('[data-divid="'+row_id+'"]').children('.discount-cell').find('input').val() );
			if ((discount >=100)|| (discount <0 )) { discount = 0; $('[data-divid="'+row_id+'"]').children('.discount-cell').find('input').val(0); }
			discount = (discount/100);
			
		//update row
		update_row(row_id,qty,price,discount);
		
		//set limit characters to item-name
		$('[data-divid="'+row_id+'"] .item-cell input[type=text]').limit('44');
		
		//update totals
		update_totals();
	});
	
	//update totals on vat change
	$('.grand-vat').on('change',function(){
	update_totals();
	});
	
	//when add button is clicked
	$('.add-row-button').on('click', function()
	{
		//max rows
		if(max_rows()==false){ return false; }
		
		var last_row = last_row_id();
		
		var cl_name = $('#invoice-items').children().eq(-1).attr('class'); //class name
			cl      = cl_name.split(' ');
			cl      = cl[1];
			
		if (cl=='gray'){cl='white';} else if (cl=='white'){cl='gray';}
		
		//add a new row
		$('#invoice-items').append('<div class="cell '+ (cl) +'" data-divid="'+ (++last_row) +'" ><div class="new-row"></div><div class="item-cell"><input type="text" value="Item '+(last_row)+'" ></input></div> <div class="qty-cell"><input type="text" value="1" ></input></div> <div class="price-cell"><input type="text" value="0.00" ></input></div> <div class="discount-cell" ><input type="text" value="0"></input></div> <div class="subtotal-cell"><input type="text" value="0.00" ></input></div><div class="remove-row"></div></div>');
				
		select_all_input();//select all input text on click
		plus_minus_hover();//add-remove row hover
 	});
		
	//plus add new row
	$('#invoice-items').on('click','.new-row', function()
	{
		//max rows
		if(max_rows()==false){ return false; }
		
		var add_parent_div_id = $(this).parent().data('divid');
		var last_row = last_row_id();
		var cl_name = $('#invoice-items').children().eq(-1).attr('class'); //class name
			cl      = cl_name.split(' ');
			cl      = cl[1];
			
		if (cl=='gray'){cl='white';} else if (cl=='white'){cl='gray';}
		
		//add a new row
		$('[data-divid="'+add_parent_div_id+'"]').after('<div class="cell '+ (cl) +'" data-divid="'+ (++last_row) +'" ><div class="new-row"></div><div class="item-cell"><input type="text" value="Item '+(last_row)+'" ></input></div> <div class="qty-cell"><input type="text" value="1" ></input></div> <div class="price-cell"><input type="text" value="0.00" ></input></div> <div class="discount-cell"><input type="text" value="0" ></input></div> <div class="subtotal-cell"><input type="text" value="0.00" ></input></div><div class="remove-row"></div></div>');
		
		reset_row_colors();//reset row colors
		select_all_input();//select all input text on click
		plus_minus_hover();//plus minus buttons on hover
	});
	
	
	//currency values
	$("#currency").focus(function() {
	  var selectedOption = $(this).find("option:selected");
	  selectedOption.text(selectedOption.attr("description"));
	});

	$("#currency").change(function() {
	  var selectedOption = $(this).find("option:selected");
	  selectedOption.attr("description", selectedOption.text());
	  selectedOption.text(selectedOption.val());
	});

	var currSelOption = $("#currency").find("option:selected");
	currSelOption.attr("description", currSelOption .text());
	currSelOption.text(currSelOption .val());
	//end currency values
	
	//RUN FUNCTIONS ON PAGE LOAD//
	
	update_totals();//run initial subtotals
	plus_minus_hover();//plus minus buttons on hover
	minus_remove_row();//minus delete row
	select_all_input();//select all input text on click
	//limit some inputs
	$('textarea.notes').limit(188);
	$('.client-address,.company-address').limit(55);
	//last invoice id
	if($.cookie('lid')){$('.inv-number').val($.cookie('lid'));}
	
//});

	<!-- GOOGLE PLUS JS -->
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
	
</script>


<!-- Datepicker -->
<script type="text/javascript">
	var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var currdate = $('.inv-date').datepicker({
    onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    if (ev.date.valueOf() > duedate.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    duedate.setValue(newDate);
    }
    currdate.hide();
    $('.inv-due-date')[0].focus();
    }).data('datepicker');
    var duedate = $('.inv-due-date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= currdate.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    duedate.hide();
    }).data('datepicker');
</script>


</div><!-- End sub-body -->

<div style="width:810px; padding: 10px 10px 0 10px; text-align:right; font-size:14px; color:#2B2B2B; height:40px; margin:0 auto;" ><!-- Footer -->
Copyright &copy; <?php echo date("Y"); ?> <?php echo $site_name ?>
</div>

</body>
</html>