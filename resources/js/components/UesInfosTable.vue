<template>
<sui-table celled>
    <sui-table-header>
        <sui-table-row>
            <sui-table-header-cell>Enseignant</sui-table-header-cell>
            <sui-table-header-cell>CM</sui-table-header-cell>
            <sui-table-header-cell>TD</sui-table-header-cell>
            <sui-table-header-cell>TP</sui-table-header-cell>
        </sui-table-row>
    </sui-table-header>
    <sui-table-body>
        <sui-table-row v-for="enseignant in enseignants" :key="enseignant.id">
            <sui-table-cell>{{enseignant.nomination}}</sui-table-cell>
            <sui-table-cell>{{enseignant.cm}}</sui-table-cell>
            <sui-table-cell>{{enseignant.td}}</sui-table-cell>
            <sui-table-cell>{{enseignant.tp}}</sui-table-cell>
        </sui-table-row>
    </sui-table-body>
    <sui-table-footer>
        <sui-table-row>
            <sui-table-cell>Total</sui-table-cell>
            <sui-table-cell :positive="rest.cm>total.cm" :negative="rest.cm<total.cm">{{total.cm}}</sui-table-cell>
            <sui-table-cell :positive="rest.cm>total.cm" :negative="rest.cm<total.cm">{{total.td}}</sui-table-cell>
            <sui-table-cell :positive="rest.cm>total.cm" :negative="rest.cm<total.cm">{{total.tp}}</sui-table-cell>
        </sui-table-row>
        <sui-table-row>
            <sui-table-cell>Reste</sui-table-cell>
            <sui-table-cell>{{rest.cm}}</sui-table-cell>
            <sui-table-cell>{{rest.td}}</sui-table-cell>
            <sui-table-cell>{{rest.tp}}</sui-table-cell>
        </sui-table-row>
    </sui-table-footer>
</sui-table>
</template>

<script>
export default {
    mounted() {
        this.$root.$on('ues_choosen', (id) => {
            this.getTeacherOf(id)
        })
        this.$root.$on('teacher_choosen', (id) => {
            this.getOnlyOneInfosTeacher(id)
        })
        this.$root.$on('cm_update', (cm) => {
            //faire un objet globale afin que les composant ait un accès centralisé
            //cet objet sera définit par ue,enseignant,cm,td,tp
            if(Number(cm) === 0 || isNaN(Number(cm))){
              this.$noty.warning('Veuillez renseignez une valeure Numérique des heures de CM')
            }else{
              this.enseignants = this.enseignants.map((enseignant) => {
                if (enseignant.cm === 0 && enseignant.td === 0 && enseignant.tp === 0) {
                  enseignant.cm = cm
                  this.total.cm = Number(this.total.cm)+Number(cm)
                  this.rest.cm -= cm
                }
                return enseignant
              })
            }
        })
    },
    data() {
        return {
            enseignants: null,
            total: {},
            rest: {},
        }
    },
    methods: {
        getTeacherOf(id) {
            axios.get('/api/ues/teachers/' + id).then((response) => {
                this.enseignants = response.data.enseignants
                this.total = response.data.total
                this.rest = response.data.rest
                this.ue = response.data.ue
            }).catch((err) => {
                console.log(err);
            })
        },
        inserer(enseignant) {
            if (!this.enseignants.includes(enseignant.id)) {
                this.enseignants.push(enseignant)
            }
        },
        getOnlyOneInfosTeacher(id) {
            if (id) {
                axios.get('/api/enseignants/infos/' + id).then((response) => {
                    const {
                        enseignant
                    } = response.data
                    let object = {
                        id: enseignant.id,
                        nomination: enseignant.nomination,
                        cm: 0,
                        td: 0,
                        tp: 0
                    }
                    this.inserer(object)
                }).catch((err) => {
                    console.log(err);
                })
            }
        }
    },
    beforeUpdate() {
        if (this.rest.cm <= this.total.cm && this.rest.td <= this.total.td && this.rest.tp <= this.total.tp) {
            this.$noty.warning('l\'unité d\'enseignement ' + this.ue.libelle + ' a atteint la limite d\'heures à attribuer')
            this.$root.$emit('send_disable')
        }

        if (this.rest.cm > this.total.cm || this.rest.td > this.total.td || this.rest.tp > this.total.tp) {
            this.$root.$emit('send_enable')
        }
    }
}
</script>

<style lang="css" scoped>
</style>
