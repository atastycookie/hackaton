<?php

//json object
if(isset($_POST["json"])){

    $json = stripslashes($_POST["json"]);
    $output = json_decode($json);
}


//logo
if (!empty($output->company->logo)){
$logo_link = '<div class="logo"><img src="../'.$output->company->logo.'" align="bottom"></img></div>';
} else {
$logo_link = '<div class="logo"></div>';
}

//loop thru items
function all_items(){
	global $output;
	$row_color='white';
	$all_data='';
	foreach ($output->items as $row)
	{	
		$all_data .='
		<div class="cell '.$row_color.'">
			<div class="item-cell"><p>'.$row->item_name.'</p></div>
			<div class="qty-cell"><p>'.$row->qty.'</p></div>
			<div class="price-cell"><p>'.$row->price.'</p></div>
			<div class="discount-cell"><p>'.$row->discount.'</p></div>
			<div class="subtotal-cell"><p>'.$row->subtotal.'</p></div>
		</div>';
		
		//switch row colors
		if ($row_color=='white'){
			$row_color = 'gray';
		} else if ($row_color=='gray'){
			$row_color = 'white';
		}
	}
	return $all_data;
}

function replace_ent($obj){$obj = urldecode($obj);
return $obj;
}


//invoice notes validate \n
$inv_notes = $output->extra->notes;
$inv_notes = replace_ent($inv_notes);

//notes title
if($inv_notes) { $notes_title = 'Notes:'; }

//client add validate \n
$client_address = $output->client->address;
$client_address = replace_ent($client_address);

//company add validate \n
$company_address = $output->company->address;
$company_address = replace_ent($company_address);

//client address comma fixif(!empty($output->client->state)){$client_comma=',';} else {$client_comma='';}//company address comma fixif(!empty($output->company->state)){$comp_comma=',';} else {$comp_comma='';}

// commas
if($client_address) 	   { $clname = ','; $cladd = ','; } else { $clname ='';  $cladd = '';}
if($output->client->city)  { $clcity = ','; } else { $clcity ='';}

if($company_address) 	   { $coname = ','; $coadd = ','; } else { $coname ='';  $coadd = '';}
if($output->company->city) { $cocity = ','; } else { $cocity ='';}

include_once('mpdf/mpdf.php');

$mpdf=new mPDF('win-1252','A4','','',10,10,0,25,10,10);
$mpdf->useOnlyCoreFonts = false;
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Invoice");
$mpdf->SetAuthor("Roman Ananyev");


$mpdf->SetHTMLFooter('<div style="float:right; text-align:right;" ><span style="color:#ccc; font-size:12px;" >Created by <a style="color:#666; text-decoration:none;" href="https://www.facebook.com/rsananyev">Roman Ananyev</a></span></div>');


$html =
'
<!doctype html>
<html lang="en">
<head>
<meta http-equiv=«Content-Type» content=«text/html; charset=utf-8»>
<style>

body,html {font-family: arial;}
p 		  {margin:0; padding:0; font-family: arial;}

