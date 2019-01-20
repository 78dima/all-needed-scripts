<?php
define("FORM", __DIR__ . DIRECTORY_SEPARATOR);
function form($view = '', $model = 1) {
    $dir =  FORM . 'model/model'.$model.'.json';
    $data_form = file_get_contents($dir);
    $data_form = json_decode($data_form, true);

    //print_r($data_form);
    // присваивание значений
    if(!is_null($data_form)) {
        foreach($data_form as $form_key => $form_val){
            $$form_key = $form_val;
        }
    }

    $form_params = array(
        'compontent' => 'c-form',
        'class' => 'form-validate',
        'show_text_error' => false,
    );

    //$form_class = 'form-validate';

    $com = $form_params['compontent'];

    switch ($view) {
        case 1:
            $form_params['class'] .= ' --black';
            require FORM . '/view/view.php';
        break;

        case 2:
            $form_params['class'] .= ' --white';
            require FORM . '/view/view2.php';
        break;

        case 3:
            $com .= '3';
            require FORM . '/view/view3.php';
        break;

        case 4:
            $com .= '4';
            require FORM . '/view/view4.php';
        break;
        
        default: 
            require FORM . '/view/view.php';
        break;
    }
} ?>