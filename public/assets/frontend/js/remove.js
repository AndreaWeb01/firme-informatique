
document.addEventListener('DOMContentLoaded', function () {

    function formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + " FCFA";
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('tbody tr').forEach(function (row) {
            const price = parseInt(row.querySelector('.item-price').dataset.price);
            const quantity = parseInt(row.querySelector('.number').textContent);
            total += price * quantity;
        });
        document.getElementById('cartTotal').textContent = formatPrice(total);
    }

    // Gérer suppression
    document.querySelectorAll('.delete-icon').forEach(function (icon) {
        icon.addEventListener('click', function () {
            if (confirm("Voulez-vous vraiment supprimer ce produit ?")) {
                const tr = this.closest('tr');
                tr.remove();
                const remaining = document.querySelectorAll('tbody tr').length;
                if (remaining === 0) {
                    window.location.href = "panier-vide.html"; // ou une autre page
                } else {
                    updateTotal();
                }
            }
        });
    });

    // Gérer la quantité
    document.querySelectorAll('tbody tr').forEach(function (row) {
        const incrementBtn = row.querySelector('.increment');
        const decrementBtn = row.querySelector('.decrement');
        const numberSpan = row.querySelector('.number');

        incrementBtn.addEventListener('click', function () {
            let current = parseInt(numberSpan.textContent);
            numberSpan.textContent = current + 1;
            updateTotal();
        });

        decrementBtn.addEventListener('click', function () {
            let current = parseInt(numberSpan.textContent);
            if (current > 1) {
                numberSpan.textContent = current - 1;
                updateTotal();
            }
        });
    });

    updateTotal();
});

