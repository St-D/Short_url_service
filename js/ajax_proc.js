$( document ).ready(function() {
    //проверка готовности :
    console.log('index готов к jQuery !');
    //~~~~~~~~~~~~~~~~~~~~~

    $("#btnSub").on('click.log', function()
        {
            sendAjaxFormReg('res_form', 'formForAjaxReq', 'create_short_url.php');
                        //'res_form' -  div для rendering результата
                        //'formForAjaxReg' -  id обрабатываемой формы
                        //'reg_ajax_form.php' -  контроллер
            return false; // не понял зачем тут возвращать false
        }
    );
});

// при error AJAX:
function getErAjaxReq(errStr, htmlId)
    {
    document.getElementById(htmlId).innerHTML = errStr;
    }

//AJAX:
function sendAjaxFormReg(result_form, ajax_form, url) {
    // формиование запроса AJAX:
    $.ajax({
        url:        url,
        type:       "POST",                                 //метод отправки
        //dataType:   "json",                               //формат данных c сервера
        data: $("#"+ajax_form).serialize(),                 //превращаем в строку
       // data: 'l_url=',                 //превращаем в строку
        success: function(response)
        {                       //обработка ответа сервера
            result = $.parseJSON(response);
            //console.log($("#"+ajax_form).serialize());
            console.log(result);

            // элементы с атрибутом placeholder в консоль:
            //$('input').each(function(){
            //    console.log($(this).attr('placeholder'));
            //});

            //пустые поля форм:
            if (result.db_er === 1)
                {
                    $('#error_area').show('slow');
                    document.getElementById('error_area').innerHTML =
                        '<h4>Enter URL in fields above</h4>';
                    //а также фокус в поле с длинным URL:
                    $("[placeholder = 'long URL']").focus();

                }
            //получен короткий URL:
            else if (result.db_er === 0)
                {
                    // поменяем атрибуты результата value:
                    $("[placeholder = 'short URL']").val(result.s_url);
                    $('#error_area').hide('slow');
                }
            //получен длинный URL:
            else if (result.db_er === 10)
                {
                    // поменяем атрибуты результата value:
                    $("[placeholder = 'long URL']").val(result.l_url);
                    $('#error_area').hide('slow');
                }
            //Оба адреса из БД:
            else if (result.db_er === 20)
                {
                    $('#error_area').show('slow');
                    document.getElementById('error_area').innerHTML =
                        '<h4>URLs is valid</h4>';
                }
            //длинный URL не прошел валидацию:
            else if (result.db_er === 2)
                {
                    $('#error_area').show('slow');
                    document.getElementById('error_area').innerHTML =
                        '<h4>Enter valid URL in fields above</h4>';
                    //а также фокус в поле с длинным URL:
                    $("[placeholder = 'long URL']").focus();
                }
            //нет ответа от сайта:
            else if (result.db_er === 3)
                {
                    $('#error_area').show('slow');
                    document.getElementById('error_area').innerHTML =
                        '<h4>Entered URL does not exist/responding</h4>';
                    //а также фокус в поле с длинным URL:
                    $("[placeholder = 'long URL']").focus();
                }
            //короткий URL не найден:
            else if (result.db_er === 4)
                {
                $('#error_area').show('slow');
                document.getElementById('error_area').innerHTML =
                    '<h4>Short URL not found</h4>';
                }

            else
            {
                $('#error_area').hide('slow');
                //$('#for_hide').show('slow');
            }
        },

        error: function ()
        {
            getErAjaxReq("Ошибка. Данные не отправленны (((.", result_form );
        }

    });
}
