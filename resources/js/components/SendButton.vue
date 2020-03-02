<template>
<div class="field">
    <button :disabled="etat" @click="assign" type="button" id="button" class="ui labeled submit icon button"><i class="icon send"></i>envoyer</button>
</div>
</template>

<script>
export default {
    mounted() {
        this.$root.$on('send_disable', () => {
            this.etat = true
        })
        this.$root.$on('send_enable', (ue) => {
            this.etat = false
            this.ue = ue
        })
        this.$root.$on('take_cm',(cm) =>{
          this.cm = cm
        })
        this.$root.$on('take_td',(td) =>{
          this.td = td
        })
        this.$root.$on('take_tp',(tp) =>{
          this.tp = tp
        })
        this.$root.$on('take_ens',(ens) =>{
          this.enseignant = ens
        })
        this.$root.$on('button_block',() =>{
          this.etat = true
        })
    },
    data() {
        return {
            etat: false,
            ue:null,
            enseignant:null,
            cm:null,
            td:null,
            tp:null
        }
    },
    methods: {
        assign() {
            if(this.cm !== null && this.td !== null && this.tp !== null && this.ue !== null && this.enseignant !== null){
              axios.get('/api/assign/'+Number(this.ue)+'/'+Number(this.enseignant)+'/'+Number(this.cm)+'/'+Number(this.td)+'/'+Number(this.tp)).then((response) => {
                this.$noty.success(response.data.message)
                this.$root.$emit('clear_all') //HoursAttribution, uesInfosTable, dropdownsAssign
              }).catch((err) => {
                console.log(err)
              })
            }else{
              this.$noty.error('Champs vide détectée, Veuillez renseigner correctement les champs.')
            }
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
