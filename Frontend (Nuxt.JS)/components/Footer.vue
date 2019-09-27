<template>
    <div class="footer">
        <div class="right">
            <img src="/img/visa.svg" width="85px">
            <img src="/img/mastercard.svg" width="80px">
            <img src="/img/qiwi.png" width="90px">
            <img src="/img/wm.png" width="45px">
        </div>
        <span class="info">Кейсы с дизайном</span>
        <span class="copyright">Community Group © 2019<br>Все права защищены. Деньги возврату не подлежат.<br><small>
        <Nuxt-link class="link borderRightLeft" to="/privacy">Правила конфиденциальности</Nuxt-link> | <Nuxt-link class="link borderRightLeft" to="/accept">Пользовательское соглашение</Nuxt-link> |
        <a class="link borderRightLeft" href="https://vk.com/ytdescase" target="_blank">ВКонтакте</a> |
        <a class="link borderRightLeft" href="https://vk.com/topic-184248410_40423366" target="_blank">Отзывы</a>
        <p>email: communitygroup[@]yandex.com | Тех. поддержка в ВК: <a href="https://vk.me/ytdescase">@ytdescase</a></p></small></span>
    </div>
</template>
<style lang="sass">
.footer
    background: #c6464c
    box-shadow: 0 -10px 10px rgba(0,0,0,0.08), 0 -10px 9px rgba(0,0,0,0.08)
    height: 226px
    position: relative
    top: 34vh
.footer .link
    color: #dedede
    font-size: 13px
    font-weight: 300
.footer .copyright
    padding-top: 61px !important
.footer .copyright, .footer .info
    padding: 31px 110px 22px
    color: white
    font-size: 19px
    position: absolute
    font-weight: 700
.borderRightLeft
    display: inline-block;
    color: #474E51;
    position: relative;
.borderRightLeft::after
     content: '';
     position: absolute;
     width: 100%;
     transform: scaleX(1);
     height: 2px;
     bottom: 0;
     left: 0;
     background-color: #fa6168;
     transform-origin: bottom left;
     transition: transform .3s ease-in-out;
.borderRightLeft:hover::after
     transform: scaleX(0)
     transform-origin: bottom right
.footer .right
    padding-right: 10em
    float: right
    color: white
    padding-top: 2em
    align-items: center
    justify-content: center
    display: flex
.footer .right img
    padding-right: 15px
@media screen and (max-width: 1024px)
    .footer
        height: 366px !important
        top: 7vh !important
    .footer .right
        padding-right: 0em !important
        padding-top: 1em !important
    .footer .copyright
        padding: 134px 13px 22px !important
    .footer.copyright, .footer .info
        padding: 102px 12px 22px !important
    .footer.fixed
        display: none
    //    .header, .main, .footer
</style>