#header          {width:200px; height:100px; }
#header .title   { height: 35px; background:#84c060; }
#header .title p { height: 22px; max-height: 22px; font-size:18px; color:white; font-weight:; line-height: 18px; padding-top:9px; padding-left:10px; background:#84c060; }
#header .title   { margin-bottom:4px; }
#header .date,#header .due-date,#header .invoice-number  { height:12px; width:inherit; margin-top:2px;}
.desc 	{ float:left; width:80px; color:gray;}
.detail { float:right; width:110px; text-align:right;  color:#3B3B3B;}
.invoice-number p,.date p,.due-date p{font-size:12px; line-height:13px;}

#client-company-wrap {width:720px; height:auto; overflow:hidden;}
#client { float:left; width:200px; height:auto; }
#company { float:right; width:200px; height:auto; }

#company .logo {width:150px; height:80px; max-height:80px;}
#company .logo img  {max-width:150px; max-height:75px; margin-bottom:4px;}

#client  .client-details  p { color:#3B3B3B; font-size:14px; line-height:14px; }
#company .company-details p { color:#3B3B3B; font-size:14px; line-height:14px; }


#list{width:720px; height:40px; ; background-color:;}
#item,#qty,#price,#discount,#subtotal{width:80px; height: 40px; text-align:center; font-size:15px; background-color:#84c060; float:left;border-left:1px solid #7ab357;}
#item p,#qty p,#price p,#discount p,#subtotal p{line-height: 16px; padding-top:12px; color:white;}
#item {width: 394px; border-left:none; text-align:left;}
#item p {margin-left:10px;}
#qty, #discount {background-color:#8bc368;}

#invoice-items   { width: 720px; height:auto; } 

#invoice-items .white,#invoice-items .gray{width: auto;height: 39px; border-bottom:1px solid #eaeaea;}
#invoice-items .gray  {background:#f9f9f9;} 

.item-cell,.qty-cell,.price-cell,.discount-cell,.subtotal-cell {width:80px; height: 39px; text-align:center; font-size:13px; float:left;border-left:1px solid #eaeaea; }
.item-cell p,.qty-cell p,.price-cell p,.discount-cell p,.subtotal-cell p { line-height:14px; padding-top:12px; color:#1F1F1F; }

.item-cell        {border-left:none; width: 394px; text-align:left; /* border-top:1px solid white; */ }
.item-cell p 	  {margin-left:10px;}
/* .qty-cell,.price-cell,.discount-cell,.subtotal-cell { border-top:1px solid white } */

#totals { height: 90px; width: 184px; margin-top: 20px; float:right; font-size:16px }
#totals .left-item { background:; width: 64px; height:20px; float:left}
.grand-subtotal, .grand-vat, .grand-total {width: 95px; padding-right:5px; ; height:20px; float:left; text-align:right; font-weight:bold;}
.grand-vat {width: 32px; text-align:right; padding:0; margin-right:7px; float:right;}
.grand-divider { height:2px; width: 178px; border-bottom:1px solid #000; margin-bottom:8px; }

#notes-wrap {width:510px; margin-left:10px; margin-top: 90px; height: 100px;}
#notes-wrap .notes {width: 510px; height:50px; color:#666; }

</style>
</head>
<body>


<div id="header">
<div class="title"><p>INVOICE</p></div>
<div class="invoice-number">
	<div class="desc"><p>Invoice Num:</p></div>
	<div class="detail"><p>'.$output->details->number.'</p></div>
</div>
<div class="date">
	<div class="desc"><p>Date:</p></div>
	<div class="detail"><p>'.$output->details->date.'</p></div>
</div>
<div class="due-date">
	<div class="desc"><p>Due Date:</p></div>
	<div class="detail"><p>'.$output->details->due_date.'</p></div>
</div>
</div>



<div id="client-company-wrap"><!-- CLIENT COMPANY WRAP -->

	<div id="client"><!-- CLIENT INFO -->
	
	<p style="color:black;" ><b>Bill to:</b></p>

	<div class="client-details">
	<p>'.trim($output->client->name)."$clname<br>".trim(nl2br($client_address))."$cladd<br>".trim($output->client->city)."$clcity ".trim($output->client->state).$client_comma.'<br>'.trim($output->client->country).'<br></p>
	</div><!-- END CLIENT INFO -->
	
	</div>

	<div id="company" style="margin-top:-60px;" ><!-- COMPANY INFO -->
	'.$logo_link.'
	<div class="company-details">
	<p>'.trim($output->company->name)."$coname<br>".trim(nl2br($company_address))."$coadd<br>".trim($output->company->city)."$cocity ".trim($output->company->state).$comp_comma.'<br>'.trim($output->company->country).'<br></p>
	</div>
	</div><!-- END COMPANY INFO -->
	
</div><!-- END CLI COM WRAP  -->

<br><br><br>

<div id="list">

	<div id="item"><p>Item Description</p></div>
	<div id="qty"><p>Qty</p></div>
	<div id="price"><p>Price</p></div>
	<div id="discount"><p>Discount %</p></div>
	<div id="subtotal"><p>Subtotal</p></div>

</div>

<div id="invoice-items"> <!-- LIST OF INVOICE ITEMS-->
'.all_items().'
</div><!-- END LIST OF INVOICE ITEMS -->

<div id="totals">
<div style="height: 22px; width:inherit;" >
<div class="left-item" style="width:76px;">Subtotal</div><div class="grand-subtotal" style="width:100px;">'.$output->totals->grand_subtotal.'</div>
</div>

<div style="height: 22px; width:inherit;" >
<div class="left-item">Tax %</div><div class="grand-vat">'.$output->totals->vat.'</div>
</div>

<div class="grand-divider"></div>

<div style="height: 22px; width:inherit;" >
<div class="left-item" style="width:38px;">Total </div><div style="float:left; width:38px;" >'.$output->totals->currency.'</div><div class="grand-total" style="width:100px;">'.$output->totals->grand_total.'</div>
<iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/small.xml?account=410011680044609&quickpay=small&yamoney-payment-type=on&button-text=01&button-size=m&button-color=orange&targets=1&default-sum='.$output->totals->grand_total.'&fio=on&mail=on&successURL=" width="229" height="54"></iframe>
</div>
</div>

<div id="notes-wrap"><!--Invoice Notes-->
<b>'.$notes_title.'</b></br>
<div class="notes">'.nl2br($inv_notes).'</div>
</div>


</body>
</html>
';


$to      = 'ant1freezeca@gmail.com';
$subject = 'Оплати счет, '.trim($output->client->name);
$message = $html;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

mail($to, $subject, $message, $headers);

echo $html;

 //$mpdf->WriteHTML($html);
 //$mpdf->Output('YMHackaton-'.$output->details->number.'.pdf', 'D'); exit;



exit;