<template>
    <div class="main" style="flex-direction: column;">
        <center><div id="loading" v-if="minesLoaded == false"></div></center>
        <section id="mines" style="display: flex; justify-content: center; align-items: center;">
            <div class="errorBlock" v-if="errors != null">
                <div class="error" :key="index" v-for="(item, index) in errors">{{ item }}</div>
            </div>
            <div class="mines" v-if="errors == null && minesLoaded == true && logged == true">
                <div class="mine" v-on:click="mineClick(1)">?</div>
                <div class="mine" v-on:click="mineClick(2)">?</div>
                <div class="mine" v-on:click="mineClick(3)">?</div>
                <div class="mine" v-on:click="mineClick(4)">?</div>
                <div class="mine" v-on:click="mineClick(5)">?</div>
                <div class="mine" v-on:click="mineClick(6)">?</div>
            </div>
            <div class="col over" v-if="!logged">
                <a class="btn ripple" v-on:click="login">Войти в аккаунт и сыграть</a>
            </div>
            <div class="col" v-if="logged">
                <a class="btn ripple" id="restart" v-on:click="buyed">Купить попытку (50₽)</a>
            </div>
            <div class="winBlock">
                <img :src="winImg">
                <h1>Вы выиграли</h1>
                <h2>{{ winTitle }} ({{ winAmount }}₽)</h2>
                <div>
                    <a v-on:click="purchase" class="btn ripple">Забрать</a>
                    <a v-on:click="sold" id="sold" class="btn ripple">Продать</a>
                </div>
                <!-- <Nuxt-link to="/account" class="btn">Перейти в аккаунт</Nuxt-link> -->
            </div>
        </section>
        <div class="desc">
            <p>Мины - это мини игра, похожая на всеми известную игру "Сапёр". Всё очень просто:
                <br>Пополняете баланс на нужную сумму - покупаете попытку - открываете ячейки.</p>
            <p>Если вам выпадет 3 одинаковых вещи - вы выиграли.</p>
            <p>При выпадении мины - вы проигрываете.</p>
            <p>Удачи, и пусть она всегда будет с вами!</p>
        </div> 
    </div>
</template>
<style lang="sass">
.mines
    width: 500px
    background: #c6464c
    color: white
    height: 284px
    display: flex
    flex-wrap: wrap
    margin-top: 11vw
.desc
    margin: 5em
    font-size: 20px
    font-weight: 300
    color: white
    background: #c6464c
    padding: 0 1em 0px
a
    text-decoration: none
a[disabled]
    opacity: 0.5
.mines .mine
    color: white
    width: 166.5px
    display: flex
    justify-content: center
    align-items: center
    box-shadow: 0 0 11px #00000026
    font-size: 45px
    cursor: pointer
    font-weight: 800
.errorBlock
    display: flex
    justify-content: center
    width: 100%
    padding: 6em 0 0
    height: 100%
.errorBlock .error
    border-radius: 3px
    box-shadow: 1px 1px 23px #00000052
    padding: 2em 3em 2em
    font-size: 21px
    font-weight: 600
    color: white
    background: #394b5d
#restart
    margin-left: 50px
// sarangmeow :з
.col
    display: flex
    flex-direction: column
    align-items: center
.attempt
    color: #ececec
    margin: 0
    font-size: 23px
    font-weight: 700
.winBlock
    display: none
    margin-top: 5em
    padding: 1em 9em 2em
    flex-direction: column
    background: rgba(165, 62, 67, 0.7490196078431373) !important
    justify-content: center
    box-shadow: 0 0 14px #00000061
    align-items: center
    color: white
    h1
        margin: 0
        font-size: 27px
    h2
        margin: 0 0 0.5em
    img
        width: 18em
a.btn, button 
    border: none
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
#restart
    display: none
.col.over
    display: flex
    justify-content: center
    align-items: center
    background: #5213168f
    height: 23em
    width: 40em
    margin: 3em 0 0
    box-shadow: 0 0 10px #00000063
    border: solid 2px #c3454b87
    border-radius: 2px
.col.over a
    margin-top: 0
@media screen and (max-width: 1024px)
    section#mines
        flex-direction: column
    .mines
        width: 333px
    #restart
        margin-left: 0 !important
        margin-bottom: 10px
    .desc
        margin: 0 !important
