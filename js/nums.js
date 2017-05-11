
function SendPost() {
    //отправл€ю POST запрос и получаю ответ
    $$a({
        type:'post',//тип запроса: get,post либо head
        url:'ajax.php',//url адрес файла обработчика
        data:{'z':'1'},//параметры запроса
        response:'text',//тип возвращаемого ответа text либо xml
        success:function (data) {//возвращаемый результат от сервера
            $$('result',$$('result').innerHTML+'<br />'+data);
        }
});
}
