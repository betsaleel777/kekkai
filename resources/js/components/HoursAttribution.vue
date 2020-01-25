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
    </div>
    <div class="field">
        <label>Heures TD attribuées:</label>
        <div class="ui labeled input">
            <input type="text" v-model="td">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
    <div class="field">
        <label>Heures TP attribuées:</label>
        <div class="ui labeled input">
            <input type="text" v-model="tp">
            <div class="red ui corner label">
                <i class="asterisk icon"></i>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            cm: null,
            td: null,
            tp: null
        }
    },
    watch: {
        cm: function() {
            if (this.cmCorrect()) {
                console.log('passe dans cm watcher');
                this.$root.$emit('cm_update', this.cm)
            } else {
                //do something else
            }
        },
        td: function() {
            if (this.tdCorrect()) {
                this.$root.$emit('td_update', this.td)
            } else {

            }
        },
        tp: function() {
            if (this.tpCorrect()) {
                this.$root.$emit('tp_update', this.tp)
            }
        }
    },
    methods: {
        cmCorrect() {
            return true
        },
        tdCorrect() {
            return true
        },
        tpCorrect() {
            return true
        }
    }
}
</script>

<style lang="css" scoped>
</style>
