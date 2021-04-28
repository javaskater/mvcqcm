<?php

class Main extends Controller{

    public function index($params1=null){
        if (isset($params1) && !empty($params1)){
            $typeErreur = $params1;
            $this->render('index', compact('typeErreur'));
        } else {
            $this->render('index');
        }
    }

}