let shop = document.querySelector(".site_content");
let basketAddButton = document.querySelector("#basket-add");
let basketClearButton = document.querySelector("#basket-clear");
let products = Array.from(document.querySelectorAll(".add-to-basket"));

class Basket {
    init(storage) {
        if(!localStorage.getItem(storage)) {
            localStorage.setItem(storage, JSON.stringify([]));
        };
    };

    add(storage, product) {
        let usersGoods = this.load(storage);
        usersGoods.push(product);
        console.log(storage);
        console.log(product);
        console.log(usersGoods);
        localStorage.setItem(storage, JSON.stringify(usersGoods));
    };

    load(storage) {
        return JSON.parse(localStorage.getItem(storage));
    };

    clear(storage) {
        localStorage.clear();
        this.init(storage);
    };
}
    

const basket = new Basket;
basket.init("goods");


if (products.length !== 0) {
    shop.addEventListener("click", (event) => {
        if (products.includes(event.target)) {
            basket.add("goods", event.target.parentNode.getAttribute("data-pid"));
        }

    })

    basketAddButton.addEventListener("click", async (event) => {
        console.log(basket.load("goods"));

            const url = `http://localhost/pages/basket`;
            console.log(basket.load("goods"));
        
            const response = await fetch(url, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json;charset=utf-8',
              },
              
              body: JSON.stringify(basket.load("goods")),
            });
        
            if (!response.ok) {
              throw new Error(`Could not receive data from ${url} , received ${response.status}`);
            }
        
            const body = await response.json();
            return body;
    });

    basketClearButton.addEventListener("click", (event) => {
        basket.clear("goods");
    });
}
