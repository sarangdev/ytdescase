<template>
  <section class="container login">
    <!-- <form class="LoginBox">
        <p class="login">
            <input type="email" class="error" name="email" placeholder="E-Mail">
        </p>
        <p class="password">
            <input type="password" name="password" placeholder="Пароль">
        </p>
        <button class="btn">Войти</button>
    </form> -->
    <div class="LoginBox social">
        <div id="vk_auth"></div>
    <!--    <div type="button" class="google-button" v-on:click="googleLogin">
        <span class="google-button__icon">
            <svg viewBox="0 0 366 372" xmlns="http://www.w3.org/2000/svg"><path d="M125.9 10.2c40.2-13.9 85.3-13.6 125.3 1.1 22.2 8.2 42.5 21 59.9 37.1-5.8 6.3-12.1 12.2-18.1 18.3l-34.2 34.2c-11.3-10.8-25.1-19-40.1-23.6-17.6-5.3-36.6-6.1-54.6-2.2-21 4.5-40.5 15.5-55.6 30.9-12.2 12.3-21.4 27.5-27 43.9-20.3-15.8-40.6-31.5-61-47.3 21.5-43 60.1-76.9 105.4-92.4z" id="Shape" fill="#EA4335"/><path d="M20.6 102.4c20.3 15.8 40.6 31.5 61 47.3-8 23.3-8 49.2 0 72.4-20.3 15.8-40.6 31.6-60.9 47.3C1.9 232.7-3.8 189.6 4.4 149.2c3.3-16.2 8.7-32 16.2-46.8z" id="Shape" fill="#FBBC05"/><path d="M361.7 151.1c5.8 32.7 4.5 66.8-4.7 98.8-8.5 29.3-24.6 56.5-47.1 77.2l-59.1-45.9c19.5-13.1 33.3-34.3 37.2-57.5H186.6c.1-24.2.1-48.4.1-72.6h175z" id="Shape" fill="#4285F4"/><path d="M81.4 222.2c7.8 22.9 22.8 43.2 42.6 57.1 12.4 8.7 26.6 14.9 41.4 17.9 14.6 3 29.7 2.6 44.4.1 14.6-2.6 28.7-7.9 41-16.2l59.1 45.9c-21.3 19.7-48 33.1-76.2 39.6-31.2 7.1-64.2 7.3-95.2-1-24.6-6.5-47.7-18.2-67.6-34.1-20.9-16.6-38.3-38-50.4-62 20.3-15.7 40.6-31.5 60.9-47.3z" fill="#34A853"/></svg>
        </span>
        <span class="google-button__text">Войти</span>
        </div>  -->
    </div>
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=6Ley5qoUAAAAAHc5fWV9dej2Rqzv9lx-pJdksPg5"></script>
  </section>
</template>
<script lang="jquery">
import $ from 'jquery'
import jQuery from 'jquery'
import axios from 'axios';

