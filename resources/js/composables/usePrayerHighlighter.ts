import { ref, onMounted, onUnmounted, Ref } from 'vue'

interface PrayerTimes {
  [key: string]: string
}

/**
 * Menentukan waktu shalat berikutnya untuk di-highlight.
 * @param prayerTimes - Objek waktu shalat (misalnya: { Subuh: "04:30", Dzuhur: "12:00", ... })
 * @param defaultKey - Key awal untuk highlight jika belum ada waktu berikutnya
 * @returns Ref string key yang sedang di-highlight
 */
export function usePrayerHighlighter(
  prayerTimes: PrayerTimes,
  defaultKey: string = ''
): Ref<string> {
  const highlightKey = ref<string>(defaultKey)
  let timer: number | null = null

  const updateHighlight = () => {
    const now = new Date()
    let nextKey: string | null = null
    let minDiff = Infinity

    for (const [name, time] of Object.entries(prayerTimes)) {
      const [hh, mm] = time.split(':').map(Number)
      const prayerTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hh, mm)

      const diff = prayerTime.getTime() - now.getTime()
      if (diff > 0 && diff < minDiff) {
        minDiff = diff
        nextKey = name
      }
    }

    highlightKey.value = nextKey || defaultKey
  }

  onMounted(() => {
    updateHighlight()
    timer = window.setInterval(updateHighlight, 30000) // update setiap 30 detik
  })

  onUnmounted(() => {
    if (timer) clearInterval(timer)
  })

  return highlightKey
}
