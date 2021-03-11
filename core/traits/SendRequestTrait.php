<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2019/5/12 4:58 PM
 * description:
 */

namespace app\core\traits;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;

trait SendRequestTrait
{
    /**
     * @param string $type
     * @param string $apiUrl
     * @param array $options
     * @return string
     * @throws ErrorException
     */
    protected function sendRequest(string $type, string $apiUrl, array $options = []): string
    {
        $data = ArrayHelper::getValue($options, 'query', []);
        $beginMillisecond = round(microtime(true) * 1000);
        try {
            $baseOptions = [
                'query' => $data,
                'timeout' => 10000, // Response timeout
                'connect_timeout' => 10000, // Connection timeout
            ];
            $client = new \GuzzleHttp\Client(['verify' => false]);
            $response = $client->request($type, $apiUrl, array_merge($baseOptions, $options));
            Yii::info(['url' => $apiUrl, $data, (array)$response], 'Curl 请求服务开始');
        } catch (\Exception $e) {
            Yii::error(['url' => $apiUrl, 'exception' => (string)$e, $data], 'Curl 请求服务异常');
            throw new ErrorException('Curl 请求异常:' . $e->getMessage(), 500001);
        }
        if ($response->getStatusCode() == 200) {
            // 记录 curl 耗时
            $endMillisecond = round(microtime(true) * 1000);
            $context = [
                'curlUrl' => $apiUrl,
                'CurlSpendingMillisecond' => $endMillisecond - $beginMillisecond
            ];
            Yii::info([$context, $data,], 'curl time consuming');
            return (string)$response->getBody();
        } else {
            Yii::error(['url' => $apiUrl, 'data' => $data], 'Curl 请求服务成功，但是操作失败');
            throw new ErrorException('Curl 请求服务成功，但是操作失败：');
        }
    }
}