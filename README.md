<p align="center">
    <a href="https://github.com/laravel" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/958072" height="100px">
    </a>
    <h1 align="center">Laravel Omnipay</h1>
    <br>    
</p>

## Cài đặt

Cài đặt Laravel Omnipay thông qua [Composer](https://getcomposer.org):

```bash
composer require kilala/momo
```

Cấu hình biến môi trường trong file .env
```dotenv
MOMO_API=https://test-payment.momo.vn
MOMO_PARTNER=MOMOBKUN20180529
MOMO_ACCESS_KEY=klm05TvNBzhg7h7j
MOMO_SECRET_KEY=at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa
```

Đăng ký Service Provider trong file config/app.php

```php
'providers' => [
    ...,
    \Kilala\Momo\OmnipayServiceProvider::class,
],
'aliases' => [
    ...,
    'Momo'   =>  \Kilala\Momo\MomoFacade::class
]
```

## Chạy ứng dụng

```php
Route::get('/test-package-momo',function (){
    \Kilala\Momo\MomoFacade::helloWorld();
});
```

## Các bước thanh toán bằng Momo

```php
/*Chuyển hướng thanh toán bằng ứng dụng momo*/
\Kilala\Momo\MomoFacade::checkoutMomo([
    'redirectUrl'   => 'https://www.example.com/result',
    'ipnUrl'        => 'https://www.example.com/ipn',
    'orderInfo'     => 'đây là đơn hàng',
    'amount'        => '1000',
    'orderId'       => 'mahoadon001',
    'requestId'     => '55555555555555555',//(string)Str::orderedUuid()
    'extraData'     => 'thongtinthemvao',//base64_encode("{'a':'text','b':'text2',....}")
    'requestType'   => 'linkWallet',//"captureWallet | payWithATM | payWithMethod | linkWallet"
    'partnerClientId'=> 'abc@gmail.com',
]);
/*Kiểm tra kết quả trả về từ momo*/
\Kilala\Momo\MomoFacade::resultMomo([
    'requestId' => '666666666666666666',//(string)Str::orderedUuid()
    'orderId'   => 'mahoadon001',
]);
```