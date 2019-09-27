<template>
    <section>
        <center><div id="loading" v-if="caseLoaded == false"></div></center>
        <div class="errorBlock">
            <div class="error" :key="index" v-for="(item, index) in errors">{{ item }}</div>
        </div>
        <div class="openCase" v-if="errors.length == 0">
            <h1>Открываем кейс...</h1>
            <div class="caseRoulette">
                <div class="delimiter"></div>
                <div class="cases">
                    <div class="case" v-bind:data-i="index" :key="index" v-for="(item, index) in items"><img :src="item.img" style="width: 110px"></div>
                </div>
            </div>
        </div>
        <div class="openResult" v-if="errors.length == 0">
            <img :src="result.img">
            <h2>{{ result.title }} (<span id="AMOUNT"></span>)</h2>
            <div>
                <a class="btn ripple" v-on:click="purchase">Забрать</a>
                <a class="btn ripple" v-on:click="sold">Продать</a>
                <a class="btn ripple" id="returnBtn" style="display: none;" v-on:click="back">Вернуться</a>
            </div>
        </div>
    </section>
</template>
<style lang="sass">
.openCase
    width: 46em
    margin-top: 3em !important
    box-shadow: 0 0 10px #0000006e
    background: #ca595e
    color: white
    padding: 11px 27px 12px
    margin: 0 auto
    display: none
    flex-direction: column
    align-items: center
.openCase .delimiter
    position: absolute
    left: 50%
    width: 5px
    height: 100%
    background: #ff005d
    z-index: 5
.btn
    margin-left: 10px !important
.openCase h1
    margin: 0
.openResult
    width: 38em
    margin-top: 3em !important
    box-shadow: 0 0 10px #0000006e
    background: rgba(165, 62, 67, 0.7490196078431373)
    color: white
    padding: 11px 27px 12px
    margin: 0 auto
    display: none
    justify-content: center
    align-items: center
    flex-direction: column
    padding: 45px 21px 36px
    opacity: 0
    margin-top: 20px
    img
        width: 19em
    h2
        margin: 0 0 15px
        font-size: 31px
        font-weight: 500
        max-width: 12em
        text-align: center
.errorBlock
    display: flex
    justify-content: center
    width: 100%
    padding: 6em 0 0
    height: 100%
.errorBlock .error
    border-radius: 54px
    box-shadow: 1px 1px 23px #00000052
    padding: 2em 4em 2em
    font-size: 27px
    font-weight: 600
    color: white
    background: #c6464c
.caseRoulette
    overflow: hidden
    height: 148px
    width: 40em
    display: flex
    align-items: center
    margin: 11px 0 11px
    background: rgb(223, 101, 106)
    box-shadow: 0 0 10px #00000026
    position: relative
.openCase .caseRoulette .case
    width: 122px
    display: flex
    background: #b64e52
    font-weight: 300
    height: 100%
    justify-content: center
    align-items: center
    box-shadow: 0 0 10px #00000036
.openCase .caseRoulette .cases
    position: relative
    height: 148px
    left: 320px
    margin: 0

@media screen and (max-width: 850px)
    .openResult img
        width: 13em
    .openResult h2
        font-size: 19px
        text-align: center
    .openResult a.btn
        padding: 6px 11px 8px
    .openCase
        width: 78%
    .openResult
        width: 64%
        div
            display: flex
            justify-content: center
            flex-direction: column
            text-align: center
    .caseRoulette
        width: 20em !important
        .cases
            left: 10em
