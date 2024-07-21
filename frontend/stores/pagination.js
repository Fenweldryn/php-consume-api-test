import { reactive } from 'vue'

export const paginationStore = reactive({
  pagination: {
      top: 3,
      skip: 0,
      search: '',
      orderBy: null,
      totalItems: 0,
      currentPage: 1
  }
})