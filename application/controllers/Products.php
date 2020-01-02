<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$data['get_all'] = $this->db->from('products')->get()->result();
		$this->load->view('products', $data);
	}

	public function basket($id){
		$token = $this->input->post('token'); // Ödeme sonrası dönen token
		
		if(!empty($token)){

			IyzipayBootstrap::init();
			$option = new \Iyzipay\Options();
			$option->setApiKey("sandbox-dNkkrXV6vpHQ2rb1pCOoH3Li5W8s7gMh");
			$option->setSecretKey("sandbox-RyAiG87yEKi0xm6r5OgpfbsPIRYIpnp5");
			$option->setBaseUrl("https://sandbox-api.iyzipay.com");

			$return = new \Iyzipay\Request\RetrieveCheckoutFormRequest(); //Token derlemesi yapılıp işlemin onaylanıp onaylanmadığını bildirir
			$return->setLocale(\Iyzipay\Model\Locale::TR);
			$return->setToken($token);
	
			$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($return, $option);

			$request = $checkoutForm;

			if($request->getPaymentStatus() === "SUCCESS"){
				/**
				 * Olumlu sonuç alınmış ödeme aktarılmıştır.
				 * Gerekli işlemlerinizi yapabilirsiniz.
				 * Ürünleri teslimatı vs. veritabanı işlemlerinizi
				 * print_r($request) 'i basarak üretilen benzersiz ürün koduna falan erişebilirsiniz.
				 */
			} else {
				/**
				 * Uyarı vermek isterseniz burayı kullanabilirsiniz.
				 */
			}

		} else {
			$get_item = $this->db->get_where('products', array('product_id' => $id))->row();

			if(!empty($get_item)){
				$data['get_item'] = $get_item;
				$data['iyzico'] = $this->iyzico_trigger($get_item);
				$this->load->view('basket', $data);
			} else {
				redirect('products');
			}
		}
		
	}

	function iyzico_trigger($products){
        IyzipayBootstrap::init();

        if(!empty($products)){
			$iyzico = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest(); // İyziPay Form tetiklemesi için gerekli bilgiler
			$iyzico->setLocale(\Iyzipay\Model\Locale::TR);
			$iyzico->setConversationId($products->product_code); //Benzersiz oluşturulması gereken ürün kodu
			$iyzico->setPrice($products->product_amount); // Ürün fiyatı 
			$iyzico->setPaidPrice($products->product_amount); // Ödenecek ürün fiyatı (burası çekim işleminde tetiklenecek alan)
			$iyzico->setCurrency(\Iyzipay\Model\Currency::TL); // Ödeme şeklini belirtmek için kullanılır
			$iyzico->setBasketId($products->product_code); // Sipariş kodu, ürün kodu geri dönüş olarak gelmektedir.
			$iyzico->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT); // Ürün bilgilerini tetiklemesi
			$iyzico->setCallbackUrl("http://localhost/project/iyzipayCi/products/basket/".$products->product_id); // Formun oluşturması için kullanılan geri dönüş URL adresi

			$buyer = new \Iyzipay\Model\Buyer(); // Müşteri bilgilerinin oluşturulması
			$buyer->setId("1"); // Müşteri bazındaki ID 
			$buyer->setName("Müşteri Adı"); // Müşteri Adı
			$buyer->setSurname("Müşteri Soyadı"); // Müşteri Soyadı
			$buyer->setGsmNumber("Müşteri Telefon Numarası"); // Müşteri Telefon Numarası
			$buyer->setEmail("test@123.com"); // test@123.com
			$buyer->setIdentityNumber("00000000000"); // Müşteri TC Kimlik Numarası (zorunluluk sistem sahibine ait.)
			$buyer->setLastLoginDate(date('Y-m-d H:i:s')); // Müşteri Son giriş
			$buyer->setRegistrationDate(date('Y-m-d H:i:s')); // Müşteri Sipariş (Kayıt) Tarihi
			$buyer->setRegistrationAddress("Bursa"); // Müşteri Sipariş (Kayıt) Adresi
			$buyer->setIp($this->input->ip_address()); // Müşteri IP Adresi
			$buyer->setCity("Bursa"); // Müşteri İl
			$buyer->setCountry("Bursa"); // Müşteri İlçe
			$buyer->setZipCode("16000"); // Müşteri Posta Kodu
			$iyzico->setBuyer($buyer); // Müşteri sipariş (Sepet, ürün) bilgileri tetikletme

			$shippingAddress = new \Iyzipay\Model\Address(); // Müşteri kargo bilgilerinin oluşturulması
			$shippingAddress->setContactName("Müşteri Adı"); // Müşteri Adı
			$shippingAddress->setCity("Bursa"); // Müşteri İl
			$shippingAddress->setCountry("Bursa"); // Müşteri İlçe
			$shippingAddress->setAddress("Bursa"); // Müşteri Adresi
			$shippingAddress->setZipCode("16000"); // Müşteri Posta Kodu
			$iyzico->setShippingAddress($shippingAddress); // Sipariş kargo bilgileri tetikletme

			$billingAddress = new \Iyzipay\Model\Address(); //Fatura bilgileri için istenilen bilgiler
			$billingAddress->setContactName("Müşteri Adı"); // Müşteri Adı
			$billingAddress->setCity("Bursa"); // Müşteri İl
			$billingAddress->setCountry("Bursa"); // Müşteri İlçe
			$billingAddress->setAddress("Bursa"); // Müşteri Adresi
			$billingAddress->setZipCode("16000"); // Müşteri Posta Kodu
			$iyzico->setBillingAddress($billingAddress); // Gerekli tetikleme
			
			
			/**
			 * Burada $firstBasketItem kendimizin tanımladığı bir değişken tetiklemesidir.
			 * 1 den fazla ürün ekleyebilirsiniz tek dikkat edilmesi gerekilen nokta
			 * basketItems[] arrayını düzgün oluşturarak ürün1,ürün2,ürün3 vb. set yapmanız
			 */
			$basketItems = array(); 
			$firstBasketItem = new \Iyzipay\Model\BasketItem(); // Ürün listesi için gerekli tetiklemeler 
			$firstBasketItem->setId($products->product_code); // Benzersiz oluşturulan ürün kodu
			$firstBasketItem->setName($products->product_name); // Ürün adı
			$firstBasketItem->setCategory1($products->product_name); // Ürün Kategorisi
			$firstBasketItem->setCategory2($products->product_name); // Ürün Kategorisi 2
			$firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
			$firstBasketItem->setPrice($products->product_amount); // Ürün fiyatı (indirim vs işlemlerde güncel olarak)
			$basketItems[0] = $firstBasketItem;
			$iyzico->setBasketItems($basketItems);

			$option = new \Iyzipay\Options(); // Api bilgleri için gerekli ayarları tetikletme Api Key, Api Secret.
			$option->setApiKey("sandbox-dNkkrXV6vpHQ2rb1pCOoH3Li5W8s7gMh"); // Api Key
			$option->setSecretKey("sandbox-RyAiG87yEKi0xm6r5OgpfbsPIRYIpnp5"); // Api Secret Key
			$option->setBaseUrl("https://sandbox-api.iyzipay.com"); // Apinin istek atacağı URL değiştirmeyin

			$checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($iyzico, $option); // gerekli ürün bilgileri ve ayarlar ile api tetikleme.
			
			return $checkoutFormInitialize; // Api tarafından yapılan isteğin dönüş bilgileri
        }
    }

}
