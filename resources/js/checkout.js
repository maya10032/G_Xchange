document.addEventListener("DOMContentLoaded", function () {
    var stripe = Stripe('pk_test_51PySDEDA2YxCl5ELgjZzT5q1XzLn0Bwpc8lOKo7vUyISHdHQm9QAlHYAxvIcXNMsXIgOexnZv5RM53zFzmZ1XIm500Aap1mQ6Y');
    var elements = stripe.elements();

    // Create an instance of the card Elements
    var card = elements.create('cardNumber');
    var cardExpiry = elements.create('cardExpiry');
    var cardCvc = elements.create('cardCvc');

    // Mount elements
    card.mount('#card-number');
    cardExpiry.mount('#card-expiry');
    cardCvc.mount('#card-cvc');

    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function (button) {
        button.addEventListener('click', function () {
            var modalId = button.getAttribute('data-modal-id');
            document.querySelector(`#${modalId} #card-form`).addEventListener('submit', function (event) {
                event.preventDefault();

                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        // Display error.message in your UI.
                        document.getElementById('card-errors').textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        var form = document.getElementById('card-form');
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);

                        // Submit the form
                        form.submit();
                    }
                });
            });
        });
    });
});
