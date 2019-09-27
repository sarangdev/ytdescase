<template>
    <div class="main">
        <section>
                <center><div id="loading" v-if="accountLoaded == false"></div></center>
                <div class="caseInfo main" v-if="data.fname">
                    <h2>{{ data.fname }} {{ data.lname }} (ID: {{ data.id }}) <span v-if="isVip" class="vip">VIP</span><span v-if="isPrem" class="prem">Premium</span><span v-if="isLine" class="line">Line</span></h2>
                <!--    <br><br><h3 style="float: right; font-size: 18px;"><Nuxt-link to="/addbalance"><b>Пополнить</b></Nuxt-link></h3>
                    <h3 style="float: left; font-size: 18px;">На счету: {{ data.balance }}₽</h3><br>    -->
                </div>
                <div class="caseInfo analyt">
                    <h1>Статистика</h1>
                    <h3><b>{{ stat.open }}</b> кейсов открыто</h3>
                    <h3>На сайте <b>{{ stat.reg }}</b> дней</h3>
                </div>
                <div class="caseInfo">
                    <h1>Мои вещи</h1>
                    <div class="list">
                        <div class="item" :key="index" v-for="(item, index) in data.wins">
                            <p><b>{{item.date }}</b><br> {{ item.item.title }} из кейса "{{ item.case.title }}"
                            <a href="#dadadad" class="tooltip" :data-item="item.item.id" :data-id="item.winid" :data-case="item.case.id" :data-res="item.item.resUrl" v-on:click="goGet" style="float: right;">Получить<span>Настоятельно не рекомендуем делиться ссылкой загрузки с кем-то. С помощью неё любой сможет авторизоваться под вашим аккаунтом.</span></a><br></p>
                        </div>
                        <p id="notText" style="margin: 0;">Вы ещё не забрали ни одной вещи</p>
                    </div>
                </div>
                <div class="caseInfo" style="min-width: unset !important;">
                    <h1>Информация</h1>
                    <p>Если вещь не появилась в аккаунте, то это значит, что вы не нажали на "забрать" в окне выигрыша.</p>
                    <p>Выводить деньги <b>нельзя</b>, <b>это сайт с дизайн-кейсами, а не с деньгами.</b></p>
                    <p>Если вы "выбили" деньги из бесплатного кейса (либо если не пополняли счёт), <b>то они могут быть начислены только на счёт аккаунта.</b></p>
                    <p>Если вы "выбили" вещь на заказ (рисованная шапка, аватарка, ...) из бесплатного кейса, <b>то они будут сделаны исключительно по готовому шаблону.</b></p>
                    <p>Возврат денег не осуществляется. Пополняя счёт, <b>вы добровольно жертвуете проекту на развитие.</b></p>
                    <br><p>Если вы обнаружили ошибку, баг или попытку "мошенничества" на сайте, то просим вас незамедлительно сообщить нам об этом в <b><a href="https://vk.me/ytdescase" target="_blank">ЛС сообщества</a></b></p>
                </div>
        </section>
        <div id="vk_community_messages"></div>
    </div>
</template>
<style lang="sass">
.main
    display: flex
    justify-content: center
    align-items: center
    height: 100%
section
    width: 100%
a
    color: white !important
a:hover
	background: #fffff
	text-decoration: none
.caseInfo.main
    text-align: center
.vip
    background: #b01e4d
    padding: 0 6px 0
.prem
    background: #21d97c
    padding: 0 6px 0
.line
    background: #883cff
    padding: 0 6px 0
a.tooltip span
	display: none
	padding: 2px 3px
    color: black
	margin-left: 8px
	width: 250px
a.tooltip:hover span
    display: inline
    color: black !important
    font-weight: 300
    position: absolute
    background: #ffffff
    padding: 5px 10px
    width: 20em
    box-shadow: 0 0 9px #00000045
@media screen and (max-width: 850px)
    .caseInfo
        width: fit-content
    .caseInfo.main
        height: 56px !important
    .caseInfo .list .item
        margin: 5px 0 0
