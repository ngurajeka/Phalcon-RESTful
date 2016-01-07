<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {

    public function beforeExecuteRoute($dispatcher) {

        // This is executed before every found action
        if ($this->request->isOptions()) {
            $this->initialize();
            $this->response->send();
            return False;
        }
    }

    public function initialize() {

        // set response header, status code, content and access control
        $this->response->setHeader('Content-Type','application/json');
        $this->response->setStatusCode(200, "OK");
        $this->response->setJsonContent([
                "status" => 200,
                "message" => "OK",
            ]);
        $origin = $this->request->getHeader("ORIGIN") ? $this->request->getHeader("ORIGIN") : '*';
        $this->response
            ->setHeader("Access-Control-Allow-Origin", $origin)
            ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
            ->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization')
            ->setHeader("Access-Control-Allow-Credentials", true);

    }

    protected function setJsonResp($code=200,
                                   $message="OK",
                                   $errors=NULL,
                                   $data=NULL,
                                   $resp=NULL) {

        $this->response->setStatusCode($code, $message);

        if ($resp) {
            $this->response->setJsonContent($resp);
            return $this->response;
        }

        $resp = [
            'status' => $code,
            'message' => $message,
        ];

        if ($data) $resp['data'] = $data;
        if ($errors) $resp['errors'] = $errors;

        $this->response->setJsonContent($resp);
        return $this->response;
    }

    protected function redirect($code, $msg, $errors=NULL) {

        $this->dispatcher->setParams(['code' => $code, 'msg' => $msg, 'errors' => $errors]);
        return $this->dispatcher->forward(array('controller' => 'rest', 'action' => 'error'));
    }

}
