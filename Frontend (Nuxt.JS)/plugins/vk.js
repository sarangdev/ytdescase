/* eslint-disable */
import VK from 'vk-openapi'
import $ from 'jquery'
import jQuery from 'jquery'
import axios from 'axios'
import sha1 from 'crypto-js/sha1'
import enc from 'crypto-js/enc-utf8'
VK.init({apiId: 7035278});
var ajax = window.ajax = axios.create({
    baseURL: process.env.apiUrl,
    headers: {'X-Token': getCookie('token') }
});
window.ajax = ajax;
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : 0;
}
self = this;
window.getCookie = getCookie;  
function auth (el)
{
    VK.Auth.login(function(response) {
        $(el).text('Загрузка...');
        $('.overlay').css('display', 'flex');
        if (response.session) {
      //  grecaptcha.execute('6Ley5qoUAAAAAHc5fWV9dej2Rqzv9lx-pJdksPg5').then(function(token) {
            var date = new Date();
            var secret = 'VK SECRET';
            var appid = 'VK ID';
            response.session.secret = sha1('(UID:'+response.session.mid+';TIME='+response.session.expire+';SECRET='+secret+';APPID='+appid+')');
            response.session.secret = response.session.secret.toString();
          //  response.session.recaptcha = token;
                ajax({
                method: 'post',
                url: '/socialLogin',
                data: JSON.stringify(response.session),
                }).then(function(result) {
                if (!result.data.error) {
                    if (result.data.token) {
                        $('.overlay').hide();
                        window.startNotifyClient(result.data.message);
                        document.cookie = "token="+result.data.token+"; path=/; expires=99999";
                        self.$nuxt.$router.replace({ path: '/' });
                        window.location.reload();
                    } else {
                        alert('Ошибка сервера');
                    }
                } else {
                    alert(result.data.error);
                }
            }).catch(function(error) {
                    window.startNotifyClient('Сервер недоступен, повторите попытку позже');
            });
      //  });
        } else {
            /* Пользователь нажал кнопку Отмена в окне авторизации */
            console.log('cancelled');
            $(el).text('Войти');
            $('.overlay').css('display', 'none');
        }
  });
}
window.auth = auth;