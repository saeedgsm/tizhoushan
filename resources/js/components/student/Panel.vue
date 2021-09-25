<template>
  <div class="p-4">
    <div class="col-md-6 col-xl-3">

      <div class="card">
        <div class="card-body">
          <h4 class="card-title font-size-16 mt-0">علم برتر سالار</h4>
        </div>
        <router-link :to="{name : 'Panel'}">همه آزمون ها</router-link>
        <img class="img-fluid" src="/imgs/4.png" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">با علم برتر سالار استعداد های خود را شکوفا کنید!</p>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
name: "Panel"
}
</script>

<style scoped>

</style>