<template>
<div class="">
    <div class="field">
        <label>Heures CM attribuées:</label>
        <div class="ui labeled input">
            <input type="text" v-model="cm">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        <div v-if="messages.cm.activate" class="ui red tiny message">{{messages.cm.content}}</div>
    </div>
    <div class="field">
        <label>Heures TD attribuées:</label>
        <div class="ui labeled input">
            <input type="text" v-model="td">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        <div v-if="messages.td.activate" class="ui red tiny message">{{messages.td.content}}</div>
    </div>
    <div class="field">
        <label>Heures TP attribuées:</label>
        <div class="ui labeled input">
            <input type="text" v-model="tp">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
        <div v-if="messages.tp.activate" class="ui red tiny message">{{messages.tp.content}}</div>
    </div>
</div>
</template>

<script>
export default {
    mounted(){
      this.$root.$on('ues_choosen',(ue) =>{
        this.ue = ue
      })
      this.$root.$on('clear_all',() =>{
        this.resetData()
      })
    },
    data() {
        return {
            cm: null,
            td: null,
            tp: null,
            ue:null,
            goodCm:true,
            goodTp:true,
            goodTd:true,
            messages: {
                cm: {
                    activate: false,
                    content: null
                },
                td: {
                    activate: false,
                    content: null
                },
                tp: {
                    activate: false,
                    content: null
                }
            }
        }
    },
    watch: {
        cm: function() {
            this.cmMessageClear()
            this.cmCorrect()
            if (this.goodCm) {
                this.$root.$emit('cm_update', this.cm) //uesInfosTable listen
                this.$root.$emit('take_cm', this.cm) //sendButon listen
            }
        },
        td: function() {
            this.tdMessageClear()
            this.tdCorrect()
            if (this.goodTd) {
                this.$root.$emit('td_update', this.td) //uesInfosTable listen
                this.$root.$emit('take_td', this.td)  //sendButon listen
            }
        },
        tp: function() {
            this.tpMessageClear()
            this.tpCorrect()
            if (this.goodTp) {
                this.$root.$emit('tp_update', this.tp) //uesInfosTable listen
                this.$root.$emit('take_tp', this.tp) //sendButon listen
            }
        }
    },
    methods: {
        cmCorrect() {
            if(this.cm && !isNaN(this.cm)){
              axios.get('/api/check/cm/'+this.cm+'/'+this.ue).then((response) => {
                   const {error} = response.data
                   if(error != null){
                     this.messages.cm.content = 'Valeure incorrecte d\'heures CM détectée.'
                     this.messages.cm.activate = true
                     this.$root.$emit('button_block')
                   }
              }).catch((err) => {
                  console.log(err)
              })
            }
        },
        tdCorrect() {
           if(this.td && !isNaN(this.td)){
             axios.get('/api/check/td/'+this.td+'/'+this.ue).then((response) => {
               const {error} = response.data
               if(error != null){
                 this.messages.td.content = 'Valeure incorrecte d\'heures TD détectée.'
                 this.messages.td.activate = true
                 this.$root.$emit('button_block')
               }
             }).catch((err) => {
               console.log(err)
             })
           }
        },
        tpCorrect() {
            if(this.tp && !isNaN(this.tp)){
              axios.get('/api/check/tp/'+this.tp+'/'+this.ue).then((response) => {
                  const {error} = response.data
                  if(error != null){
                    this.messages.tp.content = 'Valeure incorrecte d\'heures TP détectée.'
                    this.messages.tp.activate = true
                    this.$root.$emit('button_block')
                  }
              }).catch((err) => {
                  console.log(err)
              })
            }
        },
        cmMessageClear(){
          this.messages.cm.content = null
          this.messages.cm.activate = false
        },
        tdMessageClear(){
          this.messages.td.content = null
          this.messages.td.activate = false
        },
        tpMessageClear(){
          this.messages.tp.content = null
          this.messages.tp.activate = false
        },
        clearAllMessages() {
            this.messages.cm.content = null
            this.messages.td.content = null
            this.messages.tp.content = null
            this.messages.cm.activate = false
            this.messages.td.activate = false
            this.messages.tp.activate = false
        },
        resetData(){
          this.cm = null
          this.td = null
          this.tp = null
          this.ue = null
        }
    }
}
</script>

<style lang="css" scoped>
</style>
