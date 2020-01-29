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
            if(Number(this.cm) !== 0 && Number(this.td) !== 0 && Number(this.tp) !== 0 && Number(this.ue) !== 0 && Number(this.enseignant) !== 0){
              axios.get('/api/assign/'+this.ue+'/'+this.enseignant+'/'+this.cm+'/'+this.td+'/'+this.tp).then((response) => {
                console.log(response.data);
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
