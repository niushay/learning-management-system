import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import vuetify from '@/plugins/vuetify'
import '@/@iconify/icons-bundle'
import { loadFonts } from '@/plugins/webfontloader'

import '@core-scss/template/index.scss'
import '@layouts/styles/index.scss'
import '@styles/styles.scss'

loadFonts()

createInertiaApp({
  progress: {
    delay: 250,
    color: '#29d',
    includeCSS: true,
    showSpinner: true,
  },
  resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
    return pages[`./pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({render: () => h(App, props) })
      .use(plugin)
      .use(vuetify)
      .use(ZiggyVue)
      .mount(el)
  },
})
