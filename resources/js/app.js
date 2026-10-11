import './bootstrap';

import Alpine from 'alpinejs';

// Horizontal card rows with previous/next buttons.
Alpine.data('rail', () => ({
    scroll(direction) {
        const track = this.$refs.track;
        track.scrollBy({ left: direction * track.clientWidth, behavior: 'smooth' });
    },
}));

window.Alpine = Alpine;

Alpine.start();
