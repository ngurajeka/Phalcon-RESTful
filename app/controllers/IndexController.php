<?php

namespace App\Controllers;

class IndexController extends ControllerBase {

    public function indexAction() {

        return $this->setJsonResp($code=200,
                                  $message="HELLOOO DUDE");
    }

    public function errorAction() {

        $params = $this->dispatcher->getParams();
        $msg = (isset($params['msg'])) ? $params['msg'] : 'Permintaan anda tidak ditemukan.';
        $code = (isset($params['code'])) ? $params['code'] : 404;
        $errors = (isset($params['errors'])) ? $params['errors'] : NULL;

        $resp = [
            'status' => [
                'error' => [
                    'message' => $msg
                ],
            ]
        ];

        if ($errors) {
            if (count($errors) == count($errors, COUNT_RECURSIVE))
                $resp['status']['error']['message'] = $errors['message'];
            else
                $resp['status']['error']['errors'] = $errors;
        }

        return $this->setJsonResp($code, $msg, NULL, NULL, $resp);
    }

}