export default {
  mounted() {
      self = this;
      var token = getCookie('token');
           this.ajax = axios.create({
                baseURL: process.env.apiUrl,
                headers: {'X-Token': token}
            });

        // Авторизация через ВК
        VK.init({apiId: 7035278});

        VK.Widgets.Auth("vk_auth", {"width":250,"onAuth":function(data) {
            grecaptcha.execute('6Ley5qoUAAAAAHc5fWV9dej2Rqzv9lx-pJdksPg5').then(function(token) {
                data.recaptcha = token;
                self.ajax.post('/socialLogin', JSON.stringify(data)).then(function(result) {
                    if (!result.data.error) {
                        window.startNotifyClient(result.data.message);
                        document.cookie = "token="+result.data.token+"; path=/; expires=99999";
                        self.$nuxt.$router.replace({ path: '/' });
                        window.location.reload();
                    } else {
                        showError(result.data.error);
                    }
                });
            });
        }});

      if (token) {
          this.$nuxt.$router.replace({ path: '/' });
      }
        $.each($('.tooltip'), function (i, v) {
            $(v).animate({ opacity: 1, left: '100%' }, 250);
        })

        $('form.LoginBox').submit(function(event){
            event.preventDefault();
            var form = $(this).serialize();
            $.post(process.env.apiUrl+'/login', form, function (result) {
                result = JSON.parse(result);
                if (result.error != null) {
                    showError(result.error);
                } else {
                    startNotifyClient();
                    document.cookie = "token="+result.token+"; path=/; expires=99999";
                   self.$nuxt.$router.replace({ path: '/' });
                   window.location.reload();
                }
            }).fail(function(){
                showError('Ошибка соединения');
            });
        });

            function getCookie(name) {
              var matches = document.cookie.match(new RegExp(
                  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
              ));
              return matches ? decodeURIComponent(matches[1]) : 0;
            }

        function showError(text) {
            console.log('Error: ' + text);
            if ($('.tooltip.custom').length) {
                $('.tooltip.custom').remove();
                $('form.LoginBox p.login').append('<span class="tooltip custom">'+text+'</span>');
                $.each($('.tooltip'), function (i, v) {
                    $(v).animate({ opacity: 1, left: '100%' }, 250);
                })
            } else {
                $('form.LoginBox p.login').append('<span class="tooltip custom">'+text+'</span>');
                $.each($('.tooltip'), function (i, v) {
                    $(v).animate({ opacity: 1, left: '100%' }, 250);
                })
            }
        }
  },
  methods: {
    /* googleLogin: function () {
        gapi.load('auth2', function() {
            var auth2 = gapi.auth2.init({
                client_id: '311840269981-trhl98rq5llpmgn4h8vlbg72j0kdb5hr.apps.googleusercontent.com',
                fetch_basic_profile: false,
                scope: 'profile'
            });

            // Sign the user in, and then retrieve their ID.
            auth2.signIn().then(function() {
                var profile = auth2.currentUser.get().getBasicProfile();
                var data = { uid: profile.getId(),
                first_name: profile.getGivenName(),
                last_name: profile.getFamilyName(),
                hash: '311840269981-trhl98rq5llpmgn4h8vlbg72j0kdb5hr.apps.googleusercontent.com'+profile.getId()+'69386205826925911068185396483232',
                photo: profile.getImageUrl() };
                self.ajax.post('/socialLogin', data).then(function(result) {
                    if (!result.data.error) {
                        window.startNotifyClient();
                        document.cookie = "token="+result.data.token+"; path=/; expires=99999";
                        self.$nuxt.$router.replace({ path: '/' });
                        window.location.reload();
                    } else {
                        alert(result.data.error);
                    }
                });                
                console.log(auth2.currentUser.get().getId());
            });
        });
    } */
  }
}
</script>
<style lang="sass">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap')
.container.login
  min-height: 100vh
  display: flex
  justify-content: center
  align-items: center
  text-align: center
.LoginBox.social
    margin: 0 22px 0
form.LoginBox
    box-shadow: 6px 6px 22px rgba(0, 0, 0, 0.44)
    background: #35495d
    min-width: 26%
    border-radius: 5em
    padding: 2em 4em 2.8em
    p
        position: relative
input
    border: none
    box-shadow: 0 0 6px #00000054
    padding: 10px 13px 10px
    margin: 0px 0 5px
    font-size: 17px
    outline: none
    font-weight: 600
    font-family: 'Open Sans', sans-serif
    max-width: 90%
    width: 100%
button
    font-size: 21px
    border: none
    font-weight: 600
    width: 100%
    box-shadow: 0 0 4px #00000033
    padding: 5px 12px 9px
    outline: none
    font-family: 'Open Sans', sans-serif

button:active
    transform: scale(1.02)
    transition: ease-in-out 0.2s
.google-button
  cursor: pointer
  margin-top: 10px
  height: 40px;
  border-width: 0;
  background: white;
  color: #737373;
  border-radius: 5px;
  white-space: nowrap;
  box-shadow: 1px 1px 0px 1px rgba(0,0,0,0.05);
  transition-property: background-color, box-shadow;
  transition-duration: 150ms;
  transition-timing-function: ease-in-out;
  padding: 0;
  padding-top: 5px
  font-family: 'Open Sans', sans-serif
  
  &:focus,
  &:hover
    box-shadow: 1px 4px 5px 1px rgba(0,0,0,0.1);
  
  &:active
    background-color: #e5e5e5;
    box-shadow: none;
    transition-duration: 10ms;
    
.google-button__icon
  display: inline-block;
  vertical-align: middle;
  margin: 8px 0 8px 8px;
  width: 18px;
  height: 18px;
  box-sizing: border-box;

.google-button__icon--plus
  width: 27px;

.google-button__text
  display: inline-block;
  vertical-align: middle;
  padding: 0 24px;
  font-size: 15px;
  font-weight: bold;
  font-family: 'Open Sans', sans-serif
</style>

