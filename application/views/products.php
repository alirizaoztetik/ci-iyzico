<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test - Ürün</title>
    <style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 15px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	.card{
		width:15%;
		border:solid 1px #d3d3d3;
		border-radius:0.25rem;
		padding:10px 10px;
		font-size:1rem;
	}
	.card-title{
		margin: 5px 0px;
	}
	.card-text{
		font-size: 0.9rem;
	}
	</style>
</head>
<body>
    <h1>CodeIgniter - İyziCo (İyziPay) Ödeme APİ Kullanım Örneği, TEST ÜRÜN.</h1>
	<?php foreach($get_all as $product): ?>
	<div class="card">
		<div>
			<h4 class="card-title"><?php echo $product->product_name; ?></h4>
			<p class="card-text"><?php echo $product->product_description; ?></p>
			<a href="http://localhost/project/iyzipayCi/products/basket/<?php echo $product->product_id; ?>" class="btn btn-primary">Satın Al</a>
		</div>
	</div>
	<?php endforeach; ?>
</body>
</html>