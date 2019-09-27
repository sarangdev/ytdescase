<template>
  <div style="height: 100%;">
    <transition name="slide-fade"><div class="serverError" v-if="serverOff == true">К сожалению, сервер в данный момент недоступен.<br>Повторите попытку позже.</div></transition>
    <div class="mainSection">
      <div>
        <h1>YTDES CASE</h1>
        <h2>Выигрывать с нами - легко!</h2>
      </div>
      <button id="vkAuth" class="btn vkAuth ripple" v-if="auth == false" v-on:click="login" style="z-index: 15;">Вход</button>
    </div>
    <div class="lastWins">
      <div class="list">
        <div class="item" :key="index" v-for="(item, index) in lastWins">
          <img :src="item.img">
          <h2>{{ item.name }}</h2>
          <h3>{{ item.user }}</h3>
        </div>
      </div>
    </div>
    <div class="analytic">
      <center><div id="loading" v-if="analyticLoaded == false"></div></center>
      <div class="blocks" v-if="analyticLoaded == true">
        <p><span id="aopened">0</span> кейсов открыто</p>
        <p><span id="aonline">0</span> онлайн на сайте</p>
        <p><span id="ausers">0</span> пользователей</p>
      </div>
    </div>
  <section class="container">
    <div> 
        <center><div id="loading" v-if="casesLoaded == false"></div></center>
        <div class="block">
        <center><h2 class="title"></h2></center>
        <div class="cases wrap" id="cases">
          <Case :title="item.title" :img="item.img" :id="item.id" :amount="item.amount" :key="index" v-for="(item, index) in cases.design" />
        </div>
        <center><h2 class="title"></h2></center>
        <div class="cases wrap" id="cases">
          <Case :title="item.title" :img="item.img" :id="item.id" :amount="item.amount" :key="index" v-for="(item, index) in cases.accounts" />
        </div>
        <center><h2 class="title"></h2></center>
        <div class="cases wrap" id="cases">
          <Case :title="item.title" :img="item.img" :id="item.id" :amount="item.amount" :key="index" v-for="(item, index) in cases.free" />
        </div>
        <center><h2 class="title"></h2></center>
        <div class="cases wrap" id="cases">
          <Case :title="item.title" :img="item.img" :id="item.id" :amount="item.amount" :key="index" v-for="(item, index) in cases.partners" />
        </div>
        <center><h2 class="title"></h2></center>
        <div class="cases wrap" id="cases">
          <Case :title="item.title" :img="item.img" :id="item.id" :amount="item.amount" :key="index" v-for="(item, index) in cases.fc" />
        </div>
        </div>
    </div>
  </section>
        <center class="topUsers">
          <h1 style="margin: 1em; font-size: 35px;">ТОП Игроков</h1>
          <div class="list">
            <div class="user" :key="index" v-for="(item, index) in topusers">
                <h1>{{ item.fname }} {{ item.lname[0] }}.</h1><sup>{{ item.balance }}₽</sup>
            </div>
          </div>
      </center>
      <center class="nices">
          <h1>Преимущества</h1>
          <div class="list">
              <div class="nice">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 57.157 57.157" style="enable-background:new 0 0 57.157 57.157; width: 187px;" xml:space="preserve"> <circle style="fill:#E0E1E2;" cx="28.578" cy="29.157" r="26"/> <circle style="fill:#FFFFFF;" cx="28.578" cy="29.157" r="15"/> <path style="fill:#424A60;" d="M12.578,57.157c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414l3.933-3.933 c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-3.933,3.933C13.09,57.059,12.834,57.157,12.578,57.157z"/> <path style="fill:#424A60;" d="M44.578,57.157c-0.256,0-0.512-0.098-0.707-0.293l-3.963-3.963c-0.391-0.391-0.391-1.023,0-1.414 s1.023-0.391,1.414,0l3.963,3.963c0.391,0.391,0.391,1.023,0,1.414C45.09,57.059,44.834,57.157,44.578,57.157z"/> <path style="fill:#C7CAC7;" d="M46.672,11.371c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414l3-3 c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-3,3C47.183,11.274,46.927,11.371,46.672,11.371z"/> <path style="fill:#C7CAC7;" d="M10.485,11.371c-0.256,0-0.512-0.098-0.707-0.293l-3-3c-0.391-0.391-0.391-1.023,0-1.414 s1.023-0.391,1.414,0l3,3c0.391,0.391,0.391,1.023,0,1.414C10.997,11.274,10.741,11.371,10.485,11.371z"/> <path style="fill:#26B99A;" d="M28.578,57.157c-15.439,0-28-12.561-28-28s12.561-28,28-28s28,12.561,28,28 S44.018,57.157,28.578,57.157z M28.578,5.157c-13.234,0-24,10.767-24,24s10.766,24,24,24s24-10.767,24-24S41.812,5.157,28.578,5.157 z"/> <g> <path style="fill:#26B99A;" d="M28.578,6.036c-0.552,0-1,0.447-1,1v1c0,0.553,0.448,1,1,1s1-0.447,1-1v-1 C29.578,6.483,29.131,6.036,28.578,6.036z"/> <path style="fill:#26B99A;" d="M28.578,49.036c-0.552,0-1,0.447-1,1v1c0,0.553,0.448,1,1,1s1-0.447,1-1v-1 C29.578,49.483,29.131,49.036,28.578,49.036z"/> <path style="fill:#26B99A;" d="M50.578,28.036h-1c-0.552,0-1,0.447-1,1s0.448,1,1,1h1c0.552,0,1-0.447,1-1 S51.131,28.036,50.578,28.036z"/> <path style="fill:#26B99A;" d="M7.578,28.036h-1c-0.552,0-1,0.447-1,1s0.448,1,1,1h1c0.552,0,1-0.447,1-1 S8.131,28.036,7.578,28.036z"/> <path style="fill:#26B99A;" d="M43.427,12.772l-0.707,0.707c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293 s0.512-0.098,0.707-0.293l0.707-0.707c0.391-0.391,0.391-1.023,0-1.414S43.818,12.381,43.427,12.772z"/> <path style="fill:#26B99A;" d="M13.022,43.178l-0.707,0.707c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293 s0.512-0.098,0.707-0.293l0.707-0.707c0.391-0.391,0.391-1.023,0-1.414S13.413,42.788,13.022,43.178z"/> <path style="fill:#26B99A;" d="M44.134,43.178c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l0.707,0.707 c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L44.134,43.178z"/> <path style="fill:#26B99A;" d="M13.729,12.772c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414l0.707,0.707 c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L13.729,12.772z"/> </g> <path style="fill:#424A60;" d="M39.578,30.157h-8c-0.552,0-1-0.447-1-1s0.448-1,1-1h8c0.552,0,1,0.447,1,1 S40.131,30.157,39.578,30.157z"/> <path style="fill:#424A60;" d="M28.578,27.157c-0.552,0-1-0.447-1-1v-11c0-0.553,0.448-1,1-1s1,0.447,1,1v11 C29.578,26.709,29.131,27.157,28.578,27.157z"/> <path style="fill:#424A60;" d="M28.578,33.157c-2.206,0-4-1.794-4-4s1.794-4,4-4s4,1.794,4,4S30.784,33.157,28.578,33.157z M28.578,27.157c-1.103,0-2,0.897-2,2s0.897,2,2,2s2-0.897,2-2S29.681,27.157,28.578,27.157z"/> <path style="fill:#E7ECED;" d="M54.493,2.086c2.781,2.781,2.781,7.29,0,10.071L44.421,2.086C47.203-0.695,51.711-0.695,54.493,2.086 z"/> <path style="fill:#E7ECED;" d="M2.664,2.086c-2.781,2.781-2.781,7.29,0,10.071L12.735,2.086C9.954-0.695,5.445-0.695,2.664,2.086z" /> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                <p>Выдача статичных вещей (паки, стили, ...) происходит автоматически. Вам не нужно общаться в поддержку для получения приза.</p>
              </div>
              <div class="nice">
                <svg xmlns="http://www.w3.org/2000/svg" height="328px" version="1.1" viewBox="-38 0 511 511.99956" width="328px" style="width: 328px;"> <g id="surface1"> <path d="M 413.476562 341.910156 C 399.714844 379.207031 378.902344 411.636719 351.609375 438.289062 C 320.542969 468.625 279.863281 492.730469 230.699219 509.925781 C 229.085938 510.488281 227.402344 510.949219 225.710938 511.289062 C 223.476562 511.730469 221.203125 511.96875 218.949219 512 L 218.507812 512 C 216.105469 512 213.691406 511.757812 211.296875 511.289062 C 209.605469 510.949219 207.945312 510.488281 206.339844 509.9375 C 157.117188 492.769531 116.386719 468.675781 85.289062 438.339844 C 57.984375 411.6875 37.175781 379.277344 23.433594 341.980469 C -1.554688 274.167969 -0.132812 199.464844 1.011719 139.433594 L 1.03125 138.511719 C 1.261719 133.554688 1.410156 128.347656 1.492188 122.597656 C 1.910156 94.367188 24.355469 71.011719 52.589844 69.4375 C 111.457031 66.152344 156.996094 46.953125 195.90625 9.027344 L 196.246094 8.714844 C 202.707031 2.789062 210.847656 -0.117188 218.949219 0.00390625 C 226.761719 0.105469 234.542969 3.007812 240.773438 8.714844 L 241.105469 9.027344 C 280.023438 46.953125 325.5625 66.152344 384.429688 69.4375 C 412.664062 71.011719 435.109375 94.367188 435.527344 122.597656 C 435.609375 128.386719 435.757812 133.585938 435.988281 138.511719 L 436 138.902344 C 437.140625 199.046875 438.554688 273.898438 413.476562 341.910156 Z M 413.476562 341.910156 " style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,86.666667%,50.196078%);fill-opacity:1;" /> <path d="M 413.476562 341.910156 C 399.714844 379.207031 378.902344 411.636719 351.609375 438.289062 C 320.542969 468.625 279.863281 492.730469 230.699219 509.925781 C 229.085938 510.488281 227.402344 510.949219 225.710938 511.289062 C 223.476562 511.730469 221.203125 511.96875 218.949219 512 L 218.949219 0.00390625 C 226.761719 0.105469 234.542969 3.007812 240.773438 8.714844 L 241.105469 9.027344 C 280.023438 46.953125 325.5625 66.152344 384.429688 69.4375 C 412.664062 71.011719 435.109375 94.367188 435.527344 122.597656 C 435.609375 128.386719 435.757812 133.585938 435.988281 138.511719 L 436 138.902344 C 437.140625 199.046875 438.554688 273.898438 413.476562 341.910156 Z M 413.476562 341.910156 " style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,66.666667%,38.823529%);fill-opacity:1;" /> <path d="M 346.101562 256 C 346.101562 326.207031 289.097656 383.355469 218.949219 383.605469 L 218.5 383.605469 C 148.144531 383.605469 90.894531 326.359375 90.894531 256 C 90.894531 185.644531 148.144531 128.398438 218.5 128.398438 L 218.949219 128.398438 C 289.097656 128.648438 346.101562 185.796875 346.101562 256 Z M 346.101562 256 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" /> <path d="M 346.101562 256 C 346.101562 326.207031 289.097656 383.355469 218.949219 383.605469 L 218.949219 128.398438 C 289.097656 128.648438 346.101562 185.796875 346.101562 256 Z M 346.101562 256 " style=" stroke:none;fill-rule:nonzero;fill:rgb(88.235294%,92.156863%,94.117647%);fill-opacity:1;" /> <path d="M 276.417969 237.625 L 218.949219 295.101562 L 206.53125 307.519531 C 203.597656 310.453125 199.75 311.917969 195.90625 311.917969 C 192.058594 311.917969 188.214844 310.453125 185.277344 307.519531 L 158.578125 280.808594 C 152.710938 274.941406 152.710938 265.4375 158.578125 259.566406 C 164.4375 253.699219 173.953125 253.699219 179.820312 259.566406 L 195.90625 275.652344 L 255.175781 216.382812 C 261.042969 210.511719 270.558594 210.511719 276.417969 216.382812 C 282.285156 222.25 282.285156 231.765625 276.417969 237.625 Z M 276.417969 237.625 " style=" stroke:none;fill-rule:nonzero;fill:rgb(70.588235%,82.352941%,84.313725%);fill-opacity:1;" /> <path d="M 276.417969 237.625 L 218.949219 295.101562 L 218.949219 252.605469 L 255.175781 216.382812 C 261.042969 210.511719 270.558594 210.511719 276.417969 216.382812 C 282.285156 222.25 282.285156 231.765625 276.417969 237.625 Z M 276.417969 237.625 " style=" stroke:none;fill-rule:nonzero;fill:rgb(43.529412%,64.705882%,66.666667%);fill-opacity:1;" /> </g> </svg>
                <p>Все запросы, проходящие через сайт надёжно зашифрованы с помощью протокола SSL и встроенных методов шифрования. Таким образом, у сторонних лиц нет доступа к данным, которые вы передаете.</p>
              </div>
             <div class="nice">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 56.372 56.372" style="enable-background:new 0 0 56.372 56.372; width: 140px;" xml:space="preserve"> <path style="fill:#E7ECED;" d="M56.372,28.284l-7.234,7.234c-11.517,11.517-30.19,11.517-41.707,0L0,28.087l7.234-7.234 c11.517-11.517,30.19-11.517,41.707,0L56.372,28.284z"/> <circle style="fill:#3083C9;" cx="28.158" cy="28.156" r="12"/> <path style="fill:#FFFFFF;" d="M21.158,28.156c-0.552,0-1-0.448-1-1c0-3.86,3.14-7,7-7c0.552,0,1,0.448,1,1s-0.448,1-1,1 c-2.757,0-5,2.243-5,5C22.158,27.708,21.711,28.156,21.158,28.156z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                <p>Все выигрыши и статистика сайта отображается в открытом доступе. Никакого обмана!</p>
              </div>
          </div>
      </center>
      <div id="vk_comm"></div>
  </div>
