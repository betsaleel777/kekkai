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
            <sui-table-cell :positive="rest.cm>0" :negative="rest.cm<=0">{{total.cm}}</sui-table-cell>
            <sui-table-cell :positive="rest.td>0" :negative="rest.td<=0">{{total.td}}</sui-table-cell>
            <sui-table-cell :positive="rest.tp>0" :negative="rest.tp<=0">{{total.tp}}</sui-table-cell>
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
            this.id = id
        })
        this.$root.$on('teacher_choosen', (id) => {
            this.getOnlyOneInfosTeacher(id)
        })
        this.$root.$on('cm_update', (cm) => {
            if (isNaN(cm)) {
                this.$noty.warning('Veuillez renseigner une valeure numérique du CM')
            }else{
              if (this.enseignants.length > 0) {
                  this.enseignants = this.enseignants.map((enseignant) => {
                      if (enseignant.status) {
                          enseignant.cm = Number(cm)
                          if(Number(cm) == 0){
                            this.default('cm')
                          }else{
                            console.log('passe aussi');
                            this.total.cm = Number(this.total.cm) + Number(cm)
                            this.rest.cm = Number(this.rest.cm) - Number(cm)
                          }

                      }
                      return enseignant
                  })
              }
            }

        })
        this.$root.$on('td_update', (td) => {
            if (isNaN(td)) {
                this.$noty.warning('Veuillez renseigner une valeure numérique du TD')
            }else{
              if (this.enseignants.length > 0) {
                  this.enseignants = this.enseignants.map((enseignant) => {
                      if (enseignant.status) {
                          enseignant.td = Number(td)
                          if(Number(td) == 0){
                            this.default('td')
                          }else{
                            console.log('passe aussi');
                            this.total.td = Number(this.total.td) + Number(td)
                            this.rest.td = Number(this.rest.td) - Number(td)
                          }

                      }
                      return enseignant
                  })
              }
            }

        })
        this.$root.$on('tp_update', (tp) => {
            if (isNaN(tp)) {
                this.$noty.warning('Veuillez renseigner une valeure numérique du TP')
            }else{
              if (this.enseignants.length > 0) {
                  this.enseignants = this.enseignants.map((enseignant) => {
                      if (enseignant.status) {
                          enseignant.tp = Number(tp)
                          if(Number(tp) == 0){
                            this.default('tp')
                          }else{
                            console.log('passe aussi');
                            this.total.tp = Number(this.total.tp) + Number(tp)
                            this.rest.tp = Number(this.rest.tp) - Number(tp)
                          }

                      }
                      return enseignant
                  })
              }
            }
        })
    },
    data() {
        return {
            enseignants: [],
            total: {},
            rest: {},
            ue: {},
            id:null,
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
        default(type){
          axios.get('/api/ues/teachers/' + this.id).then((response) => {
              const {
                  total
              } = response.data
              const {
                  rest
              } = response.data
              if(type === 'cm'){
                this.total.cm = total.cm
                this.rest.cm = rest.cm
              }else if (type === 'td') {
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
        }
    },
    beforeUpdate() {
        if (this.rest.cm === 0 && this.rest.td === 0 && this.rest.tp === 0) {
            this.$noty.warning('l\'unité d\'enseignement ' + this.ue.libelle + ' a atteint ses limites')
            this.$root.$emit('send_disable') //to {sendButon,dropdownsAssign}
        }

        if (this.rest.cm > 0 || this.rest.td > 0 || this.rest.tp > 0) {
            this.$root.$emit('send_enable', this.ue.id, this.currentEnseignant) //to {sendButon,dropdownsAssign}
        }
    }
}
</script>

<style lang="css" scoped>
</style>
