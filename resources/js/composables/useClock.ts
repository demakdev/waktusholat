import { ref, onMounted, onUnmounted } from 'vue'

export function useClock() {
  const currentTime = ref<string>('00:00:00')
  let timer: number | null = null

  const update = () => {
    const now = new Date()
    currentTime.value = now.toLocaleTimeString('en-GB', { hour12: false })
  }

  onMounted(() => {
    update()
    timer = setInterval(update, 1000)
  })

  onUnmounted(() => {
    if (timer) clearInterval(timer)
  })

  return { currentTime }
}
