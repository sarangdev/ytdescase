<template>
    <section>
        <center><div id="loading" v-if="adminkaLoaded == false"></div></center>
        <div class="caseInfo" style="display: block" v-if="adminkaLoaded == true">
            <h2>Проверка наличия выигрыша у игрока</h2>
            <div style="padding: 20px;">
                <input type="text" id="uid" placeholder="ID игрока" style="width: 7em;">
                <input type="text" id="cid" placeholder="ID кейса" style="width: 7em;">
                <input type="text" id="itemid" placeholder="ID вещи" style="width: 7em;">
                <button class="ripple" v-on:click="checkSubmit">Проверить</button>
            </div>
            <h2>Информация о вещи</h2>
            <div style="padding: 20px;">
                <input type="text" id="getitemid" placeholder="ID вещи" style="width: 8em;">
                <button class="ripple" v-on:click="infoSubmit">Получить</button>
            </div>
            <h2>Информация о игроке</h2>
            <div style="padding: 20px;">
                <input type="text" id="getuinfo" placeholder="ID игрока" style="width: 8em;">
                <button class="ripple" v-on:click="uSubmit">Получить</button>
            </div>
            <h2>Выдача денег</h2>
            <div style="padding: 20px;">
                <input type="text" id="monuid" placeholder="ID игрока" style="width: 7em;">
                <input type="text" id="monbal" placeholder="Количество (₽)" style="width: 8em;">
                <button class="ripple" v-on:click="balSubmit">Выдать</button>
            </div>
        </div>
    </section>
</template>
<style lang="sass">

// @media screen and (max-width: 850px)

</style>
<script>
    import axios from 'axios';

    export default {
        data () {
            return { adminkaLoaded: false }
        },
        async mounted () {
            var self = this;
            var token = window.getCookie('token');
            if (!token) {
                this.$nuxt.$router.replace({ path: '/login' });
            }
            this.ajax = axios.create({
                    baseURL: process.env.apiUrl,
                    headers: {'X-Token': token}
            });
            await this.ajax.post('/getuserdata').then(function(data){
                if (!data.data.admin) {
                    self.$nuxt.$router.replace({ path: '/' });
                } else {
                    self.adminkaLoaded = true;
                }
            });

        },
        methods: {
            checkSubmit: function () {
                var uid = $('#uid').val();
                var cid = $('#cid').val();
                var itemid = $('#itemid').val();
                this.ajax({
                    url: '/adminka/3e85s9aa24/checkWin',
                    method: 'post',
                    data: 'uid='+uid+'&cid='+cid+'&itemid='+itemid
                }).then(function(data){
                    window.startNotifyClient(data.data.error);
                });
            },
            infoSubmit: function () {
                var getitemid = $('#getitemid').val();
                this.ajax({
                    url: '/adminka/3e85s9aa24/getItem',
                    method: 'post',
                    data: 'itemid='+getitemid
                }).then(function(data){
                    window.startNotifyClient(data.data.result, 13000);
                });
            },
            uSubmit: function () {
                var getitemid = $('#getuinfo').val();
                this.ajax({
                    url: '/adminka/3e85s9aa24/getUserInfo',
                    method: 'post',
                    data: 'uid='+getitemid
                }).then(function(data){
                    window.startNotifyClient(data.data.result, 19000);
                });
            },
            balSubmit: function () {
                var uid = $('#monuid').val();
                var mon = $('#monbal').val();
                this.ajax({
                    url: '/adminka/3e85s9aa24/giveMoney',
                    method: 'post',
                    data: 'uid='+uid+'&bal='+mon
                }).then(function(data){
                    if (uid == window.userdata.id) {
                        var dd = parseInt(window.userdata.balance)+parseInt(mon);
                        window.money(dd);
                    }
                    window.startNotifyClient(data.data.error);
                });
            }
        }
    }
</script>