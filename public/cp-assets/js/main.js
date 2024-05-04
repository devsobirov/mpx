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



function handleInModal(linkClass, formId, width, height) {
    document.addEventListener('click:' + linkClass, async e => {
        e.detail.originalEvent.preventDefault();
        let button = e.detail.target;

        UIKit.modal.show('<div id="' + formId + '" class="pad" style="width: ' + width + 'rem; height: ' + height + 'rem"></div>', false, null);
        UIKit.spinner.show('#' + formId);
        try {
            let res = await UIKit.network.get(button.getAttribute('href'));
            let pad = document.getElementById(formId);
            await UIKit.spinner.hide(pad);
            UIKit.helpers.setInnerHtml(pad.parentNode, res);
        } catch (e) {

        }
    });
}



function handleDeletion(linkClass) {
    document.addEventListener('click:' + linkClass, async e => {
        e.detail.originalEvent.preventDefault();
        let button = e.detail.target;

        try {
            await UIKit.modal.confirm({
                question: button.dataset.question,
                hint: button.dataset.hint
            });
        } catch (e) {
            return;
        }

        try {
            await UIKit.network.post(button.getAttribute('href'));
            let row = button.closest('tr');
            if (row !== null) row.parentNode.removeChild(row);
        } catch (e) {
            console.error(e);
        }
    });
}


function handleAction(linkClass) {
    document.addEventListener('click:' + linkClass, async e => {
        e.detail.originalEvent.preventDefault();
        let button = e.detail.target;

        try {
            await UIKit.modal.confirm({
                question: button.dataset.question,
                hint: button.dataset.hint
            });
        } catch (e) {
            return;
        }

        try {
            await UIKit.network.post(button.getAttribute('href'));
            UIKit.modal.hide(button);
            await UIKit.modal.alert({message: button.dataset.success});
            window.location.reload();
        } catch (e) {
            console.error(e);
        }
    });
}

// Header icons animations
function expandAnimation(e) {
    let expandable = e.target.querySelector('.expandable');
    let shouldReverse = false
    if (expandable) {
        expandable.innerText = expandable.getAttribute('data-content');
        expandable.style.padding = "0 0.5rem"
        e.target.style.padding = '0 1rem 0 .5rem'
        e.target.style.width = e.target.clientWidth + expandable.clientWidth + 24 + 'px';
        shouldReverse = true
    }

    if (shouldReverse) {
        e.target.addEventListener('mouseleave', e => {
           expandable.innerText = ''
           expandable.style.padding = "0"
           e.target.style.padding = '0';
           e.target.style.width = '2.5rem';
        });
    }
}

// My profile
handleInModal('profile-button', 'profile-form', 25, 47.75);

// Users
handleInModal('edit-user-button', 'user-form', 25, 51);

// My products
handleInModal('create-product-button', 'product-form', 25, 23);
handleInModal('modal-button', 'product-form', 25, 23);
handleInModal('edit-product-button', 'product-form', 25, 23);

// Products
handleInModal('buy-product-button', 'product-buying-form', 30, 37.5);

// Orders
handleInModal('order-form-button', 'order-form', 30, 44);
handleInModal('order-details-button', 'order-details', 40, 20);

// Games
handleInModal('create-game-button', 'game-form', 25, 20);
handleInModal('modal-btn', 'game-form', 25, 20);
handleInModal('edit-game-button', 'game-form', 25, 20);
handleInModal('create-server-button', 'server-form', 25, 22);
handleInModal('edit-server-button', 'server-form', 25, 22);


handleDeletion('game-delete-button');
handleDeletion('server-delete-button');
handleDeletion('delete-user-button');
handleDeletion('delete-order-button');
handleDeletion('delete-product-button');


handleAction('accept-order-button');
handleAction('cancel-order-button');
handleInModal('done-form-order-button', 'proof-form', 30, 17.5);
handleInModal('accept-coins-order-button', 'server-form', 30, 20);

(() => {

})();

(() => {

})();
