<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/12
 * Time: 9:45
 */

namespace App\Http\Controllers;


use EasyWeChat\Foundation\Application;

class MaterialController extends Controller
{
    private $temporary;

    public function __construct(Application $app)
    {
        $this->temporary = $app->material_temporary;
    }

    // 上传图片
    public function uploadImg(){
        $result = $this->temporary->uploadImage(public_path().'/images/2.jpg');
        if(count($result) > 0){
            $content = $this->temporary->getStream($result['media_id']);
            file_put_contents(public_path().'/upload/images/2.jpg', $content);
        }
    }


}