<template>
    <div>
        <h1>test</h1>
        <table>
            <tr v-for="people in peoples" v-bind:key="people.id">
                <td>
                    {{people.first_name}}
                </td>
                <td>
                    {{people.email}}
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
// import axios from 'axios'

// axios.defaults.withCredentials = true
// axios.defaults.baseURL = 'http://localhost:8000'

export default {
    data(){
        return{
            peoples:[],
            people:{
                id: '',
                first_name: '',
                last_name: '',
                email: '',
            }
        }
    },

    created(){
        this.fetchPeoples();
    },

    methods:{
       fetchPeoples(page_url){
            page_url =  'http://localhost:8000/api/useraccounts';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.peoples = res.data
                console.log('then');
            })
            .catch(err => {
                console.log('error');
            })
        },
    }
    //puro error nalang haha
}
</script>