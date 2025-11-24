document.addEventListener('DOMContentLoaded', () => {
    // Ambil data yang di-passing dari Blade
    const { translations, whatsappNumber, locale } = window.DjamoePageData || {};
    if (!translations || !whatsappNumber || !locale) {
        console.error('DjamoePageData not found. Product script will not run.');
        return;
    }
    const WHATSAPP_NUMBER = whatsappNumber;
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
    if (!categoryView || !productView || !categoryGrid || !productGrid || !noResultsDiv || !backToCategoriesBtn || !productViewTitle || !modal || !modalContentWrapper || !modalCloseBtn || !modalBody) {
        console.error('One or more product page elements are missing from the DOM.');
        return;
    }
    function displayProducts(categoryId, categoryName) {
        productViewTitle.textContent = categoryName; 
        productGrid.innerHTML = `<div class="col-span-full text-center py-10"><div class="w-10 h-10 mx-auto border-4 loading-spinner rounded-full"></div><p class="mt-3 text-accent/70">${translations.loadingProducts}</p></div>`;
        fetch(`/produk/kategori/${categoryId}?locale=${locale}`)
            .then(response => response.ok ? response.json() : Promise.reject('Network response was not ok'))
            .then(data => {
                noResultsDiv.classList.toggle('hidden', data.products.length > 0);
                productGrid.innerHTML = '';
                if (data.products.length > 0) {
                    data.products.forEach(product => {
                        const priceFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(product.price);
                        const productName = (typeof product.product_name === 'object' && product.product_name !== null) ? product.product_name[locale] || product.product_name.id : product.product_name || translations.productNameNotAvailable;
                        const productCard = document.createElement('div');
                        productCard.className = "bg-dark-card rounded-lg overflow-hidden shadow-lg transform hover:-translate-y-2 transition-transform duration-300 group flex flex-col";
                        productCard.innerHTML = `<div class="relative">${product.is_bestseller ? `<div class="best-seller-tag">${translations.bestSeller}</div>` : ''}<img src="/storage/${product.image_url}" alt="${productName}" class="description-btn w-full h-48 sm:h-56 object-cover cursor-pointer" data-product-id="${product.id}" loading="lazy" decoding="async" onerror="this.src='https://placehold.co/400x400/1a3a24/E6D793?text=Jamu'"></div><div class="p-3 sm:p-5 flex flex-col flex-grow"><h3 class="text-lg sm:text-xl font-serif font-bold mb-2 text-accent">${productName}</h3><div class="flex-grow"></div><div class="mt-auto pt-4 border-t border-accent/20"><span class="text-base sm:text-lg font-sans font-bold text-white">${priceFormatted}</span><button data-product-id="${product.id}" class="description-btn mt-3 w-full text-center bg-primary/80 text-accent py-2 px-3 rounded-full hover:bg-accent hover:text-primary transition-colors duration-300 text-sm">${translations.viewDetails}</button></div></div>`;
                        productGrid.appendChild(productCard);
                    });
                }
            })
            .catch(error => { console.error('Error fetching products:', error); productGrid.innerHTML = `<div class="col-span-full text-center py-10 text-red-400">${translations.loadProductFailed}</div>`; });
    }
    function openModal(productId) {
        modal.classList.remove('hidden');
        setTimeout(() => { modal.classList.remove('opacity-0'); modalContentWrapper.classList.remove('scale-95'); }, 10);
        document.documentElement.style.overflow = 'hidden'; // Gunakan <html>
        modalBody.innerHTML = `<div class="text-center py-10"><div class="w-8 h-8 mx-auto border-4 loading-spinner rounded-full"></div><p class="mt-3 text-accent/70">${translations.loadingDetails}</p></div>`;
        fetch(`/produk/detail/${productId}?locale=${locale}`)
            .then(response => response.json())
            .then(product => {
                const priceFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(product.price);
                const productName = (typeof product.product_name === 'object' && product.product_name !== null) ? product.product_name[locale] || product.product_name.id : product.product_name || translations.productNameNotAvailable;
                let descText = null;
                if (product.full_description) descText = (typeof product.full_description === 'object') ? product.full_description[locale] : product.full_description;
                if (!descText && product.description) descText = (typeof product.description === 'object') ? product.description[locale] : product.description;
                if (!descText) { if (product.full_description && typeof product.full_description === 'object') descText = product.full_description.id; else if (product.description && typeof product.description === 'object') descText = product.description.id; }
                const description = (descText && String(descText).trim() !== "") ? descText : translations.descriptionNotAvailable;
                const whatsappMessage = `https://wa.me/${WHATSAPP_NUMBER}?text=Halo, saya tertarik dengan produk ${encodeURIComponent(productName)}`;
                modalBody.innerHTML = `<div class="relative w-full h-56 rounded-lg overflow-hidden mb-4"><img src="/storage/${product.image_url}" alt="${productName}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/400x400/1a3a24/E6D793?text=Jamu'"></div><h3 class="text-3xl font-serif font-bold mb-2 text-accent">${productName}</h3><span class="text-xl font-sans font-bold text-white mb-4 block">${priceFormatted}</span><p class="text-light-text/80 break-words">${description}</p><a href="${whatsappMessage}" target="_blank" class="mt-6 w-full bg-green-600 text-white py-3 px-4 rounded-full hover:bg-green-700 transition-colors duration-300 text-base flex items-center justify-center gap-2"><i data-lucide="message-circle" class="w-5 h-5"></i> ${translations.orderViaWhatsApp}</a>`;
                if (typeof lucide !== 'undefined') lucide.createIcons();
            })
            .catch(error => { console.error('Error fetching product detail:', error); modalBody.innerHTML = `<div class="text-center text-red-400 py-6">${translations.loadDetailFailed}</div>`; });
    }
    function closeModal() {
        modal.classList.add('opacity-0');
        modalContentWrapper.classList.add('scale-95');
        setTimeout(() => { modal.classList.add('hidden'); document.documentElement.style.overflow = ''; modalBody.innerHTML = ''; }, 300); // Gunakan <html>
    }
    categoryGrid.addEventListener('click', (e) => {
        const card = e.target.closest('.category-card');
        if (card) { categoryView.classList.add('hidden'); productView.classList.remove('hidden'); displayProducts(card.dataset.categoryId, card.dataset.categoryName); window.scrollTo({ top: productView.offsetTop - 100, behavior: 'smooth' }); }
    });
    backToCategoriesBtn.addEventListener('click', () => { productView.classList.add('hidden'); categoryView.classList.remove('hidden'); });
    productGrid.addEventListener('click', (event) => { const button = event.target.closest('.description-btn'); if (button) openModal(button.dataset.productId); });
    modalCloseBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (event) => { if (event.target === modal) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });
});