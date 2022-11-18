<template>
  <CFooter :fixed="false">
    <div>
      <a href="https://alcohol.nursing.hku.hk" target="_blank">Alcohol</a>
      <span class="ml-1">&copy; {{new Date().getFullYear()}}</span>
    </div>
    <div class="mfs-auto">
      <!-- <span class="mr-1" target="_blank">Powered by</span> -->
      <!-- <a href="https://smoking.nursing.hku.hk">HKU</a> -->
    </div>
  </CFooter>
</template>

<script>
export default {
  name: 'TheFooter'
}
</script>
