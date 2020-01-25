<template>
<div class="">
    <sui-dropdown noResultsMessage="Aucune Ue ne correspond" fluid :options="ues" placeholder="Unitée d'enseignement" search selection v-model="ue" />
    <br>
    <sui-dropdown noResultsMessage="Aucun enseignant trouvé" v-show="exist" fluid :options="enseignants" placeholder="Enseignant" search selection v-model="enseignant" />
    <br>
</div>
</template>

<script>
export default {
    mounted() {
        this.getUes()
        this.getEnseigants()
    },
    data() {
        return {
            ues: [],
            ue: null,
            enseignants: [],
            enseignant: null,
            exist: true
        }
    },
    watch: {
        ue: function() {
            this.$root.$emit('ues_choosen', this.ue)
            this.exist = true
        },
        enseignant: function() {
            this.$root.$emit('teacher_choosen', this.enseignant)
            this.exist = false
            this.enseignant = null
        }
    },
    methods: {
        getUes() {
            axios.get('/api/ues/list').then((response) => {
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
            axios.get('/api/enseignants/list').then((response) => {
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
        tableCall() {
            this.$root.$emit('ues_choosen', this.ue)
        }
    }
}
</script>

<style lang="css" scoped>
</style>