</template>
<script>
import $ from 'jquery'
import jQuery from 'jquery'
import axios from 'axios'
import Case from "~/components/Case.vue"
import sha1 from 'crypto-js/sha1'
import enc from 'crypto-js/enc-utf8'

export default {
  data () {
    return { cases: [], auth: false, topusers: [], serverOff: false, ausers: 0, casesLoaded: false, lastWins: [], analyticLoaded: false, anopened: 0, aonline: 0 };
  },
  components: {
    Case
  },

  destroyed() {
    if (window.int) {
      clearInterval(window.int);
    }
  },

  mounted() {
    var self = this;
    if (window.int) {
      console.log('cleared state');
      clearInterval(window.int);
    }
    var int = window.int = null;
    var ajax = self.ajax = axios.create({
        baseURL: process.env.apiUrl,
        headers: {'X-Token': getCookie('token') }
    });

    if (getCookie('token') != 0) {
      self.auth = true;
    }

    VK.Widgets.CommunityMessages("vk_comm", 184248410, {tooltipButtonText: "Есть вопросы?"});

            function getCookie(name) {
              var matches = document.cookie.match(new RegExp(
                  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
              ));
              return matches ? decodeURIComponent(matches[1]) : 0;
            }
            function findGetParameter(parameterName) {
                var result = null,
                    tmp = [];
                var items = location.search.substr(1).split("&");
                for (var index = 0; index < items.length; index++) {
                    tmp = items[index].split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                }
                return result;
            }
            function formatToK(a,b){if(0==a)return"0";var c=1000,d=b||1,e=["","К","KK","KKK","KKKK","...","...","...","..."],f=Math.floor(Math.log(a)/Math.log(c));return parseFloat((a/Math.pow(c,f)).toFixed(d))+e[f]}
            if (findGetParameter('set')) {
              document.cookie = "token="+findGetParameter('set')+"; path=/; expires=99999";
              window.location.href = "/";
            }
            if (findGetParameter('payType')) {
              switch (findGetParameter('payType')) {
                case 'success':
                  window.startNotifyClient('Деньги успешно зачислены на счет');
                break;
                case 'fail':
                  window.startNotifyClient('Ошибка платежа.<br>Если вы оплатили платеж - пожалуйста, напишите нам в ВК.');
                break;
                case 'wait':
                  window.startNotifyClient('Платёж успешно пройден. Деньги будут зачислены через 1-2 минут');
                break;
              }
            }
            ajax({
              method: 'post',
              url: '/getcases'
            }).then(async function(result) {
              self.serverOff = false;
              self.cases = result.data;
              self.casesLoaded = true;
              $('.container .block').show();
              var loadednum = 0;
              async function upd() {
                  await ajax.post('/analytic').then(function (analytic) {
                    self.analyticLoaded = true;
                    self.anopened = 0;
                    self.aonline = 0;
                    self.lastWins = [];
                    self.ausers = 0;
                    self.topusers = analytic.data.topusers;
                    if (loadednum == 0) {
                      $({numberValue: $('#aonline').text()}).animate({numberValue: analytic.data.online}, {
                          duration: 2000,
                          easing: 'linear',
                          step: function() { 
                              $('#aonline').text(Math.ceil(this.numberValue)); 
                          }
                      });                    

                      $({numberValue: $('#aopened').text()}).animate({numberValue: analytic.data.opened}, {
                          duration: 2000,
                          easing: 'linear',
                          step: function() { 

                              $('#aopened').text(formatToK(Math.ceil(this.numberValue))); 
                          }
                      });        
                      
                      $({numberValue: $('#ausers').text()}).animate({numberValue: analytic.data.users}, {
                          duration: 2000,
                          easing: 'linear',
                          step: function() { 
                              $('#ausers').text(formatToK(Math.ceil(this.numberValue))); 
                          }
                      });
                      loadednum = 1;
                    } else {
                      $('#aonline').text(Math.ceil(analytic.data.online));
                      $('#aopened').text(formatToK(Math.ceil(analytic.data.opened))); 
                      $('#ausers').text(formatToK(Math.ceil(analytic.data.users))); 
                    }

                    $.each(analytic.data.last, function (id, item){
                      self.lastWins.push(item);
                    });
                    $('.lastWins .list').css({ opacity: 1, 'margin-left': 0 });
                  });
              }
              upd();
              window.int = setInterval(upd, 7000);
            }).catch(function(error) {
                console.log(error);
                self.serverOff = true;
                self.casesLoaded = true;
            });
  },
  methods: {
    login: function (event) {
          self = this;
          VK.Auth.login(function(response) {
              $('.vkAuth').text('Загрузка...');
              $('.overlay').css('display', 'flex');
              if (response.session) {
            //  grecaptcha.execute('6Ley5qoUAAAAAHc5fWV9dej2Rqzv9lx-pJdksPg5').then(function(token) {
                  var date = new Date();
                  var secret = 'a36b8c344925e28bff8b1fe9e9716fb48b938c82';
                  var appid = 7035278;
                  response.session.secret = sha1('(UID:'+response.session.mid+';TIME='+response.session.expire+';SECRET='+secret+';APPID='+appid+')');
                  response.session.secret = response.session.secret.toString();
                //  response.session.recaptcha = token;
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
            //  });
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

<style lang="sass">
section
  padding-bottom: 20px
.container
  width: 75em
  margin: 0 auto
  background: #b54348
  box-shadow: 0 0 25px #00000059
.container .block
  display: none
.cases
  display: flex
  flex-direction: row
  margin: 2em 0 0
  justify-content: center
.cases.wrap
  flex-wrap: wrap
.serverError
  background: #ff6348
  color: white
  font-size: 21px
  font-weight: 400
  padding: 22px 5em 22px
.container .title
    color: white
    padding: 0 0px 0px
    font-size: 31px
    margin: 31px 0em 0
    border-bottom: solid 3px #d75057
    width: 10em
.lastWins
  background: #b84a4f
  padding: 12px 0em 16px
  color: white
  width: 100%
  display: flex
  justify-content: center
  align-items: center
  box-shadow: 0 5px 16px rgba(0,0,0,0.3098)
.lastWins h2, .lastWins h3
  margin: 0
#vkAuth
  font-size: 22px
.lastWins h3
  font-weight: 300
.lastWins img
  width: 7em
.lastWins .list
  display: flex
  padding: 0.5em 0 0
  margin-left: -20px
  opacity: 0
  transition: 0.4s ease-out
.lastWins .list .item
    padding: 10px 21px 10px
    transition: 0.3s ease-out
    margin-left: 10px
    box-shadow: 0 3px 6px rgba(0,0,0,0.08), 0 3px 6px rgba(0,0,0,0.08)
    display: flex
    justify-content: center
    text-align: center
    align-items: center
    flex-direction: column
    background: rgb(171, 79, 83)
.lastWins .list .item:hover
  transform: scale(1.03)
.analytic
  background: #b84a4f
  padding: 20px 0em 25px
  color: white
  width: 100%
  box-shadow: 0 5px 16px rgba(0,0,0,0.3098)
.analytic .blocks
  display: flex
  align-items: center
  flex-wrap: wrap
  justify-content: center
.analytic h2, .analytic h3
  margin: 0
.analytic h3
  font-weight: 300
.analytic p
    font-size: 25px
    font-weight: 300
    padding: 0 3em 0
    margin: 0
.analytic p span
    font-size: 28px
    font-weight: 600
span.tooltip
    background: #D31027
    position: absolute
    padding: 5px 17px 5px
    font-weight: 300
    width: 100%
    left: 98%
    font-size: 18px
    top: 4px
    color: white
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.32)
    opacity: 0
    font-size: 19px
    border-radius: 3px
    margin-left: 10px
.mainSection
  padding: 7em 0 7em
  display: flex
  justify-content: center
  align-items: center
  flex-direction: column
  position: relative
  background-repeat: no-repeat
  background-image: url(/img/main.jpg)
  background-size: cover
  background-position: 0 -2em
  box-shadow: 0 5px 13px #0000002f, 0 5px 11px #0000001f
.mainSection div
    z-index: 15
    padding: 0px 15px 5px
    text-align: center
.mainSection:before
  content: " "
  z-index: 1
  display: block
  position: absolute
  height: 100%
  top: 0
  left: 0
  right: 0
  background: rgba(109, 11, 32, 0.35)
.mainSection h1
  font-size: 4.7em
  font-weight: 700
  color: white
  text-shadow: 0 0 6px #0000007d
  z-index: 11
  margin: 0
.mainSection h2
  margin: 0
  line-height: 0.1
  z-index: 11
  padding-bottom: 21px
  color: #fff2f2
  text-shadow: 1px 1px 5px #00000073
  font-variant: unset
  font-size: 28px
  font-weight: 300
button.vkAuth
  width: auto
  padding: 1px 33px 1px
  display: flex
  justify-content: center
  align-items: center
button.vkAuth:before
    content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Capa_1' x='0px' y='0px' viewBox='0 0 511.962 511.962' style='enable-background:new 0 0 511.962 511.962;' xml:space='preserve' width='35px' height='35px' class=''%3E%3Cg%3E%3Cpath d='M250.503,400.807h30.592c0,0,9.248-1.024,13.952-6.112c4.352-4.672,4.192-13.44,4.192-13.44 s-0.608-41.056,18.464-47.104c18.784-5.952,42.912,39.68,68.48,57.248c19.328,13.28,34.016,10.368,34.016,10.368l68.384-0.96 c0,0,35.776-2.208,18.816-30.336c-1.376-2.304-9.888-20.8-50.848-58.816c-42.88-39.808-37.12-33.344,14.528-102.176 c31.456-41.92,44.032-67.52,40.096-78.464c-3.744-10.432-26.88-7.68-26.88-7.68l-76.928,0.448c0,0-5.696-0.768-9.952,1.76 c-4.128,2.496-6.784,8.256-6.784,8.256s-12.192,32.448-28.448,60.032c-34.272,58.208-48,61.28-53.6,57.664 c-13.024-8.416-9.76-33.856-9.76-51.904c0-56.416,8.544-79.936-16.672-86.016c-8.384-2.016-14.528-3.36-35.936-3.584 c-27.456-0.288-50.72,0.096-63.872,6.528c-8.768,4.288-15.52,13.856-11.392,14.4c5.088,0.672,16.608,3.104,22.72,11.424 c7.904,10.72,7.616,34.848,7.616,34.848s4.544,66.4-10.592,74.656c-10.4,5.664-24.64-5.888-55.2-58.72 c-15.648-27.04-27.488-56.96-27.488-56.96s-2.272-5.568-6.336-8.544c-4.928-3.616-11.84-4.768-11.84-4.768l-73.152,0.448 c0,0-10.976,0.32-15.008,5.088c-3.584,4.256-0.288,13.024-0.288,13.024s57.28,133.984,122.112,201.536 C182.983,404.871,250.503,400.807,250.503,400.807L250.503,400.807z' data-original='%231E88E5' class='active-path' data-old_color='%231E88E5' fill='%23F9F9F9'/%3E%3C/g%3E%3C/svg%3E%0A")
    padding-right: 9px
    padding-top: 6px
.slide-fade-enter-active
  transition: all .3s ease
.slide-fade-leave-active
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0)
.slide-fade-enter, .slide-fade-leave-to
  transform: translateX(10px)
  opacity: 0
.lastWins
  //overflow-x: auto
.lastWins .item h2
  word-break: break-word
  max-width: 5em
.lastWins .item h1
  font-size: 23px
.lastWins .item h3
  font-size: 18px
@media screen and (max-width: 1024px)
  .mainSection div
    width: 66%  
  .topUsers .list .user
    width: 13em !important
  .nices .list .nice
    height: fit-content !important
    flex-direction: column !important
  .nices .list
    .nice:nth-child(1) svg
      width: 6em !important
      margin-top: 40px
      height: auto !important
    .nice:nth-child(2) svg
      width: 8em !important
      height: auto !important
    .nice:nth-child(3) svg
      width: 7em !important
      height: auto !important
    .nice:nth-child(3) p
      margin-top: 0
    .nice
        width: 75vw !important
        padding: 0 2em !important
        p
          text-align: center
  .listCase
      margin-right: 10px !important
  .mainSection h1
    font-size: 3em !important
  .analytic
    flex-direction: column
  .mainSection h2
    font-size: 1.4em !important
    line-height: 1 !important
    text-align: center
  .lastWins
    overflow-x: auto
  .lastWins .list
    padding: 0.5em 0em 0
  .lastWins .list img
    width: 6em
  .lastWins .list h2
    font-size: 16px
  .lastWins .list h3
    font-size: 16px
  .lastWins .list .item
    padding: 0px 21px 2px
  .analytic p
    padding: 0
    margin: 10px 0 9px
  .container .loader
    padding-top: 10px
  .cases.wrap
    max-width: 24em
  .leftMenu svg
    width: 50px
    height: 50px
    margin-left: 6px
.nices h1
  font-size: 35px
  color: white
.nices .list
  display: flex
  align-content: center
  flex-direction: column
  flex-wrap: wrap
.nices .list .nice
  display: flex
  height: 10em
  padding: 0 3em 0
  flex-direction: row
  background: rgba(182, 67, 72, 0.9215686274509803)
  align-items: center
  width: 46%
  text-align: left
  p
    font-size: 20px
    font-weight: 600
    color: white
.nices .list .nice svg
  width: 300px
  padding-right: 15px
.topUsers
  h1
    font-size: 30px
    color: white
    font-size: 25px
    margin: 0
  sup
    font-size: 20px
  .list
    display: flex
    flex-direction: column
    flex-wrap: wrap
    align-content: center
    .user
      display: flex
      color: white
      background: #ba4a4edb
      margin-bottom: 10px
      padding: 0.5em 2em 0.5em
      width: 25em
</style>