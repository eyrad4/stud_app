<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Http\Response\JsonResponse;
use Mindk\Framework\Models\UserModel;

/**
 * Product controller
 *
 * Class ProductController
 * @package App\Controllers
 */
class ProductController
{
    /**
     * Products index page
     */
    function index(ProductModel $model){

        return $model->getList();
    }

    /**
     * Single product page
     *
     * @param   ProductModel
     * @param   int Product ID
     *
     * @return  mixed
     * @throws NotFoundException
     */
    function show(ProductModel $model, $id){

        $item = $model->load($id);

        // Check if record exists
        if(empty($item)) {
            throw new NotFoundException('Product with id ' . $id . ' not found');
        }

        return $item;
    }

    /**
     * Create product
     */
    function create(ProductModel $model, Request $request, UserModel $userModel){

        if($token = $request->getHeader('X-Auth')){
            if($user = $userModel->findByToken($token)){

                if($photoUpload = $this->upload($_FILES['photo'], '/uploads/ads/user_'.$user->id.'/')){
                  $photo = $photoUpload;
                }

                if(empty($photo)){
                    return new JsonResponse('Upload error', 401);
                }

                $params = [
                    'name' => $request->get('name', '', 'string'),
                    'text' => $request->get('text', '', 'string'),
                    'date' => date('Y-m-d'),
                    'price' => $request->get('price', '', 'string'),
                    'user_id' => $user->id,
                    'category' => $request->get('category', '', 'string'),
                    'photo' => $photo
                ];

                if($model->save($params)){
                    return new JsonResponse('true', 200);
                }
            }
        }

        if(empty($token) || empty($user)) {
            return new JsonResponse('Not found user id', 401);
        }
    }

    public function upload ($file, $folder) {

        $fileType = $file['type'];

        $allowedUploadFormats = array("image/jpeg", "image/gif", "image/png");
        if(!in_array($fileType, $allowedUploadFormats)) {
            return new JsonResponse('Only jpg, gif, png files are allowed.', 401);
        }

        $uploadDirRoot = $_SERVER['DOCUMENT_ROOT'].$folder;

        $uploadfile = $uploadDirRoot . basename($file['name']);


        if (!file_exists($uploadDirRoot)) {
            mkdir($uploadDirRoot, 0777);
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadfile)) {
            return $folder.$file['name'];
        }else{
            return new JsonResponse('Same error when file upload', 401);
        }

    }
}