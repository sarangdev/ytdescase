<template>
<div>
    <div class="promout p1">
        <p><b>Акция!</b> Пополни счет (на сумму не менее 100 рублей) и получи +50 рублей на счет!<br>
        </p>
    </div>
    <!-- div class="promout full hidden" id="nomobile">
        <p>К сожалению, мобильные устройства в данный момент не поддерживаются нашим сайтом. В скором времени это будет исправлено.</p>
    </div>  -->
    <div class="header">
        <div class="notifications"></div>
        <div class="header__main">
            <Nuxt-link to="/" class="logo"><img src="/logo.png"></Nuxt-link>
        <div class="center" :style="username ? 'width: 33%;' : ''">
            <Nuxt-link class="ripple" to="/#cases">Кейсы</Nuxt-link>
            <Nuxt-link class="ripple" to="/mines">Мины</Nuxt-link>
            <a class="ripple" href="https://vk.com/ytdescase" target="_blank">VK</a>
        </div>
        <div class="right">
            <span v-if="username" class="moneybal"><span style="padding: 1px 7px 4px;">{{ bal }}₽</span><span class="trig" style="padding: 1px 6px 4px;" onclick="window.nuxt.$nuxt.$router.replace({ path: '/addbalance' });">+</span></span>
            <Nuxt-link class="ripple" to="/ministrpanel" v-if="admin == 1">Админка</Nuxt-link>
            <Nuxt-link class="ripple" styl to="/account" v-if="username">Аккаунт</Nuxt-link>
            <a href="#" class="ripple" v-on:click="logout" v-if="username">Выйти</a>
            <a href="#" class="ripple login1" v-on:click="login" v-if="!username">Войти через ВК</a>
        </div>
        </div>
    </div>
    <div class="overlay"><div id="loading"></div></div>
