<script lang="ts" setup>
import DefaultLayoutWithVerticalNav from './components/DefaultLayoutWithVerticalNav.vue'
import { useTheme } from 'vuetify'
import { hexToRgb } from '@layouts/utils'

const { global } = useTheme()
</script>

<template>
<!--  <DefaultLayoutWithVerticalNav>-->
<!--    <RouterView />-->
<!--  </DefaultLayoutWithVerticalNav>-->

  <VApp :style="`--v-global-theme-primary: ${hexToRgb(global.current.value.colors.primary)}`">
    <DefaultLayoutWithVerticalNav />
  </VApp>
</template>

<style lang="scss">
// As we are using `layouts` plugin we need its styles to be imported
@use "@layouts/styles/default-layout";
</style>
