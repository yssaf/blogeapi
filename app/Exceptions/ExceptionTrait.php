<?php

namespace App\Exceptions;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: sankarihf
 * Date: 29/08/2018
 * Time: 03:48 م
 */


trait ExceptionTrait
{

    public function apiException($request,$e)
    {

        if($this->isModel($e)){

            return $this->ModelResponse($e);

        }
        if($this->isHttp($e)){

            return $this->HttpResponse($e);

        }


        return parent::render($request, $exception);


    }



    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function ModelResponse($e)
    {
        return response()->json([

            'errors' => 'Product Model Not Found'

        ],Response::HTTP_NOT_FOUND);
    }


    protected function HttpResponse($e)
    {
        return response()->json([

            'errors' => 'Incorrect Route'

        ],Response::HTTP_NOT_FOUND);
    }



}