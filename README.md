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
              Api dökümasyon sayfası - https://dev.iyzipay.com/tr
          </li>
          <li>
              Test bilgilerinizi oluşturmanız gereken sayfa - https://sandbox-merchant.iyzipay.com/
          </li>
          <li>
              Test ödemeler için kullanmanız gereken test kartları sayfası- https://dev.iyzipay.com/tr/test-kartlari
          </li>
      </ul>
  </div>
