(function ($) {
    "use strict";

    /*----------------------------------------------------*/
    /*  AddProducts
    /*----------------------------------------------------*/    

    $(function () {
        let formCheck = $('.c-interesting__form--checkboxes');
        let formSend = formCheck.closest('[class*=col-]').next().find('form').first();

        formCheck.on('change', function () {
            let fileds = $(this).serializeArray();
            let count = fileds.length;
            let products = '';
            $.each( fileds, function( i, field ) {
                products += field.value;

                if ( i < count - 1 )
                    products += ', ';
            });

            formSend.find('[name="product"]').val(products);
        });

    });

    /*----------------------------------------------------*/
    /*	File
    /*----------------------------------------------------*/

    $(document).ready(function () {
        $(".c-file-load").find("input[type='file']").change(function () {
            var parent = $(this).closest('.c-file-load'),
                filename = $(this).val().replace(/.*\\/, ""),
                text = parent.find('.c-file-load__text').text(),
                textOriginal = $(this).data('text'),
                textLoad = "Файл загружен";

            if (text !== textLoad)
                $(this).data('text', text);

            if (filename != '') {
                $(this).addClass('is-load');
                parent.find('.c-file-load__text').text(textLoad);
            } else {
                $(this).removeClass('is-load');
                parent.find('.c-file-load__text').text(textOriginal);
            }

            if (!parent.find('*').is('.c-file-load__name'))
                parent.append("<div class='c-file-load__name'></div>");

            $(".c-file-load__name").text(filename);
        });
    });

    /*----------------------------------------------------*/
    /*	Form
    /*----------------------------------------------------*/

    function closeFancybox() {
        $.fancybox.close(true);
    }

    function submitMSG(form, valid, msg) {
        if (valid) {
            $('.c-modal.--success').fadeIn().delay(2000).fadeOut();
        } else {
            $('.c-modal.--error').fadeIn().delay(2000).fadeOut();
        }    
    }

    function formSuccess(form) {
        var goal = $(form).data('goal');
        //yaCounter50697688.reachGoal(goal);

        $(form).find('input').val('');

        submitMSG(form, true, "Сообщение отправлено");

        if ($(form).parents().hasClass('fancybox-container')) {
            setTimeout(closeFancybox, 3000);
        }
    }

    function formError(form) {
        submitMSG(form, false, "Ошибка отправки");    
    }

    function formSubmit(form) {
        var formFields = $(form).serialize(),
            formFieldsArray = $(form).serializeArray();

        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: "/inc/form/send.php",
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            /*beforeSend: function() {
                console.log(formData);
            },*/
            success: function (response) {
                if (response["success"] === true) {
                     //lead
//                     var params = {
//                         lead: 1, metrika_client_id:yaCounter51522278.getClientID()
//                     };

                if(formFieldsArray[2] && formFieldsArray[2].name == 'contentHeight') {
                        
                    var params = {
                    lead: 1, comment: 'Ширина: '+formFieldsArray[3].value+'см, Высота: '+formFieldsArray[2].value+'см, Толщина: '  + formFieldsArray[4].value + 'мкм, Тираж: ' + formFieldsArray[5].value + 'шт.', metrika_client_id:yaCounter51522278.getClientID()
                    };
                
                    } else {

                    var params = {
                    lead: 1, comment: '', metrika_client_id:yaCounter51522278.getClientID()
                    };			
                
                    }
		     
		     
		     console.log(formFieldsArray);
                     $.each(formFieldsArray, function () {
                         if (this.value) {
                             params[this.name] = this.value;
                             
                         }
                     });

                     $.post(
                         "/lead.php",
                         params,
                         function (id) {
                             if (id) {
                                 console.log(id);
                                 //yaCounter50697688.params({'wbooster': id});
                             }
                         }

                     );
                    formSuccess(form);


                } else {
                    //console.log(response["message"]);
                    formError(form);
                }
            },
            error: function () {
                formError(form);
            }
        });

        return false;
    }

    $.each($(".form-validate"), function () {
        $(this).validate({
            errorClass: "c-form__input-error",
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass("--error").removeClass("--success");
            },
            // unhighlight: function (element, errorClass, validClass) {
            //     $( element ).addClass("--success").revomeClass('--error');
            // },
            submitHandler: function (form) {
                formSubmit(form);
            }
        });
    });


    $(".c-specialist").on('click', '.btn', function(){
        var name = $(this).data('name');
        console.log(name);
     });
})(jQuery);
