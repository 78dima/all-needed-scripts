<?php $goal = isset( $goal ) ? $goal : "form1";?>
<form class="<?=$com . ' ' . $form_params['class']; ?>" encoding="multipart/form-data" role="form" data-callibri_parse_form="true" data-toggle="validator" data-goal="<?=$goal;?>">  

<div class="<?=$com;?>__content">

   <!--      <div class="<?=$com;?>__wrap-img">
        <img src="/img/paket.png" class="<?=$com;?>__img">
        </div> -->

    <? //title
        if (isset($title) ) { ?>
        <div class="<?=$com;?>__inner">
        <div class="<?=$com;?>__title --gray title"><?=$title;?></div>
        </div>
    <? } ?>

    <? //desc
        if (isset($desc) ) { ?>
        <div class="<?=$com;?>__inner">
        <div class="<?=$com;?>__descr desc"><?=$desc;?></div>
        </div>
    <? } ?>

    <? //fields ?>
    <div class="<?=$com;?>__inner">
        <? foreach ($fields as $name => $options) { 
            $type = $options["type"];
            $input_class = "{$com}__input c-form__input--{$name}";
            $required = ''; 

            if ( ! $form_params['show_text_error'] ) 
                $input_class .= ' no-text-error';

            if ( $options["required"] ) 
                $required = ' aria-required="true" required';
        ?>
            <div class="<?=$com;?>__item">

                <?php if ( isset($options["label"]) ) { ?>
                    <label class="<?=$com;?>__label"><div class="input_title"> <?=$options["label"]; ?></div>
                <?php } ?>

                <?php
                    switch ($type) {
                        case 'file': ?>
                            <label class="<?=$com;?>__label-foto">
                                <input type="<?=$type;?>" name="<?=$name;?>" id="js-<?=$name;?>" class="<?=$input_class;?>" placeholder="<?=$options["placeholder"];?>" <?=$required;?>>
                                Загрузить файл
                            </label>
                        <?php break;

                        case 'textarea': ?>
                            <textarea type="<?=$type;?>" name="<?=$name;?>" id="<?=$name;?>" class="<?=$input_class;?>" placeholder="<?=$options["placeholder"];?>" <?=$required;?>></textarea>
                        <?php break;

                        case 'select': ?>
                            <select name="<?=$name;?>" class="<?=$com;?>__<?=$type;?>" id="js-<?=$name;?>" <?=$required;?>>
                                <option>Выбрать ...</option>
                                <?php foreach($options["values"] as $value => $text) { ?>
                                    <option placeholder="<?=$value;?>"><?=$text;?></option>
                                <?php } ?>
                            </select>
                        <?php break;
                            
                        default: ?>
                            <input type="<?=$type;?>" name="<?=$name;?>" value="<?=$value;?>" id="<?=$name;?>" class="<?=$input_class;?>" placeholder="<?=$options["placeholder"];?>" <?=$required;?>>
                        <?php break;
                    }
                ?>

                <?php if ( isset($options["label"]) ) { ?>
                    </label>
                <?php } ?>

            </div>
        <? } ?> 

    <? //btn ?>

    <div class="<?=$com;?>__item form_button"><button type="submit" class="btn btn--lg btn--submit <?=$com;?>__btn"><?=$btn;?></button></div>    
    <div class="<?=$com;?>__item">
    <div class="<?=$com;?>__conf">
    <img src="/img/conf.svg" alt="" class="<?=$com;?>__conf-img">
    Мы гарантируем конфиденциальность данных</div>
                </div>
    <div id="js-msg-submit" class="h3 d-none <?=$com;?>__msg g-form-msg"></div>
</div>
                </div>
</form>