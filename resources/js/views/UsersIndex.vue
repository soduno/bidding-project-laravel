<template>
    <div class="users">

        <ul v-if="users">
            <li v-for="{name, email} in users">
                <strong>Name:</strong> {{ name }}
                <strong>Email:</strong> {{ email }}
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';
    export default{
        data() {
            return {
                loading: false,
                users: null,
                error: null,
            };
        },
        created(){
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.error = this.users = null;
                this.loading = true;
                axios
                    .get('api/users')
                    .then(response => {
                       this.users = response.data;
                    });
            }
        }
    }
</script>
