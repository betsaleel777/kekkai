<template>
<sui-table celled>
    <sui-table-header>
        <sui-table-row>
            <sui-table-header-cell>Enseignant</sui-table-header-cell>
            <sui-table-header-cell>CM</sui-table-header-cell>
            <sui-table-header-cell>TD</sui-table-header-cell>
            <sui-table-header-cell>TP</sui-table-header-cell>
            <sui-table-header-cell>Option</sui-table-header-cell>
        </sui-table-row>
    </sui-table-header>
    <sui-table-body>
        <sui-table-row v-for="enseignant in enseignants" :key="enseignant.id">
            <sui-table-cell>{{enseignant.nomination}}</sui-table-cell>
            <sui-table-cell>{{enseignant.cm}}</sui-table-cell>
            <sui-table-cell>{{enseignant.td}}</sui-table-cell>
            <sui-table-cell>{{enseignant.tp}}</sui-table-cell>
            <sui-table-cell>
                <a v-if="!enseignant.status" :href="'/home/assignations/' + enseignant.id + '/' + ue.id + '/alter'">
                    <i class="violet edit outline icon"></i>
                </a>
            </sui-table-cell>
        </sui-table-row>
    </sui-table-body>
    <sui-table-footer>
        <sui-table-row>
            <sui-table-cell>Total</sui-table-cell>
            <sui-table-cell :positive="rest.cm>0" :negative="rest.cm<=0">{{total.cm}}</sui-table-cell>
            <sui-table-cell :positive="rest.td>0" :negative="rest.td<=0">{{total.td}}</sui-table-cell>
            <sui-table-cell :positive="rest.tp>0" :negative="rest.tp<=0">{{total.tp}}</sui-table-cell>
            <sui-table-cell disabled></sui-table-cell>
        </sui-table-row>
        <sui-table-row>
            <sui-table-cell>Reste</sui-table-cell>
            <sui-table-cell>{{rest.cm}}</sui-table-cell>
            <sui-table-cell>{{rest.td}}</sui-table-cell>
            <sui-table-cell>{{rest.tp}}</sui-table-cell>
            <sui-table-cell disabled></sui-table-cell>
        </sui-table-row>
    </sui-table-footer>
</sui-table>
</template>

<script>
export default {
    mounted() {
        this.$root.$on('ues_choosen', (id) => {
            this.getTeacherOf(id)
            this.id = id
        })
        this.$root.$on('teacher_choosen', (id) => {
            this.getOnlyOneInfosTeacher(id)
        })
        this.$root.$on('cm_update', (cm, ancien) => {
            if (isNaN(cm)) {
                this.$noty.warning('Veuillez renseigner une valeure numérique du CM')
            } else {
                if (this.enseignants.length > 0) {
                    this.enseignants = this.enseignants.map((enseignant) => {
                        let cm_number = Number(cm)
                        if (enseignant.status) {
                            enseignant.cm = cm_number
                            if (cm_number == 0) {
                                this.default('cm')
                            } else {
                                if (String(cm_number).length < 2) {
                                    this.total.cm = Number(this.total.cm) + cm_number
                                    this.rest.cm = Number(this.rest.cm) - cm_number
                                } else {
                                    this.total.cm = Number(this.total.cm) + cm_number - Number(ancien)
                                    this.rest.cm = Number(this.rest.cm) - cm_number + Number(ancien)
                                }
                            }

                        }
                        return enseignant
                    })
                }
            }
        })
        this.$root.$on('td_update', (td, ancien) => {
            if (isNaN(td)) {
                this.$noty.warning('Veuillez renseigner une valeure numérique du TD')
            } else {
                if (this.enseignants.length > 0) {
                    this.enseignants = this.enseignants.map((enseignant) => {
                        let td_number = Number(td)
                        if (enseignant.status) {
                            enseignant.td = td_number
                            if (td_number == 0) {
                                this.default('td')
                            } else {
                                if (String(td_number).length < 2) {
                                    this.total.td = Number(this.total.td) + td_number
                                    this.rest.td = Number(this.rest.td) - td_number
                                } else {
                                  this.total.td = Number(this.total.td) + td_number - Number(ancien)
                                  this.rest.td = Number(this.rest.td) - td_number + Number(ancien)
                                }
                            }

                        }
                        return enseignant
                    })
                }
            }
        })
        this.$root.$on('tp_update', (tp, ancien) => {
            if (isNaN(tp)) {
                this.$noty.warning('Veuillez renseigner une valeure numérique du TP')
            } else {
                if (this.enseignants.length > 0) {
                    this.enseignants = this.enseignants.map((enseignant) => {
                        let tp_number = Number(tp)
                        if (enseignant.status) {
                            enseignant.tp = tp_number
                            if (tp_number == 0) {
                                this.default('tp')
                            } else {
                              if (String(tp_number).length < 2) {
                                this.total.tp = Number(this.total.tp) + tp_number
                                this.rest.tp = Number(this.rest.tp) - tp_number
                              } else {
                                this.total.tp = Number(this.total.tp) + tp_number - Number(ancien)
                                this.rest.tp = Number(this.rest.tp) - tp_number + Number(ancien)
                              }
                            }

                        }
                        return enseignant
                    })
                }
            }
        })
        this.$root.$on('clear_all', () => {
            this.resetData()
        })
    },
    data() {
        return {
            enseignants: [],
            total: {},
            rest: {},
            ue: {},
            id: null,
            currentEnseignant: null,
        }
    },
    methods: {
        getTeacherOf(id) {
            axios.get('/api/ues/teachers/' + id).then((response) => {
                const {
                    enseignants
                } = response.data
                const {
                    total
                } = response.data
                const {
                    rest
                } = response.data
                const {
                    ue
                } = response.data
                this.enseignants = enseignants
                this.total = total
                this.rest = rest
                this.ue = ue
            }).catch((err) => {
                console.log(err);
            })
        },
        default (type) {
            axios.get('/api/ues/teachers/' + this.id).then((response) => {
                const {
                    total
                } = response.data
                const {
                    rest
                } = response.data
                if (type === 'cm') {
                    this.total.cm = total.cm
                    this.rest.cm = rest.cm
                } else if (type === 'td') {
                    this.total.td = total.td
                    this.rest.td = rest.td
                } else if (type === 'tp') {
                    this.total.tp = total.tp
                    this.rest.tp = rest.tp
                }
            }).catch((err) => {
                console.log(err);
            })
        },
        getOnlyOneInfosTeacher(id) {
            if (id) {
                axios.get('/api/enseignants/infos/' + id).then((response) => {
                    const {
                        enseignant
                    } = response.data
                    let object = {
                        id: enseignant.id + 1000,
                        nomination: enseignant.nomination,
                        cm: 0,
                        td: 0,
                        tp: 0,
                        status: 'new'
                    }
                    this.currentEnseignant = enseignant.id
                    this.enseignants.push(object)
                }).catch((err) => {
                    console.log(err);
                })
            }
        },
        resetData() {
            this.enseignants = [],
                this.total = {},
                this.rest = {},
                this.ue = {},
                this.currentEnseignant = null
        }
    },
    beforeUpdate() {
        if (this.rest.cm === 0 && this.rest.td === 0 && this.rest.tp === 0) {
            this.$noty.warning('l\'unité d\'enseignement ' + this.ue.libelle + ' a atteint ses limites')
        }

        if (this.rest.cm > 0 || this.rest.td > 0 || this.rest.tp > 0) {
            this.$root.$emit('send_enable', this.ue.id, this.currentEnseignant) //to {sendButon,dropdownsAssign}
        }
    }
}
</script>

<style lang="css" scoped>
</style>
