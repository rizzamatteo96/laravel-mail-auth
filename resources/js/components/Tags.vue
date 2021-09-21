<template>
  <div class="d-inline-block">
    <span class="badge bg-success text-white mx-1" v-for="(tag,i) in tagList" :key="i">{{tag.name}}</span>
  </div>
</template>

<script>
export default {
  name: 'Tags',
  props: ['tagList']
}
</script>

<style lang="scss" scoped>

</style>