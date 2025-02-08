<template>


</template>
<script>
    import axios from 'axios';

    export default {
      data(){
        return {
          login: 'mail@simonduun.com',
          pwd: '1234'
        }
      },
      methods: {
        submitLogin: function(e) {
          axios.post('/api/login/',{
            login: this.login,
            pwd: this.pwd
          })
          .then(function(response){
            if(response.data.code == 200){
              console.log(response.data.usr)
              localStorage.setItem('user', response.data.usr);
            }
          })
          .catch(function(response){
            console.log(response.data);
          });

          e.preventDefault();
        }
      }
    }
</script>
