<template>
    
    <div class="row">
        <div v-if="covers.length > 0" v-for="cover in covers">
                <div class="card">
                    <div class="card-header">{{ cover.name }}</div>
    
                    <div class="card-body">
                        <img src="/images/HM-march-2011.jpg" style="width:100px;">
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                covers : [
                ]
            }
        },
        beforeMount(){
            this.fetchTitles()
        },
        mounted() {
            
        },
        methods: {
            fetchTitles: function()
            {
                var $this = this;
                $this.covers = []
                let url = '/api/titles';
                axios.get(url)
                    .then( function(res) {
                        $this.covers = []
                        $this.covers = res.data.data
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
        }
    }
</script>
