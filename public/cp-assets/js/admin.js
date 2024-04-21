document.addEventListener('click:lang-switcher__lang', e => {
    let button = e.detail.target;
    let switcher = button.parentNode;

    let target = document.querySelector(switcher.dataset.target);
    if (target === null) {
        console.error('Target for lang switcher is not found.');
        return;
    }

    let active = switcher.querySelector('.lang-switcher__lang_active');
    if (active !== null) {
        let lang = active.dataset.switcherLang;
        let items = target.querySelectorAll('*[data-lang="' + lang + '"]');
        for (let i = 0; i < items.length; i++) {
            items[i].style.display = 'none';
        }
        active.classList.remove('lang-switcher__lang_active');
    }
    button.classList.add('lang-switcher__lang_active');
    let lang = button.dataset.switcherLang;
    let items = target.querySelectorAll('*[data-lang="' + lang + '"]');
    for (let i = 0; i < items.length; i++) {
        items[i].style.display = null;
    }
});

(() => {
    let images = [];

    document.addEventListener('click:create-product-button', async e => {
        e.detail.originalEvent.preventDefault();
        let button = e.detail.target;

        UIKit.modal.show('<div id="product-form" class="pad" style="width: 40rem; height: 50rem"></div>', false, null);
        UIKit.spinner.show('#product-form');
        images = [];
        try {
            let res = await UIKit.network.get(button.getAttribute('href'));
            let pad = document.getElementById('product-form');
            await UIKit.spinner.hide(pad);
            UIKit.helpers.setInnerHtml(pad.parentNode, res);

        } catch (e) {

        }
    });




    document.addEventListener('click:edit-product-button', async e => {
        e.detail.originalEvent.preventDefault();
        let button = e.detail.target;

        UIKit.modal.show('<div id="product-form" class="pad" style="width: 40rem; height: 50rem"></div>', false, null);
        UIKit.spinner.show('#product-form');
        images = [];
        try {
            let res = await UIKit.network.get(button.getAttribute('href'));
            let pad = document.getElementById('product-form');
            await UIKit.spinner.hide(pad);
            UIKit.helpers.setInnerHtml(pad.parentNode, res);

        } catch (e) {

        }
    });


    document.addEventListener('click:gallery__image', e => {
        let tile = e.detail.target;
        let active = tile.parentNode.querySelector('.gallery__image_active');
        if (active !== null) {
            active.classList.remove('gallery__image_active');
        }
        tile.classList.add('gallery__image_active');
    });


    document.addEventListener('change', e => {
        if (!e.target.classList.contains('gallery__file-input')) return;

        let input = e.target;
        let file = input.files[0];
        images.push(file);
        input.value = null;


        let reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = function() {
            let url = reader.result;
            let tile = document.createElement('div');
            tile.className = 'gallery__image';
            let img = new Image();
            img.src = url;
            tile.appendChild(img);
            input.parentNode.parentNode.insertBefore(tile, input.parentNode);
        }
    });


    document.addEventListener('submit', async e => {
        let form = e.target;
        if (form.getAttribute('id') !== 'product-form') return;
        e.preventDefault();
        UIKit.spinner.show(form);

        let data = new FormData(form);
        for (let i = 0; i < images.length; i++) {
            data.append('image_' + i, images[i]);
        }

        try {
            let res = await UIKit.network.post(form.getAttribute('action'), data);
            UIKit.modal.hide(form);
        } catch (e) {
            console.error(e);
            UIKit.spinner.hide(form);
        }
    }, true);

})();
