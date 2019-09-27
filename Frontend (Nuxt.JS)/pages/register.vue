<template>
  <section class="container register">
    <form class="RegBox">
        <p class="login">
            <input type="email" class="error" name="email" placeholder="E-Mail">
        </p>
        <p class="password">
            <input type="password" name="password" placeholder="Пароль">
        </p>
        <button class="btn">Готово</button>
    </form>
  </section>
</template>
<script lang="jquery">
import $ from 'jquery'
import jQuery from 'jquery'

export default {
  mounted() {
      // DELETE
      this.$nuxt.$router.replace({ path: '/' });

      self = this;
      var token = getCookie('token');
      if (token) {
          this.$nuxt.$router.replace({ path: '/' });
      }

        $.each($('.tooltip'), function (i, v) {
            $(v).animate({ opacity: 1, left: '100%' }, 250);
        })

        $('form.RegBox').submit(function(event){
            event.preventDefault();
            var form = $(this).serialize();
            $.post(process.env.apiUrl+'/register', form, function (result) {
                window.startNotifyClient();
                result = JSON.parse(result);
                if (result.error != null) {
                    showError(result.error);
                } else {
                    document.cookie = "token="+result.token+"; path=/; expires=99999";
                    self.$nuxt.$router.replace({ path: '/' });
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
  }
}
</script>
<style lang="sass">
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap')
.container.register
  min-height: 100vh
  display: flex
  justify-content: center
  align-items: center
  text-align: center

form.RegBox
    box-shadow: 6px 6px 22px rgba(0, 0, 0, 0.44)
    background: #35495d
    min-width: 26%
    padding: 2em 4em 2.8em
    border-radius: 5em
    p
        position: relative
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
</style>

