<template>
  <section :class="gridClass">
    <div
      v-for="(time, name) in prayerTimes"
      :key="name"
      class="rounded shadow-md pt-2 pb-3 transition-all duration-300 ease-in-out"
      :class="name === highlightKey ? highlightClasses : normalClasses"
    >
      <h2 :class="nameClass">{{ name }}</h2>
      <p :class="timeClass">{{ time }}</p>
    </div>
  </section>
</template>

<script setup>
const props = defineProps({
  prayerTimes: {
    type: Object,
    required: true
  },
  highlightKey: {
    type: String,
    default: ''
  },
  // Kustomisasi class-class utama agar fleksibel
  normalClasses: {
    type: String,
    default: 'bg-gray-800'
  },
  highlightClasses: {
    type: String,
    default: 'bg-yellow-400 text-black'
  },
  nameClass: {
    type: String,
    default: 'text-lg md:text-2xl font-semibold text-teal-400'
  },
  timeClass: {
    type: String,
    default: 'text-3xl md:text-5xl font-serif font-bold mt-1'
  },
  gridClass: {
    type: String,
    default: 'grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-1 px-4 py-4 bg-black text-white text-center'
  }
})
</script>