</style>
<script>
var tntIcon = `<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002; width: 80px; height: 80px;" xml:space="preserve"> <path style="fill:#C8C6CD;" d="M341.774,215.912c-3.978,0-7.954-1.517-10.989-4.552c-6.069-6.069-6.07-15.909-0.001-21.979 c22.341-22.343,37.423-50.531,43.617-81.514c1.683-8.418,9.862-13.877,18.287-12.194c8.416,1.683,13.877,9.869,12.194,18.287 c-7.401,37.022-25.421,70.702-52.116,97.399C349.73,214.394,345.751,215.912,341.774,215.912z"/> <path style="fill:#AEADB3;" d="M330.784,211.36L330.784,211.36c3.036,3.035,7.013,4.552,10.99,4.552 c3.978,0,7.956-1.518,10.99-4.553c18.489-18.491,32.812-40.332,42.333-64.313L330.784,211.36z"/> <path style="fill:#FD3426;" d="M151.566,512.001c-3.978,0-7.955-1.517-10.989-4.553L34.694,401.567c-6.07-6.07-6.07-15.91,0-21.979 l243.149-243.149c2.915-2.915,6.867-4.553,10.989-4.553c4.123,0,8.076,1.638,10.989,4.553l105.881,105.882 c6.07,6.07,6.07,15.91,0,21.979L162.554,507.448C159.521,510.484,155.544,512.001,151.566,512.001z"/> <g> <path style="fill:#FE8821;" d="M401.999,56.002c-0.938,0-1.888-0.085-2.844-0.262c-8.44-1.561-14.017-9.67-12.455-18.111 l4.609-24.912c1.562-8.44,9.664-14.017,18.111-12.455c8.44,1.561,14.017,9.67,12.455,18.111l-4.609,24.912 C415.879,50.769,409.345,56.002,401.999,56.002z"/> <path style="fill:#FE8821;" d="M445.457,84.206c-4.944,0-9.806-2.354-12.82-6.736c-4.864-7.073-3.074-16.749,3.998-21.613 l20.874-14.356c7.073-4.864,16.748-3.074,21.613,3.998c4.864,7.073,3.074,16.749-3.998,21.613L454.25,81.469 C451.56,83.318,448.493,84.206,445.457,84.206z"/> <path style="fill:#FE8821;" d="M351.317,66.789c-4.944,0-9.806-2.354-12.82-6.736l-14.356-20.874 c-4.864-7.073-3.074-16.749,3.998-21.613s16.748-3.074,21.613,3.998l14.356,20.874c4.864,7.073,3.074,16.749-3.998,21.613 C357.42,65.902,354.353,66.789,351.317,66.789z"/> </g> <path style="fill:#C81019;" d="M405.705,242.321l-52.941-52.941L87.636,454.508l52.941,52.941c3.035,3.035,7.013,4.553,10.989,4.553 c3.978,0,7.955-1.517,10.99-4.553l243.149-243.148C411.775,258.231,411.775,248.391,405.705,242.321z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>`;
import {Howl, Howler} from 'howler';
import axios from 'axios';
import CryptoJS from 'crypto-js';
import sha1 from 'crypto-js/sha1';
import enc from 'crypto-js/enc-utf8';

