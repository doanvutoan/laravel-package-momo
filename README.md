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

## Test và sử dụng

```php
Route::get('/test-package-momo',function (){
    \Kilala\Momo\MomoFacade::helloWorld();
});
```