</div>
</template>
<style lang="sass">
    .moneybal
        color: white
        background: #cd595e
        padding: 1px 1px 4px
        font-size: 23px
        margin: 0px 0 0
        font-weight: 300
    
    // PROMOUT
    .promout
        background: red
    .promout p
        padding: 0.5em 1em 0.5em
        color: white
        margin: 0
    .promout.p1
        background: #e25e64
        p
            text-align: center
            padding: 10px 0 10px
    .promout.full
        width: 100%
        z-index: 99999
        height: 100%
        position: absolute
        top: 0
        left: 0
        p
            font-size: 25px
            display: flex
            justify-content: center
            align-items: center
            height: 100%
            margin: 0
    .promout.hidden
        display: none

    // MOBILE RESTRICT
    @media screen and (max-width: 1024px)
        #nomobile
            display: block !important
        .header__main
            flex-direction: column
            height: unset !important
            align-items: center
        .header .logo
            margin-left: 0em !important
        .header
            height: fit-content !important
        .header .center
            width: 100% !important
        .header .logo img
            margin: 1em 0 0
        .header .right
            margin-top: 1em !important
            margin-bottom: 1em !important
            margin-right: 0 !important
            flex-wrap: wrap
        .header .moneybal
            width: 91%
            font-size: 28px
            text-align: center
        .header .right a
            margin-left: 0 !important
            margin-right: 0 !important
            margin-top: 10px
        .header.fixed .right
            display: none
        .caseInfo h1
            font-size: 35px
        .notifications
            max-width: 17em !important
        a.tooltip:hover span
            position: absolute
            margin-top: 31px
            left: 0
    //    body, html, .main, #layout, #__nuxt
    //        overflow: hidden



    .trig
        cursor: pointer
        background: #ffffff63
        font-weight: 600

    /* overlay */
    .overlay
        background: #191818a6
        width: 100%
        display: none
        height: 100%
        position: fixed
        z-index: 50
        top: 0
        left: 0
        justify-content: center
        align-items: center
    .overlay.showed
        display: flex
    #over1 .close
        position: absolute
        top: 20px
        right: 50px
        font-size: 40px
        font-weight: 300
        color: white
        cursor: pointer
    #vkWrite
        color: white
        padding: 0 8em 0
        background: #b7353b
    .header
        height: 77px
        transition: 0.3s ease-out
        box-shadow: 0 19px 15px rgba(0,0,0,0.08), 0 15px 9px rgba(0,0,0,0.08)
        background: #c6464c
    .header__main
        height: 77px
        display: flex
        justify-content: center
    .header__main .center
        width: 49%
        display: flex
        align-items: center
        justify-content: center
    .header__main .center a
        margin-right: 17px
        font-size: 21px
        padding: 0 12px 0
        color: white
        align-items: center
        display: flex
        height: 76px
        font-weight: 300
        border-bottom: 2px solid #fe695a
        transition: 0.3s ease-out
    .header__main .center a:hover
        border-bottom: 3px solid #fe695a
        color: #fefefe
        height: 76px
        text-shadow: 0 0 7px #ffb2b2
    .header.fixed .header__main
        .center a
            height: 73px
        .center a:hover
            height: 72px
    .header.fixed
        position: fixed
        top: 0
        left: 0
        width: 100%
        z-index: 500
        top: -10px
        height: 75px
    .header.fixed .header__main
        height: 75px
    .header .logo
        display: flex
        align-items: center
        transition: 0.3s ease-out
    .header .logo img
        width: 236px
    .header .logo:hover
        //background: url(/logo2.png)
        //background-size: cover
        transform: scale(1.02)
    .header .left
        float: left
        display: flex
    .header .right
        float: right
        display: -webkit-flex
        display: flex
        justify-content: center
        align-items: center
        height: 100%
    .header .left a, .header .right a
        padding: 11px 27px 11px
        display: flex
        margin-left: 76px
        font-weight: 600
        border-radius: 3px
        box-shadow: 0 0 10px rgba(36, 24, 24, 0.09)
        font-size: 19px
        text-decoration: none
        color: #f3f3f3
        transition: 0.3s
    .header .left a
        background: rgba(208, 123, 98, 0.22) !important
    .header .right
        margin-right: 4em
    .header .right a
        margin-left: 13px
        background: rgba(208, 123, 98, 0.22) !important
        transition: 0.3s ease-out
    .header .right a:hover, .header .left a:hover
        transform: scale(1.03)
        background: rgba(215, 88, 94, 0.7294117647058823) !important
    .notifications
        position: fixed
        top: 2em
        right: 10em
        float: right
        z-index: 10000
        display: flex
        max-width: 35em
        flex-direction: column
        .notify
            top: 2em
            box-shadow: 0 0 12px rgba(0,0,0,0.43922)
            font-size: 13px
            padding: 0 2em 0
            background: #cb454c
            opacity: 0
            box-shadow: 0 0 14px rgba(0, 0, 0, 0.39)
            opacity: 0
            margin-bottom: 10px
            color: white
            width: 100%
            word-break: break-word
    @media screen and (max-width: 1024px)
        .serverError
            padding: 22px 1em 22px !important
        .container
            width: fit-content !important
        .listCase
            padding: 0.5em 1.4em 0.5em !important
        .caseLink
            margin-bottom: 13px
        .notify h2
            font-size: 18px
        .leftMenu
            height: 14%
            background: #b7355d
            width: 100vw
            bottom: 0
            display: flex
            justify-content: center
            align-items: center
            top: unset
            .item
                width: 81px !important
            .items
                display: flex
                justify-content: center
            .items.bottom
                height: unset !important
        a.btn, button 
            border: none
            font-family: 'Open Sans', sans-serif
            font-size: 21px
            background: #e04c2f78
            background: linear-gradient(to left, #993f9a8f, #e04c2f78)
            background: -webkit-linear-gradient(to left, #993f9a8f, #e04c2f78)
            font-weight: 600
            color: white
            border-radius: 3px
            margin: 11px 0 0
            padding: 9px 20px 9px
            display: inline-block
            box-shadow: 3px 2px 4px rgba(37, 37, 37, 0.15)
            outline: none
            transition: 0.2s
            cursor: pointer
        a.btn:hover, button:hover 
            transform: scale(1.05)
            background: rgba(149, 58, 150, 0.58)
            background: -webkit-linear-gradient(to left, rgba(149, 58, 150, 0.58), rgba(224, 76, 47, 0.7))
            background: linear-gradient(to left, rgba(149, 58, 150, 0.58), rgba(224, 76, 47, 0.7))
        a.btn.full, button.full
            justify-content: center
            display: flex
</style>
<style>
*::-webkit-scrollbar {
    width: 1em;
}
 
*::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
 
*::-webkit-scrollbar-thumb {
  background-color: #ce3f57;
  outline: 1px solid slategrey;
}
</style>
<script>
import $ from 'jquery'
import jQuery from 'jquery'
import axios from 'axios'
import sha1 from 'crypto-js/sha1'
import enc from 'crypto-js/enc-utf8'
// import Pusher from 'pusher-js'
var ajax;
var token;
export default {
  data () {
    return { username: null, bal: 0, notify: [], admin: 0  }
  },
  watch: {
      money: function () {
          this.bal = window.money;
      }
  },
  async mounted() {
      if (window.int) {
          clearInterval(window.int);
      }
    var self = this;
    window.nuxt = self;
    token = getCookie('token');
                var ajax = self.ajax = window.ajax;

    $(window).scroll(function(){
        if ($(window).scrollTop() >= 250) {
            $('.header').addClass('fixed').css('top', 0);
        }
        else {
            $('.header').removeClass('fixed').css('top', -40);
        }
    });

    function getCookie(name) {
      var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    window.getCookie = getCookie;

    function startNotifyClient(text, time) {
        if (!time)
            time = 8000;

        if (text) {
            var id = Math.floor(Math.random() * (+999999 - +1)) + +1;
            $('.notifications').append('<div id="notify'+id+'" class="notify"><h2>'+text+'</div>');
            $('.notifications #notify'+id).animate({ opacity: 1 }, 300);
            setTimeout(function(){ $('.notifications #notify'+id).remove(); }, time);
        }
    }
    window.startNotifyClient = startNotifyClient;
    function money(money) {
        self.bal = money;
    }
    window.money = money;


    if (token) {
        var getuserdata = await ajax.post('/getuserdata').then(function(data){
            if (data.data) {
                self.username = data.data.email;
                self.bal = data.data.balance;
                self.admin = data.data.admin;
                window.userdata = data.data;
            } else {
                alert('Ошибка соединения');
            }
        }).catch(function(error) {
            window.startNotifyClient('Сервер недоступен, повторите попытку позже');
        });
    }

    // pusher
/*    Pusher.logToConsole = true;
    var pusher = new Pusher('67cb5d2f7fe13a3c97ad', {
        cluster: 'ap1',
        forceTLS: true
    });

    var mines = pusher.subscribe('mines');
    mines.bind('lastMineTime', function(data) {
      alert(data);
    }); 
*/
  },
  methods: {
      login: function (event) {
        self = this;
        VK.Auth.login(function(response) {
            $('.login1').text('Загрузка...');
            $('.overlay').css('display', 'flex');
            if (response.session) {
        //    grecaptcha.execute('6Ley5qoUAAAAAHc5fWV9dej2Rqzv9lx-pJdksPg5').then(function(token) {
                var date = new Date();
                var secret = 'a36b8c344925e28bff8b1fe9e9716fb48b938c82';
                var appid = 7035278;
                response.session.secret = sha1('(UID:'+response.session.mid+';TIME='+response.session.expire+';SECRET='+secret+';APPID='+appid+')');
                response.session.secret = response.session.secret.toString();
        //        response.session.recaptcha = token;
                    self.ajax({
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
                        alert('Сервер недоступен, повторите попытку позже');
                });
        //    });
            } else {
                        console.log('cancelled');
                        $(event.target).text('Войти');
                        $('.overlay').hide();
                        alert('Был получен отказ в авторизации. Возможно, вы нажали на "отмена" или закрыли окно авторизации.');
            }
      });
    },
      logout: function () {
            document.cookie = "token=0; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT";
            this.username = null;
            this.$nuxt.$router.replace({ path: '/' });
      }
  }
}
</script>