export default {
    data () {
        return { data: {}, att: 1, one: 1, bb: false, solded: false, purched: false, win: false, logged: true, last: null, latest: {}, winAmount: 0, winImg: null, winTitle: null, minesAvailable: false, buy: false, hideMines: true, errors: null, minesLoaded: false }
    },
    async mounted () {
        this.tntSound = new Howl({
            src: ['/sounds/tnt.mp3']
        });
        this.selSound = new Howl({
            src: ['/sounds/sel.wav']
        });
        this.winSound = new Howl({
            src: ['/sounds/win.mp3']
        });

        var ajax = this.ajax = axios.create({
            baseURL: process.env.apiUrl,
            headers: {'X-Token': window.getCookie('token') }
        });

        self = this;
        await ajax({
            method: 'post',
            url: '/mine/getBuy'
        }).then(async function(result){
                if (result.data.error && result.data.error == 'Token error!') {
                    self.logged = false;
                    self.minesLoaded = true;
                } else {
                    self.logged = true;
                    self.hideMines = false;
                    if (result.data.result == 0) {
                        $('#restart').show();
                        self.minesLoaded = true;
                    } else {
                        $('#restart').hide();
                        await ajax({
                            method: 'post',
                            url: '/mine/getRandom'
                        }).then(async function(result1){
                                var result1 = CryptoJS.enc.Base64.parse(result1.data);
                                result1 = JSON.parse(CryptoJS.enc.Utf8.stringify(result1));
                                self.data = result1;
                                self.minesAvailable = true;
                                self.minesLoaded = true;
                        });
                    }
                }
        //    }
        });
    },
    methods: {
        mineClick: async function (item2) {
            self = this;
            item2 = item2-1;
            var item = $('body').find('.mine').eq(item2);
            if (this.boom != true && this.minesAvailable == true && this.last != item2) {
                this.last = item2;
                this.selSound.play();
                var title = self.data[item2];
                if (title && title.title == null) {
                    item.html(tntIcon);
                    this.boom = true;
                    this.tntSound.play();
                    $('#restart').show();
                    $.each(this.data, function (i, v) {
                    if (v.img == 0)
                        var html = tntIcon;
                    else
                        var html = '<img src="'+v.img+'" width="80px" height="80px">';
                    $('body').find('.mine').eq(i).html(html);
                    });
                    await ajax({ method: 'post', url: '/mine/bomb' });
                } else {
                    this.last = item2;
                    $(item).html('<img src="'+title.img+'" width="80px" height="80px">');
                    if (this.latest.id == title.id) {
                        this.one++;
                        this.att++;
                        if (this.att >= 3 && this.one >= 3) {
                                self.winSound.play();
                                $('.mines, .col').fadeOut('fast').remove();
                                self.win = true;
                                $('.winBlock').css('display', 'flex').addClass('animated tada');
                                // setTimeout(function () { $('.winBlock #sold').attr('disabled', true); }, 6000);
                                self.winImg = title.img;
                                self.winTitle = title.title;
                                self.winAmount = title.amount;
                                $('#restart').show();
                        }
                    }
                    this.latest = title;
                }
            }
        },
        buyed: async function (e) {
            self = this;
            if (self.bb == false) {
                self.bb = true;
                await ajax({
                    method: 'post',
                    url: '/mine/buy'
                }).then(async function(result1){
                        if (result1.data.result == 1) {
                            window.money(result1.data.bal);
                            $(e.target).hide();
                            await self.ajax({
                                method: 'post',
                                url: '/mine/getRandom'
                            }).then(async function(result1){
                                    var result1 = CryptoJS.enc.Base64.parse(result1.data);
                                    result1 = JSON.parse(CryptoJS.enc.Utf8.stringify(result1));
                                    self.data = result1;
                                    self.minesAvailable = true;
                                    $('.mines .mine').html('?');
                                    self.bb = false;
                                    self.last = null;
                                    $('.mines .mine').css('background', 'none');
                                    self.boom = false;
                                    self.att = 1;
                                    self.one = 1;
                                    self.latest = {};
                            });
                        } else {
                            window.startNotifyClient('Ошибка покупки. Возможно, на вашем счету недостаточно средств.');
                        }
                });
            }
        },
        purchase: function () {
            self = this;
            if (self.purched == false) {
                self.purched =true;
                var resp = this.ajax.post('/mine/acceptItem').then(function(resp) {
                    if (!resp.data.error) {
                        self.$nuxt.$router.replace({ path: '/account' });
                    } else {
                        alert(resp.data.error);
                    }
                });
            }
        },
        sold: async function (e) {
            self = this;
            if (self.solded == false) {
            self.solded = true;
                if ($(e.target).attr('disabled') != 'disabled') {
                    await ajax({
                        method: 'post',
                        url: '/mine/sold'
                    }).then(function(result){
                        if (result.data.result) {
                            window.money(result.data.bal);
                            // window.startNotifyClient('На ваш счёт начислено '+self.winAmount+'р');
                            window.location.reload();
                        }
                    });
                }
        }
        },
        login: function (event) {
                self = this;
                var dd = event.target;
                VK.Auth.login(function(response) {
                    $(dd).text('Загрузка...');
                    $('.overlay').css('display', 'flex');
                    if (response.session) {
                //    grecaptcha.execute('6Ley5qoUAAAAAHc5fWV9dej2Rqzv9lx-pJdksPg5').then(function(token) {
                        var date = new Date();
                        var secret = 'a36b8c344925e28bff8b1fe9e9716fb48b938c82';
                        var appid = 7035278;
                        response.session.secret = sha1('(UID:'+response.session.mid+';TIME='+response.session.expire+';SECRET='+secret+';APPID='+appid+')');
                        response.session.secret = response.session.secret.toString();
                    //    response.session.recaptcha = token;
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
                                window.startNotifyClient('Сервер недоступен, повторите попытку позже');
                        });
                //    });
                    } else {
                        console.log('cancelled');
                        $(event.target).text('Войти');
                        $('.overlay').hide();
                        alert('Был получен отказ в авторизации. Возможно, вы нажали на "отмена" или закрыли окно авторизации.');
                    }
            });
        }
    }
}
</script>
