<template>
  <component
    :is="selectedTemplate"
    :prayerTimes="prayerTimes"
    :mosqueName="mosqueName"
    :mosqueAddress="mosqueAddress"
    :gregorianDate="gregorianDate"
    :hijriDate="hijriDate"
    :runningText="runningText"
    :highlightPrayer="highlightPrayer"
    :embedVideoId="embedVideoId"
  />
</template>

<script setup lang="ts">
import { computed } from 'vue'

import ClassicTemplate from '@/components/templates/ClassicTemplate.vue'
import ModernTemplate from '@/components/templates/ModernTemplate.vue'

const props = defineProps({
  activeTemplate: String, // "classic" | "modern"
  prayerTimes: Object,
  mosqueName: String,
  mosqueAddress: String,
  gregorianDate: String,
  hijriDate: String,
  runningText: String,
  highlightPrayer: String,
  embedVideoId: String
})

const selectedTemplate = computed(() => {
  switch (props.activeTemplate) {
    case 'modern':
      return ModernTemplate
    case 'classic':
    default:
      return ClassicTemplate
  }
})
</script>
