<template>
<div is="sui-button-group">
    <sui-button @click="goMultiple">multiple</sui-button>
    <sui-button-or text="ou" />
    <sui-button @click="goSimple" positive>simple</sui-button>
</div>
</template>

<script>
export default {
  methods:{
    goMultiple(){
      location.href = '/home/assignations/add'
    },
    goSimple(){
      location.href = '/home/assignations/simple/add'
    }
  }
}
</script>

<style lang="css" scoped>
</style>