</style>
<script>
    import axios from 'axios';
    import {Howl, Howler} from 'howler';
    import CryptoJS from 'crypto-js';

    export default {
        data () {
            return { items: [], errors: [], result: [], amount: 0, caseLoaded: false, solded: false, purched: false }
        },
        validate({ params }) {
            return !isNaN(+params.id)
        },
        async mounted () {
            var self = this;
            var token = getCookie('token');
            if (!token) {
                this.$nuxt.$router.replace({ path: '/login' });
            }
            this.ajax = axios.create({
                    baseURL: process.env.apiUrl,
                    headers: {'X-Token': token}
            });
            this.winSound = new Howl({
                src: ['/sounds/scroll.mp3']
            });
            function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : 0;
            }

            self.id = self.$route.params.id
            const { data } = await self.ajax.post('/getcase/'+self.id+'/true');
            if (data) {
                if (data.error) {
                    self.errors = ['Неизвестная ошибка'];
                } else {
                        self.amount = data.amount;
                        var resp1 = self.ajax.post('/caseAvailable/'+self.id).then(function(resp) {
                            if (resp) {
                                if (!resp.data.error) {
                                    if (resp.data.available == false) {
                                        self.errors = ['Кейс недоступен!'];
                                        self.caseLoaded = true;
                                    } else {
                                        start();
                                    }
                                } else {
                                    window.startNotifyClient(resp.data.error);
                                //  window.money(300);
                                    self.$nuxt.$router.replace({ path: '/' });
                                }
                            }
                        });
                }
            } else {
                self.errors = ['Кейс не найден!'];
            }       
            function start() {
                var resp = self.ajax.post('/r/genRandomItemByCaseId/'+self.id).then(function(resp) {
                    if (resp) {
                        if (!resp.data.error) {
                            self.caseLoaded = true;
                            self.winSound.play(); // play sound
                            $('.openCase').fadeIn('fast').css('display', 'flex');
                            if ($(window).width() < 1024) {
                                $('.caseRoulette .cases').css('left', '10em');
                            } else {
                                
                            }
                            self.items = resp.data.items;
                            setTimeout(function ()
                                {
                                    $('.openCase').addClass('animated infinite pulse');
                                    var carusel = $(".caseRoulette .cases");
                                    carusel.animate({ left: resp.data.offset+'px' }, getDuration(carusel.offset().left, 5), function () { // animate carousel
                                        var datar = resp.data.res;
                                            if (datar.amount != 0) {
                                                window.startNotifyClient(resp.data.message, 3000);
                                                $('.openCase').removeClass('animated infinite pulse').fadeOut('fast');
                                                $('.openResult').addClass('animated tada').css('display', 'flex').animate({ opacity: 1, 'margin-top': 0 }, 500);
                                                self.result = datar;
                                                $('#AMOUNT').text(datar.amount+'₽');
                                            } else {
                                                $('.openResult img').attr('src', datar.img);
                                                self.result.img = datar.img;
                                                $('.openCase').fadeOut('fast');
                                                $('.openResult').addClass('animated tada').css('display', 'flex').animate({ opacity: 1, 'margin-top': 0 }, 500);
                                                $('.openResult h2').text('Вам ничего не выпало :(');
                                                $('.openResult a.btn').hide();                                            
                                                $('#returnBtn').show();
                                            }
                                    });
                        }, 1200);
                        } else {
                            window.startNotifyClient(resp.data.error);
                            $('.openCase').remove();
                        }
                    }
                });
            }

            function getDuration(distance, pixelsPerSecond){
                if ($(window).width() < 1024) {
                    var speed = 270;
                } else {
                    var speed = 90;
                }
                var duration = distance / pixelsPerSecond * speed;
                return duration;
            }
        },
        methods: {
            purchase: function () {
                self = this;
                if (self.purched == false) {
                    self.purched = true;
                    if (self.result.title == 'Деньги') {
                        var data = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(JSON.stringify({ id: self.result.id })));
                        var resp = this.ajax({
                            url: '/r/soldItem/'+this.id+'/'+this.result.id,
                            method: 'post',
                            data: 'data='+data
                        }).then(function(resp) {
                            if (!resp.data.error) {
                                window.startNotifyClient('Деньги начислены на счёт', 3000);
                                window.money(resp.data.bal);
                                self.$nuxt.$router.replace({ path: '/cases/'+self.id });
                            } else {
                                self.errors = [resp.data.error];
                            }
                        });
                    } else {
                        var data = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(JSON.stringify({ id: self.result.id })));
                        var resp = this.ajax({
                            url: '/r/acceptItem',
                            method: 'post',
                            data: 'data='+data
                        }).then(function(resp) {
                            window.startNotifyClient(resp.data.message, 3000);
                            if (!resp.data.error) {
                                self.$nuxt.$router.replace({ path: '/account' });
                            } else {
                                self.errors = [resp.data.error];
                            }
                        });
                    }
                }
            },
            sold: function () {
                self = this;
                if (self.solded == false) {
                    self.solded = true;
                    var data = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(JSON.stringify({ id: self.result.id })));
                    var resp = this.ajax({
                        url: '/r/soldItem/'+this.id+'/'+this.result.id,
                        method: 'post',
                        data: 'data='+data
                    }).then(function(resp) {
                        if (!resp.data.error) {
                            window.startNotifyClient(resp.data.message, 3000);
                            window.money(resp.data.bal);
                            self.$nuxt.$router.replace({ path: '/cases/'+self.id });
                        } else {
                            self.errors = [resp.data.error];
                        }
                    });
                }
            },
            back: function () {
                this.$nuxt.$router.replace({ path: '/cases/'+this.id });
            }
        }
    }
</script>