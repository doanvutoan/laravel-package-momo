<?php
namespace Kilala\Momo\Facades;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class MomoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'momo';
    }
    
    public function helloWorld()
    {
        echo "Hello, welcome to package support payment momo by developer kilala";
    }

    public function checkoutMomo($dataArr)
    {
        $endpoint = env('MOMO_API') . "/v2/gateway/api/create";
        $partnerCode = env('MOMO_PARTNER');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');
        $redirectUrl = $dataArr['redirectUrl'];
        $ipnUrl = $dataArr['ipnUrl'];
        //params
        $orderInfo = $dataArr['orderInfo'];
        $amount = $dataArr['amount'];
        $orderId = $dataArr['orderId'];
        $requestId = $dataArr['requestId'];
        $extraData = $dataArr['extraData'];
        $requestType = $dataArr['requestType'];
        $partnerClientId = $dataArr['partnerClientId'];

        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerClientId=" . $partnerClientId .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
//            'partnerName' => "Test",
//            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'partnerClientId' => $partnerClientId,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'lang' => App::currentLocale(),
            'signature' => $signature
        );

        $result = Http::post($endpoint, $data);
        $jsonResult = json_decode($result, true);  // decode json
        //Just a example, please check more in there
        header('Content-type: text/html; charset=utf-8');
        header('Location: ' . $jsonResult['payUrl']);
        exit();
    }

    public function resultMomo($dataArr)
    {
        $endpoint = env('MOMO_API') . "/v2/gateway/api/query";
        $partnerCode = env('MOMO_PARTNER');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');
        $requestId = $dataArr['requestId'];
        $orderId = $dataArr['orderId'];// Mã đơn hàng cần kiểm tra trạng thái

        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&orderId=" . $orderId . "&partnerCode=" . $partnerCode . "&requestId=" . $requestId;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'requestId' => $requestId,
            'orderId' => $orderId,
            'signature' => $signature,
            'lang' => App::currentLocale(),
        );
        //check result payment
        $result = Http::post($endpoint, $data);
        return json_decode($result, true);  // decode json
    }
}