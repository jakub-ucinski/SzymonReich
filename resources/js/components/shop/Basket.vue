<template>
    <div class="basket" ref="basket">
        <h3 class="basket-heading">Podsumowanie:</h3>
        <div class="basket-product" v-for="product in this.basketContent">
            <span class="title">{{ product.title }}</span
            ><span class="price" v-if="product.price !== 0">{{
                priceFormatter(product.price)
            }}</span
            ><span class="price" v-if="product.price == 0">-</span>
        </div>
        <div class="basket-product" v-if="this.basketContent.length > 0">
            <span class="title">Wysyłka Kurierska InPost</span
            ><span class="price">{{ priceFormatter(1300) }}</span>
        </div>

        <div class="total">
            <div class="title">Suma łącznie:</div>
            <div class="price" v-if="this.basketContent.length == 0">
                {{ priceFormatter(totalPrice) }}
            </div>
            <div class="price" v-if="this.basketContent.length > 0">
                {{ priceFormatter(totalPrice + 1300) }}
            </div>
        </div>

        <div class="charity">
            <div class="title">Na fundację przeznaczasz 5%:</div>
            <div class="price">
                {{ priceFormatter(Math.round(totalPrice * 0.05)) }}
            </div>
        </div>

        <div
            class="form-group basket-message"
            v-if="this.basketContent.length >= 1"
        >
            <label for="message" class="col-form-label"
                >Wiadomość do Sprzedawcy</label
            >

            <textarea
                v-model="basketMessage"
                class="w-100 form-control"
                rows="6"
                name="message"
                id="message"
                placeholder="Jeżeli chcesz zamówić więcej niż 1 przedmiot danego rodzaju, napisz o tym tu i przejdź do zakupu, a my się z Tobą skontaktujemy by uzupełnić paczkę."
            >
            </textarea>
        </div>

        <button
            class="buy-now-button"
            v-if="this.basketContent.length >= 1"
            @click="buyNowClicked"
        >
            Kup Teraz
        </button>
    </div>
</template>

<script>
export default {
    components: {},
    props: [],
    data() {
        return {
            basketContent: this.$store.state.basketContent,
            basketMessage: null
        };
    },

    mounted() {},

    methods: {
        priceFormatter(price) {
            if (price == 0) {
                return "PLN: 0";
            }
            price = Math.floor(price);
            return (
                "PLN: " +
                price.toString().substring(0, price.toString().length - 2) +
                "," +
                price.toString().substr(price.toString().length - 2, 2)
            );
        },
        buyNowClicked() {
            document
                .querySelector("section.order-products")
                .classList.remove("hidden");
            document
                .querySelector("section.shop-products")
                .classList.add("hidden");
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    },
    watch: {
        basketMessage: function(newMessage) {
            this.$store.commit("setMessage", newMessage);
        }
    },

    computed: {
        totalPrice: function() {
            // `this` points to the vm instance
            var totalPrice = 0;
            this.basketContent.forEach(product => {
                totalPrice += product.price;
            });
            return totalPrice;
        }
    }
};
</script>
