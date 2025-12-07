/* 📁 resources/js/pages/produk-ajax.js - FINAL SHARP VERSION (NO GPU ACCELERATION) */

document.addEventListener('DOMContentLoaded', () => {
    
    // ========================================
    // 1. AMBIL DATA DARI BLADE
    // ========================================
    
    const { translations, whatsappNumber, locale } = window.DjamoePageData || {};
    
    if (!translations || !whatsappNumber || !locale) {
        console.error('❌ DjamoePageData not found. Product script will not run.');
        return;
    }
    
    const WHATSAPP_NUMBER = whatsappNumber;
    
    // ========================================
    // 2. DOM ELEMENTS
    // ========================================
    
    const categoryView = document.getElementById('category-view');
    const productView = document.getElementById('product-view');
    const categoryGrid = document.getElementById('category-grid');
    const productGrid = document.getElementById('product-grid');
    const noResultsDiv = document.getElementById('no-results');
    const backToCategoriesBtn = document.getElementById('back-to-categories');
    const productViewTitle = document.getElementById('product-view-title');
    const modal = document.getElementById('description-modal');
    const modalContentWrapper = document.getElementById('modal-content-wrapper');
    const modalCloseBtn = document.getElementById('modal-close-btn');
    const modalBody = document.getElementById('modal-body');
    
    // Validasi elemen DOM
    if (!categoryView || !productView || !categoryGrid || !productGrid || 
        !noResultsDiv || !backToCategoriesBtn || !productViewTitle || 
        !modal || !modalContentWrapper || !modalCloseBtn || !modalBody) {
        console.error('❌ One or more product page elements are missing from the DOM.');
        return;
    }
    
    // ========================================
    // 3. FUNGSI: DISPLAY PRODUCTS
    // ========================================
    
    function displayProducts(categoryId, categoryName) {
        // Set title kategori
        productViewTitle.textContent = categoryName;
        
        // Loading state
        productGrid.innerHTML = `
            <div class="col-span-full text-center py-16">
                <div class="w-12 h-12 mx-auto border-4 loading-spinner rounded-full mb-4"></div>
                <p class="text-[#1A3A24]/70 text-lg font-medium">${translations.loadingProducts}</p>
            </div>
        `;
        
        // Fetch products dari API
        fetch(`/produk/kategori/${categoryId}?locale=${locale}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                // Toggle no results message
                noResultsDiv.classList.toggle('hidden', data.products.length > 0);
                
                // Clear grid
                productGrid.innerHTML = '';
                
                if (data.products.length > 0) {
                    data.products.forEach((product, index) => {
                        // Format harga
                        const priceFormatted = new Intl.NumberFormat('id-ID', {
                            style: 'currency', currency: 'IDR', minimumFractionDigits: 0
                        }).format(product.price);
                        
                        // Get product name
                        const productName = (typeof product.product_name === 'object' && product.product_name !== null)
                            ? product.product_name[locale] || product.product_name.id
                            : product.product_name || translations.productNameNotAvailable;
                        
                        // Create product card
                        const productCard = document.createElement('div');
                        productCard.className = "product-card group flex flex-col h-full reveal-animation";
                        productCard.style.transitionDelay = `${index * 50}ms`;
                        
                        // --- PERBAIKAN UTAMA: HAPUS 'transform-gpu' & PAKSA EAGER ---
                        productCard.innerHTML = `
                            <div class="relative overflow-hidden bg-gray-50">
                                ${product.is_bestseller ? `
                                    <div class="best-seller-tag">
                                        <i data-lucide="star" class="w-3 h-3 inline-block mr-1"></i>
                                        ${translations.bestSeller}
                                    </div>
                                ` : ''}
                                
                                <img src="/storage/${product.image_url}" 
                                     alt="${productName}" 
                                     class="product-image description-btn w-full h-48 sm:h-56 object-cover cursor-pointer" 
                                     data-product-id="${product.id}" 
                                     loading="eager" 
                                     fetchpriority="high"
                                     decoding="sync" 
                                     onerror="this.src='https://placehold.co/400x400/1a3a24/E6D793?text=Jamu'">
                                
                                <div class="absolute inset-0 bg-[#1A3A24]/0 group-hover:bg-[#1A3A24]/10 transition-all duration-300 pointer-events-none"></div>
                            </div>
                            
                            <div class="p-4 sm:p-5 flex flex-col flex-grow relative z-10">
                                <h3 class="product-title text-base sm:text-lg font-serif font-bold mb-2 line-clamp-2 leading-tight min-h-[3rem]">
                                    ${productName}
                                </h3>
                                
                                <div class="flex-grow"></div>
                                
                                <div class="mt-4 pt-4 border-t border-[#1A3A24]/10 group-hover:border-[#E6D793]/30 transition-colors duration-300">
                                    <p class="product-price text-base sm:text-lg font-sans font-bold mb-3">
                                        ${priceFormatted}
                                    </p>
                                    
                                    <button data-product-id="${product.id}" 
                                            class="detail-btn description-btn w-full py-2.5 px-4 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider transition-all duration-300 flex items-center justify-center gap-2">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                        ${translations.viewDetails}
                                    </button>
                                </div>
                            </div>
                        `;
                        
                        productGrid.appendChild(productCard);
                    });
                    
                    // Reinitialize Lucide icons
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                    
                    // Trigger reveal animations
                    setTimeout(() => {
                        document.querySelectorAll('.reveal-animation').forEach(el => {
                            el.classList.add('active');
                        });
                    }, 50);
                }
            })
            .catch(error => {
                console.error('❌ Error fetching products:', error);
                productGrid.innerHTML = `
                    <div class="col-span-full text-center py-16">
                        <div class="bg-white rounded-2xl shadow-soft p-12 max-w-md mx-auto">
                            <i data-lucide="alert-circle" class="w-16 h-16 mx-auto mb-4 text-red-400"></i>
                            <h3 class="text-xl font-bold text-[#1A3A24] mb-2">${translations.loadProductFailed}</h3>
                            <button onclick="location.reload()" class="mt-4 px-6 py-2 bg-[#E6D793] text-[#1A3A24] rounded-full font-bold hover:bg-[#D4C078] transition-colors">
                                Coba Lagi
                            </button>
                        </div>
                    </div>
                `;
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
    }
    
    // ========================================
    // 4. FUNGSI: OPEN MODAL
    // ========================================
    
    function openModal(productId) {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContentWrapper.classList.remove('scale-95');
        }, 10);
        
        document.documentElement.style.overflow = 'hidden';
        
        modalBody.innerHTML = `
            <div class="text-center py-16 px-6">
                <div class="w-12 h-12 mx-auto border-4 loading-spinner rounded-full mb-4"></div>
                <p class="text-[#1A3A24]/70 text-lg font-medium">${translations.loadingDetails}</p>
            </div>
        `;
        
        fetch(`/produk/detail/${productId}?locale=${locale}`)
            .then(response => response.json())
            .then(product => {
                const priceFormatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency', currency: 'IDR', minimumFractionDigits: 0
                }).format(product.price);
                
                const productName = (typeof product.product_name === 'object' && product.product_name !== null)
                    ? product.product_name[locale] || product.product_name.id
                    : product.product_name || translations.productNameNotAvailable;
                
                // Logic deskripsi sederhana
                let descText = null;
                if (product.full_description) {
                    descText = (typeof product.full_description === 'object') ? product.full_description[locale] : product.full_description;
                }
                if (!descText && product.description) {
                    descText = (typeof product.description === 'object') ? product.description[locale] : product.description;
                }
                if (!descText && product.full_description && typeof product.full_description === 'object') {
                    descText = product.full_description.id;
                }
                
                const description = (descText && String(descText).trim() !== "") ? descText : translations.descriptionNotAvailable;
                const whatsappMessage = `https://wa.me/${WHATSAPP_NUMBER}?text=Halo, saya tertarik dengan produk ${encodeURIComponent(productName)}`;
                
                // --- PERBAIKAN MODAL: EAGER & SYNC ---
                modalBody.innerHTML = `
                    <div class="modal-image-container relative w-full h-64 md:h-80">
                        <img src="/storage/${product.image_url}" 
                             alt="${productName}" 
                             class="w-full h-full object-cover" 
                             loading="eager"
                             fetchpriority="high"
                             decoding="sync"
                             onerror="this.src='https://placehold.co/600x600/1a3a24/E6D793?text=Jamu'">
                    </div>
                    
                    <div class="modal-content">
                        ${product.is_bestseller ? `
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#E6D793] to-[#D4C078] text-[#1A3A24] rounded-full text-sm font-bold uppercase mb-4">
                                <i data-lucide="star" class="w-4 h-4"></i>
                                ${translations.bestSeller}
                            </div>
                        ` : ''}
                        
                        <h3 class="text-2xl md:text-3xl font-serif font-bold text-[#1A3A24] mb-3 leading-tight">
                            ${productName}
                        </h3>
                        <p class="text-xl md:text-2xl font-sans font-bold text-[#C5A059]">
                            ${priceFormatted}
                        </p>
                        <div class="prose prose-sm md:prose-base max-w-none">
                            <div class="text-[#1A3A24]/80 leading-relaxed break-words ">
                                ${description}
                            </div>
                        </div>
                        <a href="${whatsappMessage}" target="_blank" 
                           class="whatsapp-btn mt-8 w-full py-4 px-6 rounded-full text-white font-bold text-base flex items-center justify-center gap-3 transition-all duration-300 hover:scale-105 active:scale-95">
                            <i data-lucide="message-circle" class="w-5 h-5"></i>
                            ${translations.orderViaWhatsApp}
                        </a>
                    </div>
                `;
                if (typeof lucide !== 'undefined') lucide.createIcons();
            })
            .catch(error => {
                console.error('❌ Error fetching product detail:', error);
                modalBody.innerHTML = `
                    <div class="text-center py-16 px-6">
                        <i data-lucide="alert-circle" class="w-16 h-16 mx-auto mb-4 text-red-400"></i>
                        <h3 class="text-xl font-bold text-[#1A3A24] mb-2">${translations.loadDetailFailed}</h3>
                        <button onclick="this.closest('#description-modal').querySelector('#modal-close-btn').click()" class="mt-4 px-6 py-2 bg-[#E6D793] text-[#1A3A24] rounded-full font-bold hover:bg-[#D4C078] transition-colors">
                            Tutup
                        </button>
                    </div>
                `;
                if (typeof lucide !== 'undefined') lucide.createIcons();
            });
    }
    
    // ========================================
    // 5. FUNGSI: CLOSE MODAL
    // ========================================
    
    function closeModal() {
        modal.classList.add('opacity-0');
        modalContentWrapper.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.documentElement.style.overflow = '';
            modalBody.innerHTML = '';
        }, 300);
    }
    
    // ========================================
    // 6. EVENT LISTENERS
    // ========================================
    
    categoryGrid.addEventListener('click', (e) => {
        const card = e.target.closest('.category-card');
        if (card) {
            categoryView.classList.add('hidden');
            productView.classList.remove('hidden');
            displayProducts(card.dataset.categoryId, card.dataset.categoryName);
            window.scrollTo({ top: productView.offsetTop - 100, behavior: 'smooth' });
        }
    });
    
    backToCategoriesBtn.addEventListener('click', () => {
        productView.classList.add('hidden');
        categoryView.classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    productGrid.addEventListener('click', (event) => {
        const button = event.target.closest('.description-btn');
        if (button) openModal(button.dataset.productId);
    });
    
    modalCloseBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (event) => { if (event.target === modal) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });
    
    // ========================================
    // 7. INTERSECTION OBSERVER
    // ========================================
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    
    document.querySelectorAll('.reveal-animation').forEach(el => observer.observe(el));
    
    console.log('✅ Product page initialized successfully');
});