.caseInfo.main
    height: 19px
    padding: 17px 36px 20px !important
.caseInfo.analyt h3
    margin: 0
</style>

<script>
import axios from 'axios'
import sha1 from 'js-sha1'

export default {
  data () {
    return { stat: {},  data: {}, accountLoaded: false, isVip: false, isPrem: false, isLine: false }
  },
  async mounted () {
    self = this;
    var token = this.token = getCookie('token');
           var ajax = this.ajax = axios.create({
                baseURL: process.env.apiUrl,
                headers: {'X-Token': token}
            });

    if (token) {
        var getuserdata = await ajax.post('/getuserdata').then(function(data){
            if (data.data) {
                self.data = data.data;
                $('.caseInfo').fadeIn('fast');
                self.accountLoaded = true;
                if (self.data.wins[0]) {
                    $('#notText').hide();
                }
                if (data.data.priv == 1)
                    self.isVip = true;
                else if (data.data.priv == 2)
                    self.isPrem = true;
                else if (data.data.priv == 3)
                    self.isLine = true;
            } else {
                alert('Ошибка соединения');
            }
        }); 
        var stat = await ajax.post('/getstat').then(function(data){
            if (data.data) {
                self.stat = data.data;
            } else {
                alert('Ошибка соединения');
            }
        }); 
    } else {
                    window.startNotifyClient('Вы должны войти в аккаунт');
                    self.$nuxt.$router.replace({ path: '/' });
    }

    function getCookie(name) {
      var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    }
  },
  methods: {
      goGet: async function (event) {
            function extractHostname(url) {
                var hostname;
                //find & remove protocol (http, ftp, etc.) and get hostname
                if (url.indexOf("//") > -1) {
                    hostname = url.split('/')[2];
                }
                else {
                    hostname = url.split('/')[0];
                }

                //find & remove port number
                hostname = hostname.split(':')[0];
                //find & remove "?"
                hostname = hostname.split('?')[0];

                return hostname;
            }
          var item = $(event.target).data('item');
          var id = $(event.target).data('id');
          var cases = $(event.target).data('case');
          var res = $(event.target).data('res');
          if (res == '#' || res == '' || res == '1') {  /*
              $('.overlay').show();
              $('.overlay .modal').css('display', 'flex');
              $('.overlay .loader').hide();
              var i = 0;
              var int = setInterval(function() {
                  if (i < 3) {
                    $('.modal #time').text(3-i);
                    i++;
                  } else {
                      clearInterval(int);
                      window.open("https://vk.me/ytdescase", '_blank');
                        $('.overlay').hide();
                        $('.overlay .modal').css('display', 'none');
                        $('.overlay .loader').show();
                  }
              }, 1000); */
              var widget = VK.Widgets.CommunityMessages("vk_community_messages", 184248410, { expanded: 1 });
            widget.expand({
                welcomeScreen: 1
            });
            $('.header').append(`<div class="overlay showed" id="over1">
                            <div class="modal" id="vkWrite">
                            <h3>Для получения приза необходимо связаться с нами<br>Форма для связи открыта в нижнем правом углу<br>
                                Пожалуйста, укажите в своём сообщении эти параметры:<br>
                                ID: ${this.data.id}, ID кейса: ${cases}, ID вещи: ${item}
                            </h3>
                            <div class="close">X</div></div>`);
            $('#over1 .close').click(function(){
                widget.destroy();
                $('#over1').remove();
            }); 
          } else if (res != 'zam' && res != null && res != undefined && extractHostname(res) == 'yadi.sk' || extractHostname(res) == 'upload.in.ua') {
              window.open(res);
          } else if (res == 'zam') {
              window.startNotifyClient('Эту вещь можно только продать. :\\');
          } else {
              window.open(res+"?token="+this.token+"&id="+item+"&hash="+this.hash, '_blank');
          }
      }
  }
}
</script>