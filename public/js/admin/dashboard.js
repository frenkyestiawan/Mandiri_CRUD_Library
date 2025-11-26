function updateClock() {
    const el = document.getElementById('live-time');
    if (!el) return;
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    el.textContent = `${hours}:${minutes}:${seconds}`;
}

if (typeof document !== 'undefined') {
    updateClock();
    setInterval(updateClock, 1000);
}
