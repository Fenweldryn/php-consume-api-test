import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Home.vue')
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/About.vue')
    },
    {
      path: '/events',
      name: 'events',
      component: () => import('../views/Events.vue')
    },
    {
      path: '/event/:id',
      name: 'event',
      component: () => import('../views/ShowEvent.vue')
    }
  ]
})

export default router
