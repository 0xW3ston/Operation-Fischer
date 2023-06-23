
window.onload = function() {

    addClickEventListener_for_cart_add();
    setCurrentCartCount();
    
};

function add_to_cart(article_id, quantity){
    fetch(`/cart/add/${article_id}?qte=${quantity}`)
        .then((response) => {
            if(response.ok){
                setCurrentCartCount();
            }
        })
        .catch((err) => {
            console.error(err);
        })
}

function remove_from_cart(article_id){
    fetch(`/cart/remove/${article_id}`)
        .then((response) => {
            if(response.ok){
                setCurrentCartCount();
            }
        })
        .catch((err) => {
            console.error(err);
        })
}


function setCurrentCartCount(current_value=null){
    let cart_count_1 = document.getElementsByClassName('cart-item-count')[0];
    let cart_count_2 = document.getElementsByClassName('cart-item-count')[1];
    if(current_value == null){    
        fetch(`/cart/show`)
            .then((response) => {
                return response.json()
            })
            .then((json_res) => {
                console.log(json_res['cart'])
                current_value = json_res["cart"].length;
                cart_count_1.innerText = current_value;
                cart_count_2.innerText = current_value;

            })
            .catch((err) => {
                console.error(err);
        })
    }else{
        cart_count_1.innerText = current_value;
        cart_count_2.innerText = current_value;
    }
}

function addClickEventListener_for_cart_add(){
    
    const all_cart_buttons = document.querySelectorAll('.btn-add-to-cart');
    const number_of_units = document.querySelector('.count-input');

    all_cart_buttons.forEach(button => {
        button.addEventListener('click', () => {
            const article_id = parseInt(button.getAttribute('data-id'));
            if(number_of_units && number_of_units.value){
                add_to_cart(article_id, parseInt(number_of_units.value));
            }else{
                add_to_cart(article_id, 1);
            }
        });
    });
}