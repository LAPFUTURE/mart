import Vue from 'vue'
import Router from 'vue-router'
import cardIssue from '@/components/cardIssue'
import cardOff from '@/components/cardOff'
import telephoneOrder from '@/components/telephoneOrder'
import sysOrder from '@/components/sysOrder'
import sendInfo from '@/components/sendInfo'
import orderManager from '@/components/orderManager'
import supplier from '@/components/supplier'
import goodsInfo from '@/components/goodsInfo'
import goodsOutIn from '@/components/goodsOutIn'
import teamManager from '@/components/teamManager'
import pay from '@/components/pay'
import receive from '@/components/receive'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect:'cardIssue'
    },
    {
      path: '/cardIssue',
      name: 'cardIssue',
      component: cardIssue
    },
    {
      path: '/cardOff',
      name: 'cardOff',
      component: cardOff
    },
    {
      path: '/telephoneOrder',
      name: 'telephoneOrder',
      component: telephoneOrder
    },
    {
      path: '/sysOrder',
      name: 'sysOrder',
      component: sysOrder
    },
    {
      path: '/sendInfo',
      name: 'sendInfo',
      component: sendInfo
    },
    {
      path: '/orderManager',
      name: 'orderManager',
      component: orderManager
    },
    {
      path: '/supplier',
      name: 'supplier',
      component: supplier
    },
    {
      path: '/goodsInfo',
      name: 'goodsInfo',
      component: goodsInfo
    },
    {
      path: '/goodsOutIn',
      name: 'goodsOutIn',
      component: goodsOutIn
    },
    {
      path: '/teamManager',
      name: 'teamManager',
      component: teamManager
    },
    {
      path: '/pay',
      name: 'pay',
      component: pay
    },
    {
      path: '/receive',
      name: 'receive',
      component: receive
    },
  ]
})
