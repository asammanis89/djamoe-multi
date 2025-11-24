// 📁 resources/js/pages/aktivitas-modal.js (File Baru)
document.addEventListener('DOMContentLoaded', () => {
    const activityCards = document.querySelectorAll('.activity-card');
    if (!activityCards.length) return;
    const activityModal = document.getElementById('activity-modal');
    if (!activityModal) return;
    const modalContent = activityModal.querySelector('.modal-content');
    const modalImage = activityModal.querySelector('#modal-image');
    const modalTitle = activityModal.querySelector('#modal-title');
    const modalDescription = activityModal.querySelector('#modal-description');
    const closeModalBtn = activityModal.querySelector('.close-modal');
    if (!modalContent || !modalImage || !modalTitle || !modalDescription || !closeModalBtn) {
        console.error('Bagian modal aktivitas tidak ditemukan.');
        return;
    }
    function openModal(card) {
        modalImage.src = card.dataset.image;
        modalTitle.textContent = card.dataset.title; 
        modalDescription.textContent = card.dataset.description; 
        activityModal.classList.remove('hidden');
        setTimeout(() => {
            activityModal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
        document.documentElement.style.overflow = 'hidden';
    }
    function closeModal() {
        activityModal.classList.add('opacity-0');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            activityModal.classList.add('hidden');
            document.documentElement.style.overflow = '';
        }, 300);
    }
    activityCards.forEach(card => card.addEventListener('click', () => openModal(card)));
    closeModalBtn.addEventListener('click', closeModal);
    activityModal.addEventListener('click', e => {
        if (e.target === activityModal) closeModal();
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && !activityModal.classList.contains('hidden')) closeModal();
    });
});