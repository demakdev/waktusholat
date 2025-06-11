<template>
  <div class="bg-black text-white min-h-screen font-sans overflow-hidden">
    <!-- Header -->
    <div class="px-6 pt-6 flex justify-between items-start">
      <div>
        <h1 class="text-4xl font-bold">{{ mosqueName }} {{ mosqueAddress }} </h1>
        <p class="text-lg text-gray-300">{{ gregorianDate }} / {{ hijriDate }}</p>
      </div>
      <div class="text-5xl font-bold">{{ currentTime }}</div>
    </div>


    <!-- Middle Content -->
    <section class="flex flex-col md:flex-row justify-between items-start px-6 mt-6">
      <!-- Video -->
      <iframe
        v-if="embedUrl"
        class="w-full md:w-[65%] h-64 md:h-80 rounded-lg shadow"
        :src="embedUrl"
        title="Live Makkah"
        frameborder="0"
        allowfullscreen
      ></iframe>

      <div class="mt-4 md:mt-0 md:ml-6 text-left md:w-[30%]">
        <h2 class="text-xl font-semibold mb-2">Info Lainnya</h2>
        <p class="text-gray-400 text-sm">Pengumuman, jadwal kajian, atau informasi lainnya bisa ditampilkan di sini.</p>
      </div>
    </section>

    <!-- Marquee -->
    <section class="mt-4 overflow-hidden bg-black py-3">
      <div class="inline-block whitespace-nowrap animate-marquee text-lg font-semibold">
        {{ runningText }}
      </div>
    </section>

    <!-- Prayer Times -->
    <PrayerTimes
      :prayer-times="prayerTimes"
      :highlight-key="highlightKey"
      template="modern"
    />
  </div>
</template>

<script setup lang="ts">
import PrayerTimes from '@/components/features/PrayerTimes.vue'
import { useClock } from '@/composables/useClock'
import { useEmbedYoutubeVideo } from '@/composables/useEmbedYoutubeVideo'
import { usePrayerHighlighter } from '@/composables/usePrayerHighlighter'

const props = defineProps({
  prayerTimes: Object,
  mosqueName: String,
  mosqueAddress: String,
  gregorianDate: String,
  hijriDate: String,
  runningText: String,
  highlightPrayer: String,
  embedVideoId: {
    type: String,
    default: ''
  }
})

const { currentTime } = useClock()
const { highlightKey } = usePrayerHighlighter(props.prayerTimes, props.highlightPrayer)
const { embedUrl } = useEmbedYoutubeVideo(props.embedVideoId)
</script>

<style scoped>
@keyframes marquee {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}
.animate-marquee {
  animation: marquee 25s linear infinite;
}
</style>
