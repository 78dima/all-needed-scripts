    <form class="<?=$com . ' ' . $form_params['class']; ?> с-form4" encoding="multipart/form-data" role="form" data-callibri_parse_form="true" data-toggle="validator" data-goal="form4">  
    <div class="<?=$com;?>__inner">      
        <? //title
            if (isset($title) ) { ?>
            
                <h5 class="<?=$com;?>__title title"><?=$title;?></h5>
            
        <? } ?>

        <? //desc
            if (isset($desc) ) { ?>
            <div class="<?=$com;?>__desc desc"><?=$desc;?></div>
        <? } ?>

        <? //fields ?>
        <div class="<?=$com;?>__main">
      
            <? $i=0; foreach ($fields as $name => $options) { 
                $type = $options["type"];
                $input_class = "{$com}__input c-form__input--{$name} g-input";
                $required = ''; 

                if ( ! $form_params['show_text_error'] ) 
                    $input_class .= ' no-text-error';

                if ( $options["required"] ) 
                    $required = ' aria-required="true" required';
            ?>
            <?php if ( $i % 3 == 0) { ?>
               
            <?php } ?>
                <div class="<?=$com;?>__item form-group">

                    <?php if ( isset($options["label"]) ) { ?>
                        <label class="<?=$com;?>__label"><?=$options["label"]; ?>
                    <?php } ?>

                    <?php 
                        switch ($type) {
                            case 'file': ?>
                                <label class="<?=$com;?>__label-foto">
                                    <input type="<?=$type;?>" name="<?=$name;?>" id="js-<?=$name;?>" class="<?=$input_class;?>" placeholder="<?=$options["placeholder"];?>" <?=$required;?>>
                                    Загрузить файл
                                </label>
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
                                <input type="<?=$type;?>" name="<?=$name;?>" id="<?=$name;?>" class="<?=$input_class;?>" placeholder="<?=$options["placeholder"];?>" <?=$required;?>>
                            <?php break;
                        }
                    ?>

                    <?php if ( isset($options["label"]) ) { ?>
                        </label>
                    <?php } ?>
                </div>
            <?php if ( $i % 3 == 2) { ?>
                
            <?php } ?>
            <? $i++;
            } ?>

                <? //btn ?>
                <div class="<?=$com;?>__item <?=$com;?>__inner-btn"><button type="submit" class="btn btn-submit <?=$com;?>__btn"><?=$btn;?></button></div>
                <div class="<?=$com;?>__item"><div class="<?=$com;?>__confident">
                <img class="<?=$com;?>__confident-img" src="/img/lock.svg" alt="">
                Гарантируем конфиденциальность данных</div></div>
                <div id="js-msg-submit" class="h3 d-none <?=$com;?>__msg g-form-msg"></div>
            
            
            </div>

            </div>  
        </div>  

    
    </form>