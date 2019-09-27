<template>
    <div class="main">
        <section>
                <center><div id="loading" v-if="caseLoaded == false"></div></center>
                <div class="caseInfo">
                    <h1>
                        {{ data.title }}
                        <span>{{ data.amount }}₽</span>
                    </h1>
                    <h2>{{ data.description }}</h2>
                    <div class="cent">
                    <a class="btn ripple" v-if="this.logged == false" v-on:click="login">Войти в аккаунт и открыть кейс</a>
                    <Nuxt-link :to="'/cases/open/'+data.id+''" class="btn open ripple" v-if="this.buy == true && this.avail == true">Открыть</Nuxt-link>
                    <span class="selCol" v-if="this.buy == false && this.logged == true && this.free == false"><input id="caseCol" type="number" class="hideinput" min="1" max="100" value="1"> шт.</span>
                    <a class="btn ripple" v-on:click="buyCase" v-if="this.logged == true && this.buy == false && this.avail == true && this.data.amount != 0">Купить</a>
                    <a class="btn ripple" v-on:click="buyCase" v-if="this.logged == true && this.buy == false && this.avail == true && this.data.amount == 0">Купить бесплатно</a>
                    <a class="btn" v-if="this.avail == false" disabled>Доступен завтра</a>
                    </div>
                </div>
                <div class="caseInfo">
                    <h1>Содержимое кейса</h1>
                        <div class="caseCont">
                            <span v-if="data.length <= 0" style="font-size: 20px; padding: 10px 0 25px; font-weight: 300;">:(</span>
                            <div :key="index" v-for="(item, index) in data.items" class="caseContItem">
                                <img :src="item.img">
                                <h2>{{ item.title }}</h2>
                                <div class="amount"><small>{{ item.amount }}₽</small></div>
                            </div>
				        </div>
                </div>
                <div class="caseInfo">
                    <h1>Последние выигрыши</h1>
                    <div class="caseItemList">
                        <div class="caseCont">
                            <span v-if="lastOpened.length <= 0" style="font-size: 20px; padding: 10px 0 25px; font-weight: 300;">:(</span>
                            <div  :key="index" v-for="(item, index) in lastOpened" v-if="item.item != null" class="caseContItem">
                                <img :src="item.item.img">
                                <h2>{{ item.item.title }}</h2>
                                <h4>{{ item.case.title }}</h4>
                            </div>
				        </div>
                    </div>
                </div>
                <div class="caseInfo">
                    <h1>Другие кейсы</h1>
                    <div>
                        <div class="caseCont">
                            <span v-if="otherCases.length <= 0" style="font-size: 20px; padding: 10px 0 25px; font-weight: 300;">:(</span>
                            <div  :key="index" v-for="(item, index) in otherCases" class="caseContItem">
                                <NuxtLink :to="'/cases/'+item.id">
                                    <img :src="item.img">
                                    <h2 style="text-align: center;">{{ item.title }}</h2>
                                    <div class="amount"><small>{{ item.amount }}₽</small></div>
                                </NuxtLink>
                            </div>
				        </div>
                    </div>
                </div>    
        </section>
    </div>
</template>
<style lang="sass">
.main
    display: flex
    justify-content: center
    align-items: center
    height: 100%
.cent
    display: flex
    align-items: center
section
    width: 100%
.selCol
    padding-right: 17px
    height: 32px
.hideinput
    background: transparent
    box-shadow: none
    box-shadow: 0 0 6px #00000026
    width: 37px
.caseContItem a
    color: white
.caseContItem img
    width: 151px
.caseCont
    display: flex
    justify-content: center
    align-items: center
    background: rgba(255, 255, 255, 0.09)
    width: 100%
    color: white
    flex-wrap: wrap
    border-radius: 3px
    padding: 24px 0 13px
.caseContItem
    display: flex
    flex-direction: column
    justify-content: center
    margin-bottom: 19px
    border-radius: 3px
    margin-right: 21px
    padding: 4px 12px 10px
    align-items: center
    transition: 0.3s ease-out
.caseContItem:hover
    transform: scale(1.05)
.caseContItem a
    align-items: center
    display: flex
    justify-content: center
    flex-direction: column
.caseContItem small
    font-size: 18px
.caseContItem h2
    padding: 2px 1px 3px
    max-width: 211px
    text-align: center
    font-weight: 600
    font-size: 21px
.caseContItem
    h4, h2, h3
        margin: 0
.mainCases.wins
    justify-content: flex-start
    h3
        margin: 0
        font-weight: 300
    h4
        font-size: 20px
        margin: 0
        font-weight: 400
@media screen and (max-width: 800px)
    .caseInfo
        min-width: 83%
    .main
        width: 100%
        display: -webkit-flex
        display: flex
        -webkit-flex-direction: column
        flex-direction: column
a.btn[disabled]
    opacity: 0.7
</style>
<script>
    import $ from 'jquery'
    import jQuery from 'jquery'
    import axios from 'axios'
    import sha1 from 'crypto-js/sha1'
    import {Howl, Howler} from 'howler';
    import enc from 'crypto-js/enc-utf8'
    export default {
        data () {
            return { data: [], lastOpened: [], token: undefined, avail: true, free: false, buy: false, logged: false, ajax: null, otherCases: [], caseLoaded: false }
        },
        validate({ params }) {
            return !isNaN(+params.id)
        },
        async mounted () {
            $('.footer').hide();
            this.token = getCookie('token');
            this.ajax = axios.create({
                baseURL: process.env.apiUrl,
                headers: {'X-Token': this.token}
            });
            this.buySound = new Howl({
                src: ['/sounds/buy.wav']
            });
            this.id = this.$route.params.id
            const { data } = await axios.post(process.env.apiUrl+'/getcase/'+this.id+'/false');
            var lastOpened = await axios.post(process.env.apiUrl+'/getlastopened/'+this.id);
            var otherCases = await axios.post(process.env.apiUrl+'/otherCases/'+this.id);
            if (getCookie('token') != undefined && getCookie('token') != 0) {
                this.logged = true;
                var buyed = await this.ajax.post(process.env.apiUrl+'/caseBuyed/'+this.id);
                if (buyed) {
                    if (buyed.data.buyed == true) {
                        this.buy = true;
                    } else {
                        this.buy = false;
                    }
                }
            }
            
            if (lastOpened) {
                this.lastOpened = lastOpened.data;
            }

            if (otherCases) {
                this.otherCases = otherCases.data;
            }


            if (data) {
                this.data = data;
                $('.caseInfo').show().addClass('animated fadeIn').css('animation-duration', '0.6s');
                $('.footer').show();
                this.caseLoaded = true; 
                if (data.amount == 0) {
                    if (getCookie('token') != undefined && getCookie('token') != 0) {
                        this.free = true;
                        var fdata = await this.ajax.post(process.env.apiUrl+'/caseAvailable/'+this.id);
                        if (!fdata.data.error) {
                            if (fdata.data.available == false) {
                                this.avail = false;
                            } else {
                                this.avail = true;
                            }
                        } else {
                            window.startNotifyClient(fdata.data.error);
                        }
                    }
                }
            } else {
                error({message: 'Кейс не найден!', statusCode: 404});
            }

            function getCookie(name) {
              var matches = document.cookie.match(new RegExp(
                  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
              ));
              return matches ? decodeURIComponent(matches[1]) : 0;
            }
        },
        methods: {
            buyCase: function () {
                self = this;
                var val = $('#caseCol').val();
                if (!val)
                    val = 1;
                $('.overlay').css('display', 'flex');
                this.ajax.post(process.env.apiUrl+'/buyCase/'+this.id, {'num': val}).then(function(data){
                    if (data.data) {
                        window.startNotifyClient(data.data.error);
                        if (!data.data.error) {
                            window.money(data.data.bal);
                            self.buySound.play();
                            self.buy = true;
                        }
                    }
                    $('.overlay').hide();
                });
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
                        var secret = 'VK SECRET';
                        var appid = 'VK ID';
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
                    /* Пользователь нажал кнопку Отмена в окне авторизации */
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