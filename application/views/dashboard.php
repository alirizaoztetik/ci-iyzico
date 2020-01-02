<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>İyziCo / İyziPay - CodeIgniter Entegre Örneği</title>
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
	</style>
</head>
<body>
    <h1>CodeIgniter - İyziCo (İyziPay) Ödeme APİ Kullanım Örneği.</h1>

    <p>
        Bu örnek sadece basit bir zemin üzerine hazırlanmış olup, paylaşıma sunulmuştur.
        Gerekli örneği inceleyerek kendi sistemleriniz üzerinde derleme, tetikleme yaparak kullanma fırsatını
        yakalayabilirsiniz.
    </p>

    <h3>Gerekli Bilgilendirmeler</h3>
    <div style="padding:0px 10px;">
        <h4>İncelemeniz ve güncellemeniz gereken dosyalar</h4>
        <ul>
            <li>
                <b>iyzipay > .htaccess</b> -
                Basit url rewite kodları mevcut
            </li>
            <li>
                <b>application > config > autoload.php</b> -
                Burada yapılan tek işlem izyipay klasörünün libraries olarak load yapılması.
            </li>
            <li>
                <b>application > config > database.php</b> -
                Örnek veritabanını kurup, buraları editlemelisiniz.
            </li>
            <li>
                <b>application > libraries > iyzipay</b> -
                Bu örnekte iyzipay (co) dosyalarımı libraries klasöründe tutmayı seçtim.
                Duruma göre değiştirme şansınız mevcuttur, en basit ve en temiz hali olan bir örnektir.
            </li>
            <li>
                <b>application > controllers > Products.php</b> -
                Gerekli iyzipay tetiklenmesi ve ürün alımının örnek kodlarını içeren kontroller dosyası.
            </li>
            <li>
                <b>application > controllers > Dashboard.php</b> -
                Varsayılan yüklenen ilk kontroller
            </li>
            <li>
                <b>application > views > product.php</b> -
                Ürünlerin listelendiği örnek ana sayfa
            </li>
            <li>
                <b>application > views > basket.php</b> -
                Ürün detayı veya sepet gibi görebilirsiniz. Ödeme işleminin tetiklendiği sayfa.
            </li>
			<li>
                <b>NOT !</b> -
                HTML içerisindeki yönlenen linkleri lütfen kendinize göre derleyip, düzenleyin.
            </li>
        </ul>
    </div>
    <div style="padding:0px 10px;">
        <h4>İyziPay (Co) Bilgileri</h4>
        <ul>
            <li>
                Api dökümasyon sayfası için -
                <a href="https://dev.iyzipay.com/tr" target="_blank"><b>Tıklayın</b></a>
            </li>
            <li>
                Test bilgilerinizi oluşturmanız gereken sayfa için -
                <a href="https://sandbox-merchant.iyzipay.com/" target="_blank"><b>Tıklayın</b></a>
            </li>
            <li>
                Test ödemeler için kullanmanız gereken test kartları sayfası için -
                <a href="https://dev.iyzipay.com/tr/test-kartlari" target="_blank"><b>Tıklayın</b></a>
            </li>
        </ul>
    </div>

    <div style="padding:0px 10px; margin-top:20px;">
        <h2>Örnek ödeme sayfası için <a href="http://localhost/project/iyzipayCi/products"><b>Tıklayın</b></a></h2>
    </div>
</body>
</html>