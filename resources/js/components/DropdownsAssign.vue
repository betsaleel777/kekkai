<template>
<div class="">
    <sui-dropdown noResultsMessage="Aucune Ue ne correspond" fluid :options="ues" placeholder="Unitée d'enseignement" search selection v-model="ue" />
    <br>
    <sui-dropdown noResultsMessage="Aucun enseignant trouvé" v-show="exist" fluid :options="enseignants" placeholder="Enseignant" search selection v-model="enseignant" />
    <br>
    <attribution-hours v-show="hoursDisplay"></attribution-hours>
</div>
</template>

<script>
Vue.component('attribution-hours', require('../components/HoursAttribution.vue').default)
export default {
    mounted() {
        this.getUes()
        this.getEnseigants()
        this.$root.$on('send_disable', () => {
            this.hoursDisplay = false
        })
        this.$root.$on('send_enable', () => {
            this.hoursDisplay = true
        })
        this.$root.$on('clear_all',() =>{
          this.resetData()
        })
    },
    data() {
        return {
            hoursDisplay: true,
            ues: [],
            ue: null,
            enseignants: [],
            enseignant: null,
            exist: true,
        }
    },
    watch: {
        ue: function() {
            this.$root.$emit('ues_choosen', this.ue) // to {uesInfosTable}
            this.exist = true
        },
        enseignant: function() {
            this.$root.$emit('teacher_choosen', this.enseignant) //to {uesInfosTable}
            this.$root.$emit('take_ens',this.enseignant)
            this.exist = false
        }
    },
    methods: {
        getUes() {
            axios.get('/api/ues/list/').then((response) => {
                const {
                    ues
                } = response.data
                this.ues = ues.map((ue) => {
                    return {
                        text: ue.libelle,
                        value: ue.id
                    }
                })
            }).catch((err) => {
                console.log(err);
            })
        },
        getEnseigants() {
            axios.get('/api/enseignants/list/').then((response) => {
                const {
                    enseignants
                } = response.data
                this.enseignants = enseignants.map((enseignant) => {
                    return {
                        text: enseignant.nomination,
                        value: enseignant.id
                    }
                })
            }).catch((err) => {
                console.log(err);
            })
        },
        resetData(){
          this.hoursDisplay = true,
          this.ue = null,
          this.enseignant = null
          this.exist = true
        }
    }
}
</script>

<style lang="css" scoped>
</style>
