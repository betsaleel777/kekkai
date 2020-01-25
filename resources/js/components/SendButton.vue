<template>
<div class="field">
    <button :disabled="etat" @click="assign" id="button" type="submit" class="ui labeled submit icon button"><i class="icon send"></i>envoyer</button>
</div>
</template>

<script>
export default {
    mounted() {
        this.$root.$on('send_disable', () => {
            this.etat = true
            //reactiver le bouton dans le cas contraire
        })
        this.$root.$on('send_enable', () => {
            this.etat = false
        })
    },
    data() {
        return {
            etat: false
        }
    },
    methods: {
        assign() {
            axios.post('', {}).then((response) => {

            }).catch((err) => {
                console.log(err);
            })
        }
    }
}
</script>

<style lang="css" scoped>
 #button{
   margin-bottom:10px;
   margin-top:10px
 }
 @import '~vuejs-noty/dist/vuejs-noty.css'
</style>
