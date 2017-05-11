//
// function params_u(user) {
//     return user;
//
// }
//
// function params_key(key) {
//     return key;
// }

var gop = document.querySelector('.gop');



gop.addEventListener('click', function () {
    steps = 20;

    $.ajax({
        type: 'POST',
        url: '/inc.php',
        data: {key_y:key_y, user:user},

        success: function(data){
            $(".block").html(data);
        }
    });

    intervalID=setInterval(function counter(params_u, params_key){

        steps--;
        num = Math.floor(Math.random() * (10000 - 1 + 1)) + 1;

        if(num < 10 && num) {
            numm = '0000' + num;
        }else if(num >= 10 && num < 100){
            numm = '000' + num;
        }else if(num >= 100 && num < 1000){
            numm = '00' + num;
        }else if(num >= 1000 && num <10000){
            numm = '0' + num;
        }

        if(num < 2000){
            ask = 'Не переживай, повезет в следующий раз!';
        }else if(num > 2000 && num < 4000){
            ask = 'Бывало и хуже, давай еще!';
        }else if(num > 4000 && num < 6000){
            ask = 'Неплохо, но можно лучше!';
        }else if(num > 6000 && num < 8000){
            ask = 'Эх... То, да не то! Ну же, давай еще! ';
        }else if(num > 8000 && num < 9000){
            ask = '^_^, пробуй еще :)!';
        }else if(num > 9000 && num < 9500){
            ask = 'Вау, еще разок?';
        }else if(num > 9500 && num < 9900){
            ask = 'Вот так везение!';
        }else if(num > 9900 && num < 10000){
            ask = 'Эээ, так не честно, а-ну отдай!';
        }else if(num > 10000){
            ask = 'Эээ, так не честно, а-ну отдай!';
        }

        //первый блок
        document.querySelector('.counter h4').innerHTML = numm;

        console.log(steps);
        console.log(user);

        if(steps < 0){
            console.log(steps);
            clearInterval(intervalID);
            //первый блок, после остановки таймера инсертит
            document.querySelector('.counter_ask').innerHTML = ask;
            steps = 20;

            $.ajax({
                type: 'POST',
                url: '/inc.php',
                // url: '/pages/account/_nums.php',
                data: {
                    type: 2,
                    user: user,
                    key_k:key_k,
                    key_q:key_q,
                    key_z:key_z,
                    key_f:key_f,
                    key_m:key_m,
                    sum: numm
                },
                success: function(data){
                    $(".block").html(data);
                }
            });
        }

    },50);
});

function realtime() {
    time++;
    setInterval(realtime, 1000);
    document.querySelector('.time').innerHTML = time;
}