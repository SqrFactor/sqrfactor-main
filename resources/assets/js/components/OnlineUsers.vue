<template>
    <div class="pull-right">
        <span class="notification-icon">
            <i class="fa fa-circle" v-if="checkUser()" style="color:green"></i>
            <i class="fa fa-circle" v-else style="color:red"></i>
        </span>
        <div class="more">
            <i class="fa fa-comments"></i>
        </div>
    </div>
</template>

<script>
    export default{
        props:['friend','onlineusers'],
        methods:{
            checkUser: function(){
                return _.find(this.onlineusers, {id: this.friend.id });
            }
        }
    }    
</script>
