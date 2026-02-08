<?php

namespace plugins\huawei;
require CMF_ROOT . 'vendor/autoload.php';
use Obs\ObsClient;
use Obs\ObsException;


class Huawei
{


    private $config;

    private $storageRoot;

    /**
     * @var \plugins\qiniu\QiniuPlugin
     */

    /**
     * Qiniu constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = cmf_get_option('huawei');
        $this->storageRoot = $this->config['domain']."/";
    }




    /**
     * 文件上传
     * @param string $file     上传文件路径
     * @param string $filePath 文件路径相对于upload目录
     * @param string $fileType 文件类型,image,video,audio,file
     * @param array  $param    额外参数
     * @return mixed
     */
    public function upload($file, $filePath, $fileType = 'image', $param = null)
    {

        $obsClient = new ObsClient([
            'key' => $this->config['accessKey'],
            'secret' => $this->config['secretKey'],
            'endpoint' => $this->config['endPoint']
        ]);
        $resp = $obsClient->putObject([
            'Bucket' => $this->config['Bucket'],
            'Key' => $file,
            'SourceFile' => $filePath  // localfile为待上传的本地文件路径，需要指定到具体的文件名
        ]);


        return [
            'preview_url' => $this->storageRoot.$file,
            'url'         => $this->storageRoot.$file,
        ];
    }

    /**
     * 获取图片预览地址
     * @param string $file
     * @param string $style
     * @return mixed
     */
    public function getPreviewUrl($file, $style = 'watermark')
    {
        $url = $this->getUrl($file, $style);

        return $url;
    }

    /**
     * 获取图片地址
     * @param string $file
     * @param string $style
     * @return mixed
     */
    public function getImageUrl($file, $style = 'watermark')
    {
        $config = $this->config;
        $url    = $this->storageRoot . $file;

        if (!empty($style)) {
            //$url = $url . $config['style_separator'] . $style;
        }

        return $url;
    }

    /**
     * 获取文件地址
     * @param string $file
     * @param string $style
     * @return mixed
     */
    public function getUrl($file, $style = '')
    {
        $config = $this->config;
        $url    = $this->storageRoot . $file;

        if (!empty($style)) {
            //$url = $url . $config['style_separator'] . $style;
        }

        return $url;
    }

    /**
     * 获取云存储域名
     * @return mixed
     */
    public function getDomain()
    {
        return $this->config['domain'];
    }







}