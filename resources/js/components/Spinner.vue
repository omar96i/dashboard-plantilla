<template>
    <div class="d-flex justify-content-center" v-if="loading">
        <bounce-loader :color="color"></bounce-loader>
        <bounce-loader :color="color"></bounce-loader>
        <bounce-loader :color="color"></bounce-loader>
        <bounce-loader :color="color"></bounce-loader>
    </div>
</template>

<script>
    import BounceLoader from 'vue-spinner/src/BounceLoader.vue'
    export default {
        props:['loading'],
        components: {
			BounceLoader
		},
        data(){
            return{
                color:'#1cc88a'
            }
        }
    }
</script>

