<template>
  <main>
    <div class="layout-wrapper layout-blank">
      <slot />
    </div>
  </main>
</template>

<style>
.layout-wrapper.layout-blank {
  flex-direction: column;
}
div#app {
  background-color: #f5f5f9;
}
</style>
