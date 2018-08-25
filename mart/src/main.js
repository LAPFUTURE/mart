import Vue from 'vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import Navi from './components/Navi/Navi.vue'
import router from './router'
import axios from 'axios'
import './scss/common.css';
import echarts from 'echarts';
import moment from 'moment';
 
Vue.config.productionTip = false
Vue.prototype.$axios = axios;
Vue.use(ElementUI)
Vue.prototype.$echarts = echarts;
Vue.prototype.$moment = moment;
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  render: h => h(Navi)
})
