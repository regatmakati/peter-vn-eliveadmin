<?php
require_once 'vendor/autoload.php';
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Common\Exception\TencentCloudSDKException;
use TencentCloud\Live\V20180801\LiveClient;
use TencentCloud\Live\V20180801\Models\DescribeLiveStreamStateRequest;
try {

    $cred = new Credential("AKIDz0qQluRPhjVyEE9fV5PUAakFaJrHQwIq", "nSxHRZJDzf5Nfh7HBqHWfYBYdS1KNbld");
    $httpProfile = new HttpProfile();
    $httpProfile->setEndpoint("live.tencentcloudapi.com");
      
    $clientProfile = new ClientProfile();
    $clientProfile->setHttpProfile($httpProfile);
    $client = new LiveClient($cred, "", $clientProfile);

    $req = new DescribeLiveStreamStateRequest();
    
    $params = array(
        "AppName" => "live",
        "DomainName" => "livepush.netipv6.com",
        "StreamName" => "20_1603024677"
    );
    $req->fromJsonString(json_encode($params));

    $resp = $client->DescribeLiveStreamState($req);

    print_r($resp->toJsonString());
}
catch(TencentCloudSDKException $e) {
    echo $e;
}
