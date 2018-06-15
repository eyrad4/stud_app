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
    function index(ProductModel $model, Request $request){

        return $model->select('*', '`typead_id` = 2', 'price DESC, date DESC', 16);

        //return $model->getList();
    }

    /**
     * Products index page
     */
    function products(ProductModel $model, Request $request){

        $where = [];
        if(!empty($request->get('category', '', 'integer'))) {
            $where[] = '`category_id` = '.$request->get('category', '', 'integer');
        }
        if(!empty($request->get('f_cities', '', 'array'))) {
            $where[] = '`city_id` IN ('.implode(',', $request->get('f_cities', '', 'array')).')';
        }
        if(!empty($request->get('f_vip', '', 'string'))) {
            $where[] = '`typead_id` = 2';
        }
        if(!empty($request->get('f_my', '', 'integer'))) {
            $where[] = '`user_id` = '.$request->get('f_my', '', 'integer');
        }
        if(!empty($request->get('limit', '', 'integer'))) $limit = $request->get('limit', '', 'integer');
        if(!empty($request->get('sort', '', 'string'))) $sort = $request->get('sort', '', 'string');

        if(!empty($where)){
            $where = implode(' AND ', $where);
        }else{
            $where = '';
        }
        return $model->select('*', $where, $sort, $limit);
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

                $params = [
                    'name' => $request->get('name', '', 'string'),
                    'text' => $request->get('text', '', 'string'),
                    'date' => date('Y-m-d'),
                    'price' => $request->get('price', '', 'string'),
                    'user_id' => $user->id,
                    'category_id' => $request->get('category_id', '', 'string'),
                    'city_id' => $request->get('city_id', '', 'string'),
                    'typead_id' => $request->get('typead_id', '', 'string'),
                    'publiched' => 1,
                    'status' => 1
                ];

                if(!empty($_FILES['photo'])){
                    if($photoUpload = $this->upload($_FILES['photo'], '/uploads/ads/user_'.$user->id.'/')){
                        $photo = $photoUpload;
                    }
                    if(empty($photo)){
                        return new JsonResponse('Upload error', 401);
                    }
                    $params['photo'] = $photo;
                }

                if(!empty($request->get('id', '', 'integer'))){
                    $where = ($request->get('id', '', 'integer')) ? '`id` = '.$request->get('id', '', 'integer') : '';

                    if($model->save($params, $where)){
                        return $this->show($model, $request->get('id', '', 'integer'));
                    }
                }else{
                    if($model->save($params)){
                        return new JsonResponse('ok', 200);
                    }


                }

            }
        }

        if(empty($token) || empty($user)) {
            return new JsonResponse('Not found user id', 401);
        }
    }

    /**
     * Upload image
     */
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

        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
            return $folder.$file['name'];
        }else{
            return new JsonResponse('Same error when file upload', 401);
        }

    }

    public function searchResults (ProductModel $model, $search){

        $search = filter_var($search, FILTER_SANITIZE_STRING);

        if(!empty($search)) {
            $search = 'MATCH (name,text) AGAINST ("'.$search.'")';
            return $model->select('*', $search, 'date DESC', 20);
        }

    }
}