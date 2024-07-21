import { createRouter, createWebHistory } from 'vue-router'
import Events from '../views/Events.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/events',
      name: 'events',
      component: Events
    },
    {
      path: '/event/:id',
      name: 'event',
      component: () => import('../views/ShowEvent.vue')
    }
  ]
})

export default router
