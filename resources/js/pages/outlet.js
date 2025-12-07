// File: resources/js/pages/outlet.js

/**
 * Finds and opens the specified modal.
 * @param {string} modalId The ID of the modal element to open.
 */
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error('Modal element not found for ID:', modalId);
        return;
    }

    const modalContent = modal.querySelector('.modal-content');
    
    // Prevent background scrolling
    document.body.style.overflow = 'hidden';
    
    // Make modal visible and interactive
    modal.classList.remove('pointer-events-none', 'opacity-0');
    
    // Animate content entrance
    if (modalContent) {
        modalContent.classList.remove('scale-95');
    }
}

/**
 * Finds and closes the specified modal.
 * @param {string} modalId The ID of the modal element to close.
 */
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error('Modal element not found for ID:', modalId);
        return;
    }

    const modalContent = modal.querySelector('.modal-content');

    // Animate modal and content exit
    modal.classList.add('opacity-0');
    if (modalContent) {
        modalContent.classList.add('scale-95');
    }
    
    // After transition (300ms), hide modal and restore scroll
    setTimeout(() => {
        modal.classList.add('pointer-events-none');
        // Restore scroll only if no other modals are open
        if (document.querySelectorAll('.modal-overlay:not(.pointer-events-none)').length === 0) {
             document.body.style.overflow = 'auto';
        }
    }, 300);
}


// --- Event Listeners ---
// Wait for the DOM to be fully loaded before attaching listeners
document.addEventListener('DOMContentLoaded', () => {

    // 1. Modal Open Triggers
    // Find all buttons that are meant to open a modal
    const modalTriggers = document.querySelectorAll('[data-modal-target]');
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const modalId = trigger.getAttribute('data-modal-target');
            openModal(modalId);
        });
    });

    // 2. Modal Close Triggers (for explicit close buttons)
    const modalCloseButtons = document.querySelectorAll('[data-modal-close]');
    modalCloseButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            // Stop click from bubbling up to the overlay
            event.stopPropagation(); 
            const modalId = button.closest('.modal-overlay')?.id;
            if (modalId) {
                closeModal(modalId);
            }
        });
    });

    // 3. Close modal when clicking on the overlay background
    const modalOverlays = document.querySelectorAll('.modal-overlay');
    modalOverlays.forEach(overlay => {
        overlay.addEventListener('click', (event) => {
            // Close only if the overlay itself is clicked, not its children
            if (event.target === overlay) {
                closeModal(overlay.id);
            }
        });
    });

    // 4. Global listener to close the top-most modal with the Escape key
    document.addEventListener('keydown', (event) => {
        if (event.key === "Escape") {
            // Find all currently visible modals
            const openModals = document.querySelectorAll('.modal-overlay:not(.pointer-events-none)');
            if (openModals.length > 0) {
                // Get the last one in the NodeList, which will be the top-most
                const topModal = openModals[openModals.length - 1];
                closeModal(topModal.id);
            }
        }
    });

});
