<template>
    <div class="dropdown-menu">
        <a :href="'/user/'+ notificate.data.follower.username" class="dropdown-item" aria-labelledby="dropdownMenu"  v-for="notificate in notifications">
            Te ha seguido {{ notificate.data.follower.username }}
        </a>
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data(){
            return {
                notifications:[]
            }
        },
        mounted(){
            axios.get('/api/notifications').then(res => {
                this.notifications = res.data;
                Echo.private(`App.User.${this.user}`).notification(notification =>{
                    this.notifications.unshift(notification)
                })
            })
        }
    }
</script>