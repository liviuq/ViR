<?php

class RestController
{
    private $requestMethod;
    private $catId;

    private $catsArray = array("Cat 1","Cat 2","Cat 3");

    /**
     * @param $requestMethod
     * @param $catId
     */
    public function __construct($requestMethod, $catId)
    {
        $this->requestMethod = $requestMethod;
        $this->catId = $catId;
    }

    public function processRequest() {

        switch ($this->requestMethod) {
            case 'GET':
                if ($this->catId) {
                    $response = $this->getCat($this -> catId);
                } else {
                    $response = $this->getAllCats();
                };
                break;
            case 'POST':
                $entityBody = file_get_contents('php://input');
                if ($this->catId) {
                    $response = $this -> postCat($entityBody, $this-> catId);
                } else {
                    $response = $this->postListCats($entityBody);
                }
                break;
            case 'PUT':
                $entityBody = file_get_contents('php://input');
                if ($this->catId) {
                    $response = $this->putCat($entityBody, $this->catId);
                } else {
                    $response = $this->putCats($entityBody);
                }
                break;
            case 'DELETE':
                if ($this->catId) {
                    $response = $this->deleteCat($this->catId);
                } else {
                    $response = $this->deleteListCats();
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        header($response['content_type_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getCat($id)
    {
        $result = $this ->catsArray[$id-1];;
        if (! $result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getAllCats()
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';
        $result = array();
        foreach($this ->catsArray as $key => $value) {
            array_push($result, array($key+1 => $value));
        }
        $response['body'] = json_encode($result);
        return $response;
    }

    private function postListCats($entityBody) {
        $response['status_code_header'] = 'HTTP/1.1 201 CREATED';
        $response['content_type_header'] = 'Content-Type: application/json';
        $catsList = json_decode($entityBody);
        foreach ($catsList as $cat) {
            array_push($this->catsArray,$cat);
        }
        //print_r($this->catsArray);
        $result = array("Result"=>"Cats created");
        $response['body'] = json_encode($result);
        return $response;
    }

    private function postCat($entityBody, $id) {
        $response['status_code_header'] = 'HTTP/1.1 201 CREATED';
        $response['content_type_header'] = 'Content-Type: application/json';
        array_push($this->catsArray,json_decode($entityBody));
        print_r($this->catsArray);
        $result = array("Result"=>"Cat created");
        $response['body'] = json_encode($result);
        return $response;
    }

    private function putCat($entityBody, $id) {
        $response['status_code_header'] = 'HTTP/1.1 201 CREATED';
        $response['content_type_header'] = 'Content-Type: application/json';
        // TODO: De adaugat
        return $response;
    }

    private function putCats($entityBody) {
        $response['status_code_header'] = 'HTTP/1.1 201 CREATED';
        $response['content_type_header'] = 'Content-Type: application/json';
        // TODO: De adaugat
        return $response;
    }

    public function deleteListCats() {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        unset($this -> catsArray);
        print_r($this->catsArray);
        $result = array("Result"=>"All cats deleted");
        $response['body'] = json_encode($result);
        return $response;
    }

    public function deleteCat($id) {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['content_type_header'] = 'Content-Type: application/json';
        if (count($this->catsArray) + 1 > $id) {
            unset($this->catsArray[$id - 1]);
            print_r($this->catsArray);
            $result = array("Result"=>"Cat removed deleted");
            $response['body'] = json_encode($result);
        }
        else {
            $response = $this -> notFoundResponse();
        }
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['content_type_header'] = 'Content-Type: application/json';
        $response['body'] = json_encode(array("Result"=>"Not Found"));
        return $response;
    }

}