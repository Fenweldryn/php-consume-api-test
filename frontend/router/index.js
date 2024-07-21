import { createRouter, createWebHistory } from 'vue-router'
import EventsView from '../views/EventsView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/events',
      name: 'events',
      component: EventsView
    },
    {
      path: '/event/:id',
      name: 'event',
      component: () => import('../views/ShowEventView.vue')
    }
  ]
})

export default router
