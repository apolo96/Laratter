<template>
    <div class="row">
        <a href="#" class="btn btn-primary" v-on:click="showResponse">Ver respuestas</a>
        <div class="col-12 mb-2" v-for="response in responses">
            <div class="card" >
                <div class="card-body">
                    <p>
                        {{ response.message }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'id'
        ],

        data(){
            return {
                responses:[]
            }
        },

        methods:{
            showResponse(){
                axios.get('/api/message/'+this.id).then(res =>{
                    this.responses = res.data;
                })
            }
        }
    }
</script>