// composables/useYouTubeEmbed.js
import { ref } from 'vue'

export function useEmbedYoutubeVideo(videoId = '') {
  const embedUrl = ref('')

  if (videoId) {
    embedUrl.value = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&rel=0&controls=1`
  }

  return { embedUrl }
}
