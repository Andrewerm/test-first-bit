require('./bootstrap');
import { createApp,h } from 'vue'
import MainComponent from "@/components/MainComponent";

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'


const app  = createApp({
    render: ()=>h(MainComponent)
});

const vuetify = createVuetify({
    components,
    directives,
})
app.use(vuetify).mount('#app');






