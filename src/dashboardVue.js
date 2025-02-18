import Vue from 'vue'
import './vueBootstrap.js'
import GifWidget from './views/GifWidget.vue'

document.addEventListener('DOMContentLoaded', () => {
	OCA.Dashboard.register('catgifsdashboard-vue-widget', (el, { widget }) => {
		const View = Vue.extend(GifWidget)
		new View({
			propsData: { title: widget.title },
		}).$mount(el)
	})
})
