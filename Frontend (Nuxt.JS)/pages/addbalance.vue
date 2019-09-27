<template>
    <div class="main">
        <section>
                <div class="caseInfo mm">
                    <center>
                        <h2 style="font-weight: 350 !important;">Пополнение счета</h2>
                        <p class="mon"><input class="money" id="sum" type="num" value="100" placeholder="Сумма" min="10" max="10000">₽ <button v-on:click="payment" style="margin-left: 20px;">Пополнить</button></p>
                        <p><a href="#" v-on:click="showPromocode">Ввести промокод</a></p>
                        <p class="promoLabel">Использован промокод <span id="promok"></span></p>
                        <p class="promocode">
                            <input type="text" id="promocode" placeholder="Промокод">
                            <button v-on:click="activatePromocode" style="margin-top: 10px;">Активировать</button>
                        </p>
                    </center></div>
        </section>
    </div>
</template>
<style lang="sass">
.main
    display: flex
    justify-content: center
    align-items: center
    height: 100%
.moneyback
    font-size: 14px
    color: #f0f0f0
    font-weight: 300
    padding: 16px 0 0
input[type="num"].money
    font-size: 30px
    padding: 5px 14px 5px
    width: 115px
    text-align: center
    margin-right: 10px
.caseInfo p.mon
    font-size: 29px
    margin: 12px 0 10px
.caseInfo.mm
    display: flex
    justify-content: center
    align-items: center
    padding-top: 16px
    flex-direction: column
.promocode
    display: none
    opacity: 0
    margin-top: 10px
    transition: 0.3s ease-out
.promoLabel
    font-size: 15px
    color: #ffdee0
    display: none
select#cur
    border: none
    padding: 10px 1px 6px
    font-size: 26px
    background: transparent
    color: white
section
    width: 100%
a
    color: white !important
@media screen and (max-width: 1024px)
    p.mon button
        margin-left: 0 !important
</style>

<script>
import axios from 'axios'
import sha1 from 'js-sha1'

export default {
  data () {
    return { data: {} }
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
                $('.caseInfo').css('display', 'flex');
                self.accountLoaded = true;
                if (self.data.wins[0]) {
                    $('#notText').hide();
                }
            } else {
                alert('Ошибка соединения');
            }
        }); 
    } else {
        this.$nuxt.$router.replace({ path: '/login' });
    }

    function getCookie(name) {
      var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    }
  },
  methods: {
      payment: function () {
          var promocode = $('#promok').text();
          var sum = $('#sum').val();
          if (sum >= 10 && sum <= 10000) {
              $('.overlay').css('display', 'flex');
              this.ajax({
                  url: '/payments/create',
                  method: 'post',
                  data: 'sum='+sum+'&promocode='+promocode
              }).then(function(data){
                  window.open(data.data.paymentUrl);
                  $('.overlay').hide();
              });
          } else if (sum > 10000) {
              window.startNotifyClient('Сумма должна быть не больше 10.000₽');
          } else {
              window.startNotifyClient('Сумма должна быть не меньше 10₽');
          }
      },
      showPromocode: function () {
          if ($('.promocode').css('display') == 'block') {
              $('.promocode').css({ opacity: 0, 'margin-top': 10 }).hide();
          } else {
              $('.promocode').show().css({ opacity: 1, 'margin-top': 0 });
          }
      },
      activatePromocode: function () {
          var input =  $('#promocode').val().replace(' ', '');
          if (input != '') {
              this.ajax({
                  url: '/payments/checkPromocode',
                  method: 'post',
                  data: 'promocode='+input+'&amount='+$('#sum').val()
              }).then(function(data){
                  if (data.data.result == true) {
                      window.startNotifyClient('Промокод активирован');
                      $('.promoLabel').show();
                      $('#promok').text(input);
                      $('.promocode').css({ opacity: 0, 'margin-top': 10 }).hide();
                  } else {
                      window.startNotifyClient(data.data.errorText);
                  }
              });
          } else {
              window.startNotifyClient('Вы не ввели промокод');
          }
      }
  }
}
